<?php

namespace App\Services;

use Stripe\Checkout\Session as SessionStripe;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;
use Stripe\Stripe;

class StripeService
{
    /**
     * Initialise le service avec la clé API Stripe.
     */
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Créer une session Stripe Checkout pour une réservation.
     *
     * @param int $reservationId
     * @param string $nomStudio
     * @param string $date
     * @param string $creneauHoraire
     * @param int $heures
     * @param float $prix
     * @param string $emailClient
     * @return SessionStripe
     * @throws ApiErrorException
     */
    public function creerSessionPaiement(
        int    $reservationId,
        string $nomStudio,
        string $date,
        string $creneauHoraire,
        int    $heures,
        float  $prix,
        string $emailClient,
    ): SessionStripe {
        return SessionStripe::create([
            'payment_method_types' => ['card'],
            'mode'                 => 'payment',
            'customer_email'       => $emailClient,
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'unit_amount'  => (int) round($prix * 100), // Stripe utilise les centimes
                        'product_data' => [
                            'name'        => "Session studio : {$nomStudio}",
                            'description' => "📅 {$date} | ⏰ {$creneauHoraire} | 🕐 {$heures}h",
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'reservation_id' => $reservationId,
            ],
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('payment.cancel') . '?reservation_id=' . $reservationId,
        ]);
    }

    /**
     * Récupérer une session Stripe Checkout.
     *
     * @param string $idSession
     * @return SessionStripe
     * @throws ApiErrorException
     */
    public function recupererSession(string $idSession): SessionStripe
    {
        return SessionStripe::retrieve($idSession);
    }

    /**
     * Rembourser un paiement.
     *
     * @param string $idIntentionPaiement
     * @param int|null $montantEnCentimes
     * @return Refund
     * @throws ApiErrorException
     */
    public function rembourser(string $idIntentionPaiement, ?int $montantEnCentimes = null): Refund
    {
        $parametres = ['payment_intent' => $idIntentionPaiement];

        if ($montantEnCentimes !== null) {
            $parametres['amount'] = $montantEnCentimes;
        }

        return Refund::create($parametres);
    }

    /**
     * Vérifier la signature d'un webhook Stripe.
     *
     * @param string $donnees
     * @param string $enteteSignature
     * @return \Stripe\Event
     */
    public function construireEvenementWebhook(string $donnees, string $enteteSignature): \Stripe\Event
    {
        return \Stripe\Webhook::constructEvent(
            $donnees,
            $enteteSignature,
            config('services.stripe.webhook')
        );
    }
}

