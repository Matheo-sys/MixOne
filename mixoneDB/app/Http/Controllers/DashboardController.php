<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        if (Auth::user()->profile === 'artist') {
            return redirect()->route('dashboard.artist.index');
        }

        return redirect()->route('dashboard.studio');
    }

    public function artistIndex(): View
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

    public function bookingArtist(): View
    {
        $reservations = Reservation::forArtist(Auth::id())
            ->with(['studio', 'user'])
            ->get();

        return view('dashboard.artist.booking', compact('reservations'));
    }

    public function studioIndex(): View
    {
        $user = Auth::user();
        $reservations = Reservation::forStudioOwner($user->id)
            ->with(['studio', 'user'])
            ->get();

        // Portefeuille du studio (s'il existe, sinon on fournit un pseudo-wallet vide pour la vue)
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

    public function studioBooking(Request $request): View
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

    public function rechargeWallet(Request $request): RedirectResponse
    {
        // Sécurité : cette route ne devrait pas exister en production
        if (app()->isProduction()) {
            abort(403, 'Route désactivée en production.');
        }

        $user = Auth::user();
        if (!$user->wallet) {
            $user->wallet()->create();
            $user->refresh();
        }

        // Ajout de 100€ pour la démo avec historisation
        $user->wallet->deposit(100, 'Rechargement de test via carte fictive');

        return redirect()->back()->with('success', 'Votre portefeuille a été crédité de 100€ avec succès !');
    }
}
