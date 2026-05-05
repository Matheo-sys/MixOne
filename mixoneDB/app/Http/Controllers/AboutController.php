<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $studioCount = Studio::count();
        $userCount = User::count();
        $reservationCount = Reservation::count();

        // Agrégation SQL directe au lieu de charger toute la collection en mémoire
        $totalRatings = Reservation::whereNotNull('rating')->count();
        $satisfiedRatings = Reservation::whereNotNull('rating')->where('rating', '>=', 4)->count();

        $satisfactionPercentage = $totalRatings > 0
            ? round(($satisfiedRatings / $totalRatings) * 100)
            : 99; // Valeur par défaut si aucun avis

        return view('pages.about', compact('studioCount', 'userCount', 'reservationCount', 'satisfactionPercentage'));
    }
}
