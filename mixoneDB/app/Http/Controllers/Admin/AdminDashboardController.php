<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        // Statistiques globales
        $totalUsers = User::count();
        $totalStudios = Studio::count();
        
        // Chiffre d'affaires total (réservations terminées)
        $totalVolume = Reservation::where('status', \App\Enums\ReservationStatus::Completed)->sum('price');
        
        // Commissions MixOne (ex: 10% par défaut)
        $commissionRate = config('services.stripe.commission_rate', 10) / 100;
        $totalCommission = $totalVolume * $commissionRate;

        // Litiges en attente
        $pendingDisputes = Reservation::where('status', \App\Enums\ReservationStatus::Disputed)->count();

        // Demandes de virements en attente
        $pendingPayouts = \App\Models\PayoutRequest::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStudios',
            'totalVolume',
            'totalCommission',
            'pendingDisputes',
            'pendingPayouts'
        ));
    }
}
