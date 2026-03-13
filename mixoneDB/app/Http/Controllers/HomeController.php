<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reservationStats = \App\Models\Reservation::whereNotNull('rating')
            ->selectRaw('COUNT(*) as total_ratings, AVG(rating) as avg_rating')
            ->first();

        $totalReservations = \App\Models\Reservation::count();
        $satisfiedClients = $totalReservations;
        $globalRating = $reservationStats->avg_rating ? round($reservationStats->avg_rating, 2) : 4.88;

        return view('pages.home', [
            'whiteHeader'       => false,
            'studios'           => Studio::all(),
            'satisfiedClients'  => $satisfiedClients,
            'globalRating'      => $globalRating
        ]);
    }
}
