<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use App\Mail\ReservationPaidStudioMail;
use App\Models\Reservation;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StripeWebhookController extends Controller
{
    public function __construct(
        private readonly StripeService $stripeService
    ) {}

    /**
     * Gérer les webhooks Stripe.
     *
     * Stripe envoie des événements ici pour confirmer les paiements,
     * gérer les échecs, les remboursements, etc.
     */
    public function handle(Request $request): Response
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        if (!$sigHeader) {
            Log::warning('Stripe webhook sans signature');
            return response('Missing signature', 400);
        }

        try {
            $event = $this->stripeService->constructWebhookEvent($payload, $sigHeader);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::warning('Stripe webhook signature invalide', ['error' => $e->getMessage()]);
            return response('Invalid signature', 400);
        } catch (\Exception $e) {
            Log::error('Stripe webhook erreur parsing', ['error' => $e->getMessage()]);
            return response('Invalid payload', 400);
        }

        Log::info('Stripe webhook reçu', ['type' => $event->type, 'id' => $event->id]);

        match ($event->type) {
            'checkout.session.completed' => $this->handleCheckoutCompleted($event->data->object),
            'payment_intent.payment_failed' => $this->handlePaymentFailed($event->data->object),
            'charge.refunded' => $this->handleRefund($event->data->object),
            default => Log::info("Stripe webhook non géré: {$event->type}"),
        };

        return response('OK', 200);
    }

    /**
     * Paiement réussi via Checkout.
     */
    private function handleCheckoutCompleted(object $session): void
    {
        $reservationId = $session->metadata->reservation_id ?? null;

        if (!$reservationId) {
            Log::warning('Checkout completed sans reservation_id', ['session_id' => $session->id]);
            return;
        }

        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            Log::warning('Réservation introuvable pour le checkout', ['reservation_id' => $reservationId]);
            return;
        }

        // Mettre à jour le statut de paiement
        $reservation->update([
            'payment_status'    => PaymentStatus::Paid,
            'stripe_session_id' => $session->id,
            'stripe_payment_id' => $session->payment_intent,
        ]);

        // Calculer la part du studio
        $commissionRate = config('services.stripe.commission_rate', 10);
        $totalAmount = $session->amount_total / 100;
        $commission = $totalAmount * ($commissionRate / 100);
        $studioEarnings = $totalAmount - $commission;

        // Créditer le wallet du studio en attente
        $studioOwner = $reservation->studio->user;
        if ($studioOwner) {
            $wallet = $studioOwner->wallet()->firstOrCreate(['user_id' => $studioOwner->id]);
            $wallet->creditPending($studioEarnings, $reservation->id, "Gains futurs (Réservation #{$reservation->id})");
        }

        Log::info('Paiement confirmé via webhook et mis en séquestre', [
            'reservation_id' => $reservationId,
            'amount_total'   => $totalAmount,
            'commission'     => $commission,
            'studio_earnings'=> $studioEarnings,
        ]);

        if ($studioOwner && $studioOwner->email) {
            Mail::to($studioOwner->email)->send(new ReservationPaidStudioMail($reservation));
        }

        // Envoyer le mail de confirmation de paiement à l'artiste
        if ($reservation->user && $reservation->user->email) {
            Mail::to($reservation->user->email)->send(new \App\Mail\ReservationPaidArtistMail($reservation));
        }
    }

    /**
     * Échec de paiement.
     */
    private function handlePaymentFailed(object $paymentIntent): void
    {
        // Chercher la réservation par payment_intent
        $reservation = Reservation::where('stripe_payment_id', $paymentIntent->id)->first();

        if ($reservation) {
            $reservation->update(['payment_status' => PaymentStatus::Failed]);

            Log::warning('Paiement échoué', [
                'reservation_id' => $reservation->id,
                'error'          => $paymentIntent->last_payment_error->message ?? 'Inconnu',
            ]);
        }
    }

    /**
     * Remboursement reçu.
     */
    private function handleRefund(object $charge): void
    {
        $reservation = Reservation::where('stripe_payment_id', $charge->payment_intent)->first();

        if ($reservation) {
            $reservation->update(['payment_status' => PaymentStatus::Refunded]);

            Log::info('Remboursement confirmé', [
                'reservation_id' => $reservation->id,
                'amount'         => $charge->amount_refunded / 100,
            ]);
        }
    }
}
