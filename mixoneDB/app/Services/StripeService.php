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
        ?string $stripeAccountId = null,
    ): SessionStripe {
        $commissionRate = config('services.stripe.commission_rate', 10) / 100;
        $applicationFeeAmount = (int) round(($prix * 100) * $commissionRate);

        $sessionData = [
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
        ];

        // Intégration Stripe Connect : si le studio a un compte Stripe connecté
        if ($stripeAccountId) {
            $sessionData['payment_intent_data'] = [
                'application_fee_amount' => $applicationFeeAmount,
                'transfer_data' => [
                    'destination' => $stripeAccountId,
                ],
            ];
        }

        return SessionStripe::create($sessionData);
    }

    /**
     * Crée un compte Stripe Express (Connect) pour un studio.
     *
     * @param string $email
     * @return \Stripe\Account
     * @throws ApiErrorException
     */
    public function creerCompteConnect(string $email): \Stripe\Account
    {
        return \Stripe\Account::create([
            'type' => 'express',
            'email' => $email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
        ]);
    }

    /**
     * Crée un lien d'onboarding (Account Link) pour Stripe Connect.
     *
     * @param string $accountId
     * @param string $returnUrl
     * @param string $refreshUrl
     * @return \Stripe\AccountLink
     * @throws ApiErrorException
     */
    public function creerLienCompteConnect(string $accountId, string $returnUrl, string $refreshUrl): \Stripe\AccountLink
    {
        return \Stripe\AccountLink::create([
            'account' => $accountId,
            'refresh_url' => $refreshUrl,
            'return_url' => $returnUrl,
            'type' => 'account_onboarding',
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

