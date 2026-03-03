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
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return back()->withInput()->withErrors(['time_slot' => $e->getMessage()]);
        }
    }

    public function confirm(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        try {
            $this->updateReservationStatusAction->execute($reservation, 'Confirmée');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation confirmée !', 'new_status' => 'Confirmée']);
            }
            return redirect()->back()->with('success', 'Statut mis à jour avec succès !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cancel(Request $request, Reservation $reservation): RedirectResponse|JsonResponse
    {
        try {
            $this->updateReservationStatusAction->execute($reservation, 'Annulée');
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Réservation annulée.', 'new_status' => 'Annulée']);
            }
            return redirect()->back()->with('success', 'Réservation annulée avec succès !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
