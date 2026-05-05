<?php

namespace App\Http\Controllers\Artist;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $reservations = Reservation::forArtist($user->id)
            ->with(['studio', 'user'])
            ->get();

        // Calculer les dépenses totales (réservations confirmées ou terminées)
        $totalSpent = $reservations
            ->filter(fn ($r) => in_array($r->status, [ReservationStatus::Confirmed, ReservationStatus::Completed]))
            ->sum('price');

        return view('dashboard.artist.index', compact('wallet', 'reservations', 'totalSpent'));
    }

    public function booking(): View
    {
        $reservations = Reservation::forArtist(Auth::id())
            ->with(['studio', 'user'])
            ->get();

        return view('dashboard.artist.booking', compact('reservations'));
    }
}
