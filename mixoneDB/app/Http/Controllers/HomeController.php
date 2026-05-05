<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $reservationStats = Reservation::whereNotNull('rating')
            ->selectRaw('COUNT(*) as total_ratings, AVG(rating) as avg_rating')
            ->first();

        $totalReservations = Reservation::count();
        $satisfiedClients = $totalReservations;
        $globalRating = $reservationStats->avg_rating ? round($reservationStats->avg_rating, 2) : 4.88;

        return view('pages.home', [
            'whiteHeader'       => false,
            'studios'           => Studio::where('is_verified', true)->latest()->limit(20)->get(),
            'satisfiedClients'  => $satisfiedClients,
            'globalRating'      => $globalRating,
        ]);
    }
}
