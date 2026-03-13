<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateReservationAction;
use App\Actions\Reservation\UpdateReservationStatusAction;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(
        private CreateReservationAction $createReservationAction,
        private UpdateReservationStatusAction $updateReservationStatusAction
    ) {}

    public function store(CreateReservationRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $this->createReservationAction->execute($request->toDTO());
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation effectuée avec succès !', 'redirect' => route('dashboard')]);
            }
            return redirect()->route('dashboard')->with('success', 'Réservation effectuée avec succès !');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            
            // Si le solde est insuffisant, on redirige vers le dashboard artist (porte-monnaie)
            if (str_contains($message, 'Solde insuffisant')) {
                return redirect()->route('dashboard.artist.index')->with('error', "Solde insuffisant dans votre porte-monnaie. Veuillez le recharger avant de réserver.");
            }

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
        try {
            $this->updateReservationStatusAction->execute($reservation, 'Confirmée', 'studio');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation confirmée avec succès !', 'new_status' => 'Confirmée']);
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
        try {
            $this->updateReservationStatusAction->execute($reservation, 'Refusée', 'studio');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation refusée.', 'new_status' => 'Refusée']);
            }
            return redirect()->back()->with('success', 'Réservation refusée.');
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
            $this->updateReservationStatusAction->execute($reservation, 'Annulée', $role);
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation annulée.', 'new_status' => 'Annulée']);
            }
            return redirect()->back()->with('success', 'Réservation annulée.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function complete(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        try {
            $this->updateReservationStatusAction->execute($reservation, 'Terminée', 'studio');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation terminée. Les fonds ont été crédités.', 'new_status' => 'Terminée']);
            }
            return redirect()->back()->with('success', 'Réservation terminée. Les fonds ont été crédités.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Artiste note la session terminée.
     */
    public function rate(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if (strtolower($reservation->status) !== 'terminée') {
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
