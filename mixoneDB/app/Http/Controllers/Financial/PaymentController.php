<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use App\Models\Reservation;
use App\Services\StripeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\MailNouvelleReservationStudio;

class PaymentController extends Controller
{
    /**
     * @param StripeService $serviceStripe
     */
    public function __construct(
        private readonly StripeService $serviceStripe
    ) {}

    /**
     * Créer une session Stripe Checkout et rediriger vers la page de paiement.
     *
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function caisse(Reservation $reservation): RedirectResponse
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
            $session = $this->serviceStripe->creerSessionPaiement(
                reservationId: $reservation->id,
                nomStudio: $reservation->studio->name,
                date: $reservation->date->format('d/m/Y'),
                creneauHoraire: $reservation->time_slot,
                heures: $reservation->number_of_hours,
                prix: (float) $reservation->price,
                emailClient: auth()->user()->email,
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
     *
     * @param Request $requete
     * @return View|RedirectResponse
     */
    public function succes(Request $requete): View|RedirectResponse
    {
        $idSession = $requete->get('session_id');

        if (!$idSession) {
            return redirect()->route('dashboard')->with('error', 'Session de paiement invalide.');
        }

        try {
            $session = $this->serviceStripe->recupererSession($idSession);
            $reservation = Reservation::where('stripe_session_id', $idSession)->firstOrFail();

            // Marquer comme payé si le paiement est complet
            if ($session->payment_status === 'paid' && $reservation->payment_status === PaymentStatus::Pending) {
                $reservation->update([
                    'payment_status'    => PaymentStatus::Paid,
                    'stripe_payment_id' => $session->payment_intent,
                ]);

                // Prévenir le studio par mail
                $proprietaireStudio = $reservation->studio->proprietaire;
                if ($proprietaireStudio && $proprietaireStudio->email) {
                    \Illuminate\Support\Facades\Mail::to($proprietaireStudio->email)->send(new MailNouvelleReservationStudio($reservation));
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
     *
     * @param Request $requete
     * @return View
     */
    public function annuler(Request $requete): View
    {
        $reservation = null;

        if ($requete->has('reservation_id')) {
            $reservation = Reservation::where('id', $requete->get('reservation_id'))
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('pages.payment.cancel', [
            'reservation' => $reservation?->load('studio'),
        ]);
    }
}

