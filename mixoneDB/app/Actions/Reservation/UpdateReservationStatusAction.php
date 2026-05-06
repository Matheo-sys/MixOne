<?php

namespace App\Actions\Reservation;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use App\Models\Reservation;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateReservationStatusAction
{
    /**
     * @param StripeService $serviceStripe
     */
    public function __construct(
        private readonly StripeService $serviceStripe
    ) {}

    /**
     * Exécute la mise à jour du statut d'une réservation.
     *
     * @param Reservation $reservation
     * @param ReservationStatus $nouveauStatut
     * @param string $role
     * @return bool
     * @throws Exception
     */
    public function executer(Reservation $reservation, ReservationStatus $nouveauStatut, string $role = 'studio'): bool
    {
        $statutActuel = $reservation->status;

        if (!$statutActuel->peutPasserA($nouveauStatut)) {
            throw new Exception("Impossible de passer de « {$statutActuel->value} » à « {$nouveauStatut->value} ».");
        }


        // Vérification de propriété (on ignore si c'est le système)
        if ($role !== 'system') {
            $utilisateur = Auth::user();

            if ($role === 'artist') {
                if ($reservation->user_id !== $utilisateur->id) {
                    throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
                }
                if ($nouveauStatut !== ReservationStatus::Cancelled) {
                    throw new Exception("Action non autorisée.");
                }
            } else {
                $idProprietaireStudio = $reservation->studio->proprietaire->id ?? null;
                if ($idProprietaireStudio !== $utilisateur->id) {
                    throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
                }
            }
        }

        return DB::transaction(function () use ($reservation, $nouveauStatut) {
            // Gestion du remboursement Stripe et annulation des fonds séquestrés
            if (in_array($nouveauStatut, [ReservationStatus::Cancelled, ReservationStatus::Refused])) {
                $this->traiterRemboursement($reservation, $nouveauStatut);
            }

            // Si la réservation est terminée, on débloque les fonds
            if ($nouveauStatut === ReservationStatus::Completed && $reservation->payment_status === PaymentStatus::Paid) {
                $this->confirmerGainsStudio($reservation);
            }

            return $reservation->update(['status' => $nouveauStatut]);
        });
    }

    /**
     * Débloquer les gains du studio (de 'En attente' vers 'Disponible')
     *
     * @param Reservation $reservation
     */
    private function confirmerGainsStudio(Reservation $reservation): void
    {
        $proprietaireStudio = $reservation->studio->proprietaire ?? null;
        if ($proprietaireStudio && $proprietaireStudio->portefeuille) {
            $tauxCommission = config('services.stripe.commission_rate', 10);
            $montantTotal = $reservation->price;
            $commission = $montantTotal * ($tauxCommission / 100);
            $gainsStudio = $montantTotal - $commission;

            $proprietaireStudio->portefeuille->confirmerEnAttente($gainsStudio, $reservation->id, "Gains débloqués (Réservation #{$reservation->id})");
        }
    }

    /**
     * Rembourser via Stripe si le paiement a été effectué.
     *
     * @param Reservation $reservation
     * @param ReservationStatus $raison
     * @throws Exception
     */
    private function traiterRemboursement(Reservation $reservation, ReservationStatus $raison): void
    {
        // Ne rembourser que si le paiement a été effectué
        if ($reservation->payment_status !== PaymentStatus::Paid || !$reservation->stripe_payment_id) {
            // Si le paiement n'a pas encore été fait, on met juste le statut à annulé
            $reservation->update(['payment_status' => PaymentStatus::Cancelled]);
            return;
        }

        // Retirer les fonds en attente du portefeuille du studio
        $proprietaireStudio = $reservation->studio->proprietaire ?? null;
        if ($proprietaireStudio && $proprietaireStudio->portefeuille) {
            $tauxCommission = config('services.stripe.commission_rate', 10);
            $montantTotal = $reservation->price;
            $commission = $montantTotal * ($tauxCommission / 100);
            $gainsStudio = $montantTotal - $commission;

            $proprietaireStudio->portefeuille->annulerEnAttente($gainsStudio, $reservation->id, "Réservation annulée/refusée (#{$reservation->id})");
        }

        try {
            $this->serviceStripe->rembourser($reservation->stripe_payment_id);

            $reservation->update(['payment_status' => PaymentStatus::Refunded]);

            Log::info('Remboursement Stripe effectué', [
                'reservation_id' => $reservation->id,
                'amount'         => $reservation->price,
                'reason'         => $raison->value,
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

