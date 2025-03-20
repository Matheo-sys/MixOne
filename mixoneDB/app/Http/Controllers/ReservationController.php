<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'time_slot' => 'required',
            'studio_id' => 'required|exists:studios,id',
            'date'             => 'required|date',
            'number_of_hours'  => 'required|integer|min:1',
        ]);

        try {
            $reservation = new Reservation();
            $reservation->user_id = auth()->id();
            $reservation->studio_id = $request->studio_id;

            $reservation->date            = $request->input('date');
            $reservation->time_slot = $request->input('time_slot');
            $reservation->number_of_hours = $request->input('number_of_hours');

            if ($reservation->save()) {
                return redirect()->route('dashboard')->with('success', 'Réservation effectuée avec succès !');
            } else {
                return back()->with('error', 'Erreur lors de la réservation.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}
