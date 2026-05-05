<?php

namespace App\Http\Controllers\Studio;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $reservations = Reservation::forStudioOwner($user->id)
            ->with(['studio', 'user'])
            ->get();

        // Portefeuille du studio
        $wallet = $user->wallet;

        // Gains totaux = réservations terminées
        $totalEarned = $reservations
            ->filter(fn ($r) => $r->status === ReservationStatus::Completed)
            ->sum('price');

        $totalPending = $reservations
            ->filter(fn ($r) => in_array($r->status, [ReservationStatus::Confirmed, ReservationStatus::Pending]))
            ->sum('price');

        // Préparation des données pour le graphe de gains par mois
        $chartData = $reservations
            ->filter(fn ($r) => $r->status === ReservationStatus::Completed)
            ->groupBy(fn ($r) => $r->created_at->format('M'))
            ->map(fn ($row) => $row->sum('price'));

        return view('dashboard.studio.dashboard', compact('reservations', 'wallet', 'totalEarned', 'totalPending', 'chartData'));
    }

    public function booking(Request $request): View
    {
        $query = $request->get('query');

        $baseQuery = Reservation::forStudioOwner(Auth::id())
            ->with(['user', 'studio']);

        if ($query) {
            $baseQuery->where(function ($q) use ($query) {
                $q->where('reservations.id', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('email', 'LIKE', "%{$query}%")
                            ->orWhere('first_name', 'LIKE', "%{$query}%")
                            ->orWhere('last_name', 'LIKE', "%{$query}%");
                    })
                    ->orWhere('reservations.status', 'LIKE', "%{$query}%")
                    ->orWhere('reservations.price', 'LIKE', "%{$query}%");
            });
        }

        $reservations = $baseQuery->get();

        return view('dashboard.studio.booking', compact('reservations', 'query'));
    }

    public function studioList(): View
    {
        $studios = Studio::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('dashboard.studio.myStudios', compact('studios'));
    }
}
