<?php

namespace App\Services;

use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;
use Stripe\Stripe;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Créer une session Stripe Checkout pour une réservation.
     *
     * @throws ApiErrorException
     */
    public function createCheckoutSession(
        int    $reservationId,
        string $studioName,
        string $date,
        string $timeSlot,
        int    $hours,
        float  $price,
        string $customerEmail,
    ): StripeSession {
        return StripeSession::create([
            'payment_method_types' => ['card'],
            'mode'                 => 'payment',
            'customer_email'       => $customerEmail,
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'unit_amount'  => (int) round($price * 100), // Stripe utilise les centimes
                        'product_data' => [
                            'name'        => "Session studio : {$studioName}",
                            'description' => "📅 {$date} | ⏰ {$timeSlot} | 🕐 {$hours}h",
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
     * @throws ApiErrorException
     */
    public function retrieveSession(string $sessionId): StripeSession
    {
        return StripeSession::retrieve($sessionId);
    }

    /**
     * Rembourser un paiement.
     *
     * @throws ApiErrorException
     */
    public function refund(string $paymentIntentId, ?int $amountInCents = null): Refund
    {
        $params = ['payment_intent' => $paymentIntentId];

        if ($amountInCents !== null) {
            $params['amount'] = $amountInCents;
        }

        return Refund::create($params);
    }

    /**
     * Vérifier la signature d'un webhook Stripe.
     */
    public function constructWebhookEvent(string $payload, string $sigHeader): \Stripe\Event
    {
        return \Stripe\Webhook::constructEvent(
            $payload,
            $sigHeader,
            config('services.stripe.webhook')
        );
    }
}
