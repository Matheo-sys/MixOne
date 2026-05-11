<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;

use App\Actions\Reservation\CreateReservationAction;
use App\Actions\Reservation\UpdateReservationStatusAction;
use App\Enums\ReservationStatus;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Models\Reservation;
use App\Mail\ReservationConfirmedArtistMail;
use App\Mail\ReservationRefusedMail;
use App\Mail\ReservationCancelledMail;
use App\Mail\NewReviewMail;
use App\Mail\ReservationDisputedMail;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    /**
     * @param CreateReservationAction $actionCreerReservation
     * @param UpdateReservationStatusAction $actionMiseAJourStatutReservation
     * @param StripeService $serviceStripe
     */
    public function __construct(
        private readonly CreateReservationAction $actionCreerReservation,
        private readonly UpdateReservationStatusAction $actionMiseAJourStatutReservation,
        private readonly StripeService $serviceStripe
    ) {}

    /**
     * Créer la réservation puis rediriger vers Stripe Checkout.
     *
     * @param CreateReservationRequest $requete
     * @return RedirectResponse|JsonResponse
     */
    public function enregistrer(CreateReservationRequest $requete): RedirectResponse|JsonResponse
    {
        $reservation = null;
        try {
            $reservation = $this->actionCreerReservation->executer($requete->versDTO());

            try {
                // Créer la session Stripe Checkout
                $session = $this->serviceStripe->creerSessionPaiement(
                    reservationId: $reservation->id,
                    nomStudio: $reservation->studio->name,
                    date: $reservation->date->format('d/m/Y'),
                    creneauHoraire: $reservation->time_slot,
                    heures: $reservation->number_of_hours,
                    prix: (float) $reservation->price,
                    emailClient: auth()->user()->email,
                    stripeAccountId: $reservation->studio->proprietaire->stripe_account_id ?? null,
                );

                // Sauvegarder l'ID de session Stripe
                $reservation->update(['stripe_session_id' => $session->id]);

                // Rediriger vers Stripe Checkout
                if ($requete->ajax()) {
                    return response()->json([
                        'status'   => 'success',
                        'redirect' => $session->url,
                    ]);
                }

                return redirect($session->url);
            } catch (\Exception $eStripe) {
                // SI STRIPE ECHOUE (clé API, réseau, etc.) : on supprime la réservation pour libérer le créneau
                if ($reservation) {
                    $reservation->delete();
                }
                throw $eStripe;
            }
        } catch (\Exception $e) {
            $message = "Impossible de traiter la réservation : " . $e->getMessage();

            Log::error('Erreur création réservation/paiement', [
                'error' => $e->getMessage(),
                'user'  => auth()->id(),
            ]);

            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $message], 422);
            }

            return back()->withInput()->withErrors(['booking_error' => $message]);
        }
    }

    /**
     * Studio confirme une réservation en attente.
     *
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function confirmer(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('gererEnTantQueStudio', $reservation);

        try {
            $this->actionMiseAJourStatutReservation->executer($reservation, ReservationStatus::Confirmed, 'studio');

            // Envoyer l'email avec le code PIN à l'artiste
            if ($reservation->client && $reservation->client->email) {
                Mail::to($reservation->client->email)->queue(new ReservationConfirmedArtistMail($reservation));
            }

            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation confirmée avec succès !', 'new_status' => ReservationStatus::Confirmed->value]);
            }
            return redirect()->back()->with('success', 'Réservation confirmée !');
        } catch (\Exception $e) {
            $msg = "Erreur lors de la confirmation : " . $e->getMessage();
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Studio refuse une réservation en attente.
     *
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function refuser(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('gererEnTantQueStudio', $reservation);

        try {
            $this->actionMiseAJourStatutReservation->executer($reservation, ReservationStatus::Refused, 'studio');
            
            // Envoyer l'email de refus à l'artiste
            if ($reservation->client && $reservation->client->email) {
                try {
                    Mail::to($reservation->client->email)->queue(new ReservationRefusedMail($reservation));
                } catch (\Exception $e) { report($e); }
            }

            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation refusée. Le client sera remboursé.', 'new_status' => ReservationStatus::Refused->value]);
            }
            return redirect()->back()->with('success', 'Réservation refusée. Le client a été remboursé.');
        } catch (\Exception $e) {
            $msg = "Erreur lors du refus : " . $e->getMessage();
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Studio ou artiste annule une réservation.
     *
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function annuler(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        try {
            $role = auth()->user()->profile === 'artist' ? 'artist' : 'studio';

            if ($role === 'artist') {
                Gate::authorize('annulerEnTantQuArtiste', $reservation);
            } else {
                Gate::authorize('gererEnTantQueStudio', $reservation);
            }

            $this->actionMiseAJourStatutReservation->executer($reservation, ReservationStatus::Cancelled, $role);
            
            // Envoyer l'email d'annulation à l'AUTRE partie
            $destinataire = ($role === 'artist') ? $reservation->studio->proprietaire : $reservation->client;
            if ($destinataire && $destinataire->email) {
                try {
                    Mail::to($destinataire->email)->queue(new ReservationCancelledMail($reservation, $role));
                } catch (\Exception $e) { report($e); }
            }

            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation annulée. Un remboursement a été initié.', 'new_status' => ReservationStatus::Cancelled->value]);
            }
            return redirect()->back()->with('success', 'Réservation annulée. Un remboursement a été initié.');
        } catch (\Exception $e) {
            $msg = "Erreur lors de l'annulation : " . $e->getMessage();
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function terminer(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('gererEnTantQueStudio', $reservation);

        // Vérification du code PIN
        if ($reservation->pin_code && $requete->input('pin_code') !== $reservation->pin_code) {
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Le code PIN est incorrect.'], 422);
            }
            return redirect()->back()->with('error', 'Le code PIN entré est incorrect.');
        }

        // Bloquer si la réservation est en litige
        if ($reservation->disputed_at) {
            return redirect()->back()->with('error', 'Impossible de terminer : cette réservation est en litige.');
        }

        try {
            $this->actionMiseAJourStatutReservation->executer($reservation, ReservationStatus::Completed, 'studio');
            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Session terminée avec succès !', 'new_status' => ReservationStatus::Completed->value]);
            }
            return redirect()->back()->with('success', 'Session terminée avec succès !');
        } catch (\Exception $e) {
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function litige(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        $role = auth()->user()->profile === 'artist' ? 'artist' : 'studio';

        if ($role === 'artist') {
            Gate::authorize('annulerEnTantQuArtiste', $reservation);
        } else {
            Gate::authorize('gererEnTantQueStudio', $reservation);
        }

        if ($reservation->status !== \App\Enums\ReservationStatus::Confirmed) {
            return redirect()->back()->with('error', 'Vous ne pouvez signaler un litige que sur une réservation confirmée.');
        }

        $requete->validate([
            'dispute_reason' => 'required|string|max:255',
            'dispute_description' => 'required|string|max:2000',
            'dispute_image' => 'nullable|image|max:5120',
        ]);

        try {
            $cheminImage = null;
            if ($requete->hasFile('dispute_image')) {
                $cheminImage = $requete->file('dispute_image')->store('dispute_proofs', 'public');
            }

            $reservation->update([
                'disputed_at' => now(),
                'dispute_reason' => $requete->input('dispute_reason'),
                'dispute_description' => $requete->input('dispute_description'),
                'dispute_image' => $cheminImage,
                'status' => \App\Enums\ReservationStatus::Disputed,
            ]);

            // Prévenir l'autre partie
            $destinataire = ($role === 'artist') ? $reservation->studio->proprietaire : $reservation->client;
            if ($destinataire && $destinataire->email) {
                try {
                    Mail::to($destinataire->email)->queue(new ReservationDisputedMail($reservation, $role));
                } catch (\Exception $e) { report($e); }
            }
            
            // On pourrait aussi prévenir l'admin ici si besoin
            // Mail::to(config('mail.from.address'))->send(new ReservationDisputedMail($reservation, $role));

            return redirect()->back()->with('success', 'Le litige a bien été signalé. Les fonds sont gelés jusqu\'à résolution par l\'administration.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du signalement : ' . $e->getMessage());
        }
    }

    /**
     * Artiste note la session terminée.
     *
     * @param Request $requete
     * @param Reservation $reservation
     * @return RedirectResponse|JsonResponse
     */
    public function noter(Request $requete, Reservation $reservation): RedirectResponse|JsonResponse
    {
        Gate::authorize('noter', $reservation);

        $requete->validate([
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
            'rating' => $requete->rating,
            'comment' => $requete->comment,
        ]);

        // Prévenir le propriétaire du studio
        $proprietaire = $reservation->studio->proprietaire;
        if ($proprietaire && $proprietaire->email) {
            try {
                Mail::to($proprietaire->email)->queue(new NewReviewMail($reservation));
            } catch (\Exception $e) { report($e); }
        }

        return redirect()->back()->with('success', 'Merci pour votre avis !');
    }
}
