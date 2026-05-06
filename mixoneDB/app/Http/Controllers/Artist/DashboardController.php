<?php

namespace App\Http\Controllers\Artist;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche l'accueil du tableau de bord artiste.
     *
     * @return View
     */
    public function index(): View
    {
        $utilisateur = Auth::user();
        $portefeuille = $utilisateur->portefeuille;
        $reservations = Reservation::pourArtiste($utilisateur->id)
            ->with(['studio', 'client'])
            ->get();

        // Calculer les dépenses totales (réservations confirmées ou terminées)
        $totalDepense = $reservations
            ->filter(fn ($r) => in_array($r->status, [ReservationStatus::Confirmed, ReservationStatus::Completed]))
            ->sum('price');

        return view('dashboard.artist.index', [
            'portefeuille' => $portefeuille,
            'reservations' => $reservations,
            'totalSpent' => $totalDepense
        ]);
    }

    /**
     * Affiche la liste des réservations de l'artiste.
     *
     * @return View
     */
    public function reservations(): View
    {
        $reservations = Reservation::pourArtiste(Auth::id())
            ->with(['studio', 'client'])
            ->get();

        return view('dashboard.artist.booking', compact('reservations'));
    }
}

