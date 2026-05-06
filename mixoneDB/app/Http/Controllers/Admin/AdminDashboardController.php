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
    public function index(): \Illuminate\Contracts\View\View
    {
        // Statistiques globales
        $totalUtilisateurs = User::count();
        $totalStudios = Studio::count();
        
        // Chiffre d'affaires total (réservations terminées)
        $volumeTotal = Reservation::where('status', \App\Enums\ReservationStatus::Completed)->sum('price');
        
        // Commissions MixOne (ex: 10% par défaut)
        $tauxCommission = config('services.stripe.commission_rate', 10) / 100;
        $commissionTotale = $volumeTotal * $tauxCommission;

        // Litiges en attente
        $litigesEnAttente = Reservation::where('status', \App\Enums\ReservationStatus::Disputed)->count();

        // Demandes de virements en attente
        $virementsEnAttente = \App\Models\PayoutRequest::where('status', 'pending')->count();

        return view('admin.dashboard', [
            'totalUsers'       => $totalUtilisateurs,
            'totalStudios'     => $totalStudios,
            'totalVolume'      => $volumeTotal,
            'totalCommission'  => $commissionTotale,
            'pendingDisputes'  => $litigesEnAttente,
            'pendingPayouts'   => $virementsEnAttente,
        ]);
    }
}

