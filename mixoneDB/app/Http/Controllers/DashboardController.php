<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\SearchReservationsAction;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct(
        private SearchReservationsAction $searchReservationsAction
    ) {}

    public function index()
    {
        if (Auth::user()->profile == 'artist') {
            return redirect()->route('dashboard.artist.index');
        } else {
            return redirect()->route('dashboard.studio');
        }
    }

    public function artistIndex(): View
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $reservations = Reservation::getReservationArtist();
        
        // Calculer les dépenses totales (par exemple basé sur les paiements ou les réservations)
        // Ici on prend la somme des réservations passées (Terminées / Confirmées)
        $totalSpent = $reservations->filter(fn($r) => in_array(\Illuminate\Support\Str::lower($r->status), ['confirmée', 'terminée']))->sum('price');

        return view('dashboard.artist.index', compact('wallet', 'reservations', 'totalSpent'));
    }

    public function bookingArtist(): View
    {
        $reservations = Reservation::getReservationArtist();
        return view('dashboard.artist.booking', compact('reservations'));
    }

    public function studioIndex(): View
    {
        $user = Auth::user();
        $reservations = Reservation::getReservations();
        
        // Portefeuille du studio (s'il existe, sinon on fournit un pseudo-wallet vide pour la vue)
        $wallet = $user->wallet;
        
        // Gains totaux = somme des transactions 'earned' ou réservations terminées
        // Prenons les réservations terminées/confirmées pour l'instant
        $totalEarned = $reservations->filter(fn($r) => \Illuminate\Support\Str::lower($r->status) === 'terminée')->sum('price');
        $totalPending = $reservations->filter(fn($r) => in_array(\Illuminate\Support\Str::lower($r->status), ['confirmée', 'en attente']))->sum('price');

        // Préparation des données pour le graphe de gains par mois
        $chartData = $reservations->filter(fn($r) => \Illuminate\Support\Str::lower($r->status) === 'terminée')
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('M');
            })
            ->map(function ($row) {
                return $row->sum('price');
            });

        return view('dashboard.studio.dashboard', compact('reservations', 'wallet', 'totalEarned', 'totalPending', 'chartData'));
    }

    public function studioBooking(Request $request): View
    {
        $query = $request->get('query');
        $reservations = $this->searchReservationsAction->execute($query);
        
        return view('dashboard.studio.booking', compact('reservations', 'query'));
    }

    public function studioList(): View
    {
        $studios = Studio::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('dashboard.studio.myStudios', compact('studios'));
    }

    public function rechargeWallet(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->wallet) {
            $user->wallet()->create();
        }

        // Ajout magique de 100€ pour la démo avec historisation
        $user->wallet->deposit(100, 'Rechargement de test via carte fictive');

        return redirect()->back()->with('success', 'Votre portefeuille a été crédité de 100€ avec succès !');
    }
}
