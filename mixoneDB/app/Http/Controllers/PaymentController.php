<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use App\Models\Reservation;
use App\Services\StripeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        private readonly StripeService $stripeService
    ) {}

    /**
     * Créer une session Stripe Checkout et rediriger vers la page de paiement.
     */
    public function checkout(Reservation $reservation): RedirectResponse
    {
        // Vérifier que l'utilisateur est le propriétaire de la réservation
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à payer cette réservation.');
        }

        // Vérifier que la réservation est bien en attente de paiement
        if ($reservation->payment_status !== PaymentStatus::Pending) {
            return redirect()->route('dashboard')
                ->with('error', 'Cette réservation a déjà été payée ou annulée.');
        }

        try {
            $session = $this->stripeService->createCheckoutSession(
                reservationId: $reservation->id,
                studioName: $reservation->studio->name,
                date: $reservation->date->format('d/m/Y'),
                timeSlot: $reservation->time_slot,
                hours: $reservation->number_of_hours,
                price: (float) $reservation->price,
                customerEmail: auth()->user()->email,
            );

            // Stocker l'ID de session Stripe sur la réservation
            $reservation->update(['stripe_session_id' => $session->id]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur Stripe Checkout', [
                'reservation_id' => $reservation->id,
                'error'          => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('error', 'Erreur lors de la redirection vers le paiement. Veuillez réessayer.');
        }
    }

    /**
     * Page de succès après paiement.
     */
    public function success(Request $request): View|RedirectResponse
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('dashboard')->with('error', 'Session de paiement invalide.');
        }

        try {
            $session = $this->stripeService->retrieveSession($sessionId);
            $reservation = Reservation::where('stripe_session_id', $sessionId)->firstOrFail();

            // Marquer comme payé si le paiement est complet
            if ($session->payment_status === 'paid' && $reservation->payment_status === PaymentStatus::Pending) {
                $reservation->update([
                    'payment_status'    => PaymentStatus::Paid,
                    'stripe_payment_id' => $session->payment_intent,
                ]);

                // Prévenir le studio par mail
                $studioOwner = $reservation->studio->user;
                if ($studioOwner && $studioOwner->email) {
                    \Illuminate\Support\Facades\Mail::to($studioOwner->email)->send(new \App\Mail\NewReservationStudioMail($reservation));
                }
            }

            return view('pages.payment.success', [
                'reservation' => $reservation->load('studio'),
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur vérification paiement', ['error' => $e->getMessage()]);
            return redirect()->route('dashboard')->with('error', 'Impossible de vérifier le paiement.');
        }
    }

    /**
     * Page d'annulation de paiement.
     */
    public function cancel(Request $request): View
    {
        $reservation = null;

        if ($request->has('reservation_id')) {
            $reservation = Reservation::where('id', $request->get('reservation_id'))
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('pages.payment.cancel', [
            'reservation' => $reservation?->load('studio'),
        ]);
    }
}
