<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec les statistiques et les derniers studios.
     *
     * @return View
     */
    public function afficher(): View
    {
        $statsReservations = Reservation::whereNotNull('rating')
            ->selectRaw('COUNT(*) as total_ratings, AVG(rating) as avg_rating')
            ->first();

        $totalReservations = Reservation::count();
        $clientsSatisfaits = $totalReservations;
        $noteGlobale = $statsReservations->avg_rating ? round($statsReservations->avg_rating, 2) : 4.88;

        return view('pages.home', [
            'enTeteBlanc'       => false,
            'studios'           => Studio::where('is_verified', true)->latest()->limit(20)->get(),
            'clientsSatisfaits' => $clientsSatisfaits,
            'noteGlobale'       => $noteGlobale,
        ]);

    }

}
