<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Liste toutes les réservations.
     */
    public function liste(Request $request)
    {
        $query = Reservation::with(['client', 'studio']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Recherche par ID de réservation
                $q->where('id', 'like', "%{$search}%")
                // Recherche par nom de client ou pseudo
                ->orWhereHas('client', function($qClient) use ($search) {
                    $qClient->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                })
                // Recherche par nom de studio
                ->orWhereHas('studio', function($qStudio) use ($search) {
                    $qStudio->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        return view('admin.reservations.index', compact('reservations'));
    }
}

