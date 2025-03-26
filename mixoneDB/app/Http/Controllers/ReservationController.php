<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time_slot' => 'required|string',
            'studio_id' => 'required|exists:studios,id',
            'date' => 'required|date|after_or_equal:today',
            'number_of_hours' => 'required|integer|min:1',
            'total_price' => 'required|numeric'
        ], [
            'date.required' => 'Veuillez sélectionner une date pour votre réservation.',
            'date.after_or_equal' => 'La date de réservation doit être aujourd\'hui ou une date future.',
            'time_slot.required' => 'Veuillez sélectionner un créneau horaire.',
            'number_of_hours.required' => 'Veuillez indiquer le nombre d\'heures.',
            'number_of_hours.min' => 'Le nombre d\'heures minimum est de 1.'
        ]);

        try {
            // Vérifier si le créneau est déjà réservé
            $existingReservation = Reservation::where('studio_id', $request->studio_id)
                ->where('date', $request->date)
                ->where('time_slot', $request->time_slot)
                ->exists();

            if ($existingReservation) {
                return back()->withInput()->withErrors(['time_slot' => 'Ce créneau horaire est déjà réservé.']);
            }

            $reservation = new Reservation();
            $reservation->user_id = auth()->id();
            $reservation->studio_id = $request->studio_id;
            $reservation->date = $validated['date'];
            $reservation->time_slot = $validated['time_slot'];
            $reservation->number_of_hours = $validated['number_of_hours'];
            $reservation->price = $validated['total_price'];
            $reservation->status = 'en attente';

            if ($reservation->save()) {
                return redirect()->route('dashboard')->with('success', 'Réservation effectuée avec succès !');
            } else {
                return back()->withInput()->with('error', 'Erreur lors de la réservation.');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function confirm(Reservation $reservation)
    {
        try {
            if ($reservation->status !== 'En attente') {
                throw new \Exception('Action non autorisée');
            }

            $reservation->update(['status' => 'Confirmée']);
            return redirect()->back()->with('success', 'Statut mis à jour avec succès !');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cancel(Reservation $reservation)
    {
        try {
            if (!in_array($reservation->status, ['En attente'])) {
                throw new \Exception('Action non autorisée');
            }

            $reservation->update(['status' => 'Annulée']);
            return redirect()->back()->with('success', 'Réservation annulée avec succès !');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $query = $request->input('query');

        $reservations = $query
            ? Reservation::with('user')
                ->where(function($q) use ($query) {
                    $q->where('id', 'LIKE', "%{$query}%")
                        ->orWhereHas('user', function($userQuery) use ($query) {
                            $userQuery->where('email', 'LIKE', "%{$query}%");
                        })
                        ->orWhere('status', 'LIKE', "%{$query}%")
                        ->orWhere('price', 'LIKE', "%{$query}%");
                })
                ->get()
            : Reservation::with('user')->get();

        return view('dashboard.studio.booking', [
            'reservations' => $reservations,
            'query' => $query
        ]);
    }
}
