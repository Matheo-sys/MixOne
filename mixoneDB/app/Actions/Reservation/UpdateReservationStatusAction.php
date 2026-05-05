<?php

namespace App\Actions\Reservation;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateReservationStatusAction
{
    public function __construct(
        private readonly StripeService $stripeService
    ) {}

    public function execute(Reservation $reservation, ReservationStatus $newStatus, string $role = 'studio'): bool
    {
        $currentStatus = $reservation->status;

        if (!$currentStatus->canTransitionTo($newStatus)) {
            throw new Exception("Impossible de passer de « {$currentStatus->value} » à « {$newStatus->value} ».");
        }

        // Vérification de propriété (on ignore si c'est le système)
        if ($role !== 'system') {
            $user = Auth::user();

            if ($role === 'artist') {
                if ($reservation->user_id !== $user->id) {
                    throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
                }
                if ($newStatus !== ReservationStatus::Cancelled) {
                    throw new Exception("Action non autorisée.");
                }
            } else {
                $studioOwnerId = $reservation->studio->user_id ?? null;
                if ($studioOwnerId !== $user->id) {
                    throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
                }
            }
        }

        return DB::transaction(function () use ($reservation, $newStatus) {
            // Gestion du remboursement Stripe et annulation des fonds séquestrés
            if (in_array($newStatus, [ReservationStatus::Cancelled, ReservationStatus::Refused])) {
                $this->processRefund($reservation, $newStatus);
            }

            // Si la réservation est terminée, on débloque les fonds
            if ($newStatus === ReservationStatus::Completed && $reservation->payment_status === 'paid') {
                $this->confirmStudioEarnings($reservation);
            }

            return $reservation->update(['status' => $newStatus]);
        });
    }

    /**
     * Débloquer les gains du studio (de 'En attente' vers 'Disponible')
     */
    private function confirmStudioEarnings(Reservation $reservation): void
    {
        $studioOwner = $reservation->studio->user ?? null;
        if ($studioOwner && $studioOwner->wallet) {
            $commissionRate = config('services.stripe.commission_rate', 10);
            $totalAmount = $reservation->price;
            $commission = $totalAmount * ($commissionRate / 100);
            $studioEarnings = $totalAmount - $commission;

            $studioOwner->wallet->confirmPending($studioEarnings, $reservation->id, "Gains débloqués (Réservation #{$reservation->id})");
        }
    }

    /**
     * Rembourser via Stripe si le paiement a été effectué.
     */
    private function processRefund(Reservation $reservation, ReservationStatus $reason): void
    {
        // Ne rembourser que si le paiement a été effectué
        if ($reservation->payment_status !== 'paid' || !$reservation->stripe_payment_id) {
            // Si le paiement n'a pas encore été fait, on met juste le statut à cancelled
            $reservation->update(['payment_status' => 'cancelled']);
            return;
        }

        // Retirer les fonds en attente du wallet du studio
        $studioOwner = $reservation->studio->user ?? null;
        if ($studioOwner && $studioOwner->wallet) {
            $commissionRate = config('services.stripe.commission_rate', 10);
            $totalAmount = $reservation->price;
            $commission = $totalAmount * ($commissionRate / 100);
            $studioEarnings = $totalAmount - $commission;

            $studioOwner->wallet->cancelPending($studioEarnings, $reservation->id, "Réservation annulée/refusée (#{$reservation->id})");
        }

        try {
            $this->stripeService->refund($reservation->stripe_payment_id);

            $reservation->update(['payment_status' => 'refunded']);

            Log::info('Remboursement Stripe effectué', [
                'reservation_id' => $reservation->id,
                'amount'         => $reservation->price,
                'reason'         => $reason->value,
            ]);
        } catch (\Exception $e) {
            Log::error('Échec du remboursement Stripe', [
                'reservation_id' => $reservation->id,
                'error'          => $e->getMessage(),
            ]);

            throw new Exception("Le remboursement a échoué. Veuillez contacter le support.");
        }
    }
}
