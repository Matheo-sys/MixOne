<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use App\Mail\ReservationPaidStudioMail;
use App\Mail\ReservationPaidArtistMail;
use App\Models\Reservation;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StripeWebhookController extends Controller
{
    /**
     * @param StripeService $serviceStripe
     */
    public function __construct(
        private readonly StripeService $serviceStripe
    ) {}

    /**
     * Gérer les webhooks Stripe.
     *
     * Stripe envoie des événements ici pour confirmer les paiements,
     * gérer les échecs, les remboursements, etc.
     */
    public function gerer(Request $requete): Response
    {
        $contenu = $requete->getContent();
        $enteteSignature = $requete->header('Stripe-Signature');

        if (!$enteteSignature) {
            Log::warning('Webhook Stripe sans signature');
            return response('Missing signature', 400);
        }

        try {
            $evenement = $this->serviceStripe->construireEvenementWebhook($contenu, $enteteSignature);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::warning('Webhook Stripe signature invalide', ['error' => $e->getMessage()]);
            return response('Invalid signature', 400);
        } catch (\Exception $e) {
            Log::error('Webhook Stripe erreur parsing', ['error' => $e->getMessage()]);
            return response('Invalid payload', 400);
        }

        Log::info('Webhook Stripe reçu', ['type' => $evenement->type, 'id' => $evenement->id]);

        match ($evenement->type) {
            'checkout.session.completed' => $this->gererCheckoutTermine($evenement->data->object),
            'payment_intent.payment_failed' => $this->gererEchecPaiement($evenement->data->object),
            'charge.refunded' => $this->gererRemboursement($evenement->data->object),
            default => Log::info("Webhook Stripe non géré: {$evenement->type}"),
        };

        return response('OK', 200);
    }

    /**
     * Paiement réussi via Checkout.
     */
    private function gererCheckoutTermine(object $session): void
    {
        $idReservation = $session->metadata->reservation_id ?? null;

        if (!$idReservation) {
            Log::warning('Checkout terminé sans reservation_id', ['session_id' => $session->id]);
            return;
        }

        $reservation = Reservation::find($idReservation);

        if (!$reservation) {
            Log::warning('Réservation introuvable pour le checkout', ['reservation_id' => $idReservation]);
            return;
        }

        // Mettre à jour le statut de paiement
        $reservation->update([
            'payment_status'    => PaymentStatus::Paid,
            'stripe_session_id' => $session->id,
            'stripe_payment_id' => $session->payment_intent,
        ]);

        // Calculer la part du studio
        $tauxCommission = config('services.stripe.commission_rate', 10);
        $montantTotal = $session->amount_total / 100;
        $commission = $montantTotal * ($tauxCommission / 100);
        $gainsStudio = $montantTotal - $commission;

        // Créditer le portefeuille du studio en attente
        $proprietaireStudio = $reservation->studio->proprietaire;
        if ($proprietaireStudio) {
            $portefeuille = $proprietaireStudio->portefeuille()->firstOrCreate(['user_id' => $proprietaireStudio->id]);
            $portefeuille->crediterEnAttente($gainsStudio, $reservation->id, "Gains futurs (Réservation #{$reservation->id})");
        }


        Log::info('Paiement confirmé via webhook et mis en séquestre', [
            'reservation_id' => $idReservation,
            'amount_total'   => $montantTotal,
            'commission'     => $commission,
            'studio_earnings'=> $gainsStudio,
        ]);

        if ($proprietaireStudio && $proprietaireStudio->email) {
            Mail::to($proprietaireStudio->email)->send(new ReservationPaidStudioMail($reservation));
        }

        // Envoyer le mail de confirmation de paiement à l'artiste
        if ($reservation->client && $reservation->client->email) {
            Mail::to($reservation->client->email)->send(new ReservationPaidArtistMail($reservation));
        }

    }

    /**
     * Échec de paiement.
     */
    private function gererEchecPaiement(object $intentionPaiement): void
    {
        // Chercher la réservation par payment_intent
        $reservation = Reservation::where('stripe_payment_id', $intentionPaiement->id)->first();

        if ($reservation) {
            $reservation->update(['payment_status' => PaymentStatus::Failed]);

            Log::warning('Paiement échoué', [
                'reservation_id' => $reservation->id,
                'error'          => $intentionPaiement->last_payment_error->message ?? 'Inconnu',
            ]);
        }
    }

    /**
     * Remboursement reçu.
     */
    private function gererRemboursement(object $charge): void
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

