<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Affiche les statistiques globales pour l'administration.
     */
    public function afficher(): \Illuminate\Contracts\View\View
    {
        $now = now();
        $thirtyDaysAgo = now()->subDays(30);

        // 1. Métriques Financières
        $volumeTotal = Reservation::where('status', \App\Enums\ReservationStatus::Completed)->sum('price');
        $volume30Jours = Reservation::where('status', \App\Enums\ReservationStatus::Completed)
                                     ->where('created_at', '>=', $thirtyDaysAgo)
                                     ->sum('price');
        
        $tauxCommission = config('services.stripe.commission_rate', 10) / 100;
        $commissionTotale = $volumeTotal * $tauxCommission;
        $commission30Jours = $volume30Jours * $tauxCommission;

        // 2. Utilisateurs & Croissance
        $totalUtilisateurs = User::count();
        $nouveauxUtilisateurs30j = User::where('created_at', '>=', $thirtyDaysAgo)->count();
        $utilisateursBannis = User::whereNotNull('banned_at')->count();

        // 3. Offre (Studios)
        $totalStudiosActifs = Studio::where('is_verified', true)->count();
        $studiosEnAttente = Studio::where('is_verified', false)->count();
        
        // 4. Modération & Litiges
        $litigesEnAttente = Reservation::where('status', \App\Enums\ReservationStatus::Disputed)->count();
        $virementsEnAttente = \App\Models\PayoutRequest::where('status', 'pending')->count();
        $imagesEnAttente = \App\Models\StudioImageRequest::where('status', 'pending')->count();

        // 5. Réservations
        $reservationsTotales = Reservation::count();
        $reservations30j = Reservation::where('created_at', '>=', $thirtyDaysAgo)->count();

        return view('admin.dashboard', compact(
            'volumeTotal', 'volume30Jours', 'commissionTotale', 'commission30Jours',
            'totalUtilisateurs', 'nouveauxUtilisateurs30j', 'utilisateursBannis',
            'totalStudiosActifs', 'studiosEnAttente',
            'litigesEnAttente', 'virementsEnAttente', 'imagesEnAttente',
            'reservationsTotales', 'reservations30j'
        ));
    }
}

