<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateReservationAction;
use App\Actions\Reservation\UpdateReservationStatusAction;
use App\Enums\ReservationStatus;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Models\Reservation;
use App\Mail\ReservationConfirmedArtistMail;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function __construct(
        private readonly CreateReservationAction $createReservationAction,
        private readonly UpdateReservationStatusAction $updateReservationStatusAction,
        private readonly StripeService $stripeService
    ) {}

    /**
     * Créer la réservation puis rediriger vers Stripe Checkout.
     */
    public function store(CreateReservationRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $reservation = $this->createReservationAction->execute($request->toDTO());

            // Créer la session Stripe Checkout
            $session = $this->stripeService->createCheckoutSession(
                reservationId: $reservation->id,
                studioName: $reservation->studio->name,
                date: $reservation->date->format('d/m/Y'),
                timeSlot: $reservation->time_slot,
                hours: $reservation->number_of_hours,
                price: (float) $reservation->price,
                customerEmail: auth()->user()->email,
            );

            // Sauvegarder l'ID de session Stripe
            $reservation->update(['stripe_session_id' => $session->id]);

            // Rediriger vers Stripe Checkout
            if ($request->ajax()) {
                return response()->json([
                    'status'   => 'success',
                    'redirect' => $session->url,
                ]);
            }

            return redirect($session->url);

        } catch (\Exception $e) {
            $message = $e->getMessage();

            Log::error('Erreur création réservation/paiement', [
                'error' => $message,
                'user'  => auth()->id(),
            ]);

            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $message], 422);
            }

            return back()->withInput()->withErrors(['time_slot' => $message]);
        }
    }

    /**
     * Studio confirme une réservation en attente.
     */
    public function confirm(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('manageAsStudio', $reservation);

        try {
            $this->updateReservationStatusAction->execute($reservation, ReservationStatus::Confirmed, 'studio');
            
            // Envoyer l'email avec le code PIN à l'artiste
            if ($reservation->user && $reservation->user->email) {
                Mail::to($reservation->user->email)->send(new ReservationConfirmedArtistMail($reservation));
            }
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation confirmée avec succès !', 'new_status' => ReservationStatus::Confirmed->value]);
            }
            return redirect()->back()->with('success', 'Réservation confirmée !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Studio refuse une réservation en attente.
     */
    public function refuse(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('manageAsStudio', $reservation);

        try {
            $this->updateReservationStatusAction->execute($reservation, ReservationStatus::Refused, 'studio');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation refusée. Le client sera remboursé.', 'new_status' => ReservationStatus::Refused->value]);
            }
            return redirect()->back()->with('success', 'Réservation refusée. Le client a été remboursé.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Studio ou artiste annule une réservation.
     */
    public function cancel(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        try {
            $role = auth()->user()->profile === 'artist' ? 'artist' : 'studio';

            if ($role === 'artist') {
                Gate::authorize('cancelAsArtist', $reservation);
            } else {
                Gate::authorize('manageAsStudio', $reservation);
            }

            $this->updateReservationStatusAction->execute($reservation, ReservationStatus::Cancelled, $role);
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation annulée. Un remboursement a été initié.', 'new_status' => ReservationStatus::Cancelled->value]);
            }
            return redirect()->back()->with('success', 'Réservation annulée. Un remboursement a été initié.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function complete(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('manageAsStudio', $reservation);

        // Vérification du code PIN
        if ($reservation->pin_code && $request->input('pin_code') !== $reservation->pin_code) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Le code PIN est incorrect.'], 422);
            }
            return redirect()->back()->with('error', 'Le code PIN entré est incorrect.');
        }

        // Bloquer si la réservation est en litige
        if ($reservation->disputed_at) {
             return redirect()->back()->with('error', 'Impossible de terminer : cette réservation est en litige.');
        }

        try {
            $this->updateReservationStatusAction->execute($reservation, ReservationStatus::Completed, 'studio');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Session terminée avec succès !', 'new_status' => ReservationStatus::Completed->value]);
            }
            return redirect()->back()->with('success', 'Session terminée avec succès !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dispute(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        $role = auth()->user()->profile === 'artist' ? 'artist' : 'studio';

        if ($role === 'artist') {
            Gate::authorize('cancelAsArtist', $reservation);
        } else {
            Gate::authorize('manageAsStudio', $reservation);
        }

        if ($reservation->status !== \App\Enums\ReservationStatus::Confirmed) {
            return redirect()->back()->with('error', 'Vous ne pouvez signaler un litige que sur une réservation confirmée.');
        }

        try {
            $reservation->update([
                'disputed_at' => now(),
                'dispute_reason' => $request->input('reason', 'Signalé par l\'utilisateur.'),
            ]);

            return redirect()->back()->with('success', 'Le litige a bien été signalé. Les fonds sont gelés jusqu\'à résolution.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du signalement.');
        }
    }

    /**
     * Artiste note la session terminée.
     */
    public function rate(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('rate', $reservation);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($reservation->status !== ReservationStatus::Completed) {
            return redirect()->back()->with('error', 'Vous ne pouvez noter que les sessions terminées.');
        }

        if ($reservation->rating) {
            return redirect()->back()->with('error', 'Vous avez déjà noté cette session.');
        }

        $reservation->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Merci pour votre avis !');
    }
}
