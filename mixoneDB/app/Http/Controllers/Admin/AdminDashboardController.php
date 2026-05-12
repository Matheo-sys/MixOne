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
    public function afficher(Request $request): \Illuminate\Contracts\View\View
    {
        $now = now();
        $period = $request->input('period', '30'); // Par défaut 30 jours
        
        $startDate = null;
        $periodLabel = '30 derniers jours';

        if ($period == '7') {
            $startDate = now()->subDays(7);
            $periodLabel = '7 derniers jours';
        } elseif ($period == '30') {
            $startDate = now()->subDays(30);
            $periodLabel = '30 derniers jours';
        } elseif ($period == 'all') {
            $startDate = now()->subYears(100); // Hack simple pour tout avoir
            $periodLabel = 'Depuis toujours';
        } else {
            // Fallback
            $startDate = now()->subDays(30);
            $period = '30';
        }

        // 1. Métriques Financières
        $volumeTotal = Reservation::where('status', \App\Enums\ReservationStatus::Completed)->sum('price');
        $volumePeriode = Reservation::where('status', \App\Enums\ReservationStatus::Completed)
                                     ->where('created_at', '>=', $startDate)
                                     ->sum('price');
        
        $tauxCommission = config('services.stripe.commission_rate', 10) / 100;
        $commissionTotale = $volumeTotal * $tauxCommission;
        $commissionPeriode = $volumePeriode * $tauxCommission;

        // 2. Utilisateurs & Croissance
        $totalUtilisateurs = User::count();
        $nouveauxUtilisateursPeriode = User::where('created_at', '>=', $startDate)->count();
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
        $reservationsPeriode = Reservation::where('created_at', '>=', $startDate)->count();

        return view('admin.dashboard', compact(
            'volumeTotal', 'volumePeriode', 'commissionTotale', 'commissionPeriode',
            'totalUtilisateurs', 'nouveauxUtilisateursPeriode', 'utilisateursBannis',
            'totalStudiosActifs', 'studiosEnAttente',
            'litigesEnAttente', 'virementsEnAttente', 'imagesEnAttente',
            'reservationsTotales', 'reservationsPeriode', 'period', 'periodLabel'
        ));
    }
}

