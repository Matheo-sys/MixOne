<?php
namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\User;
use App\Models\Reservation; // Ajoute cette ligne
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $studioCount = Studio::count();
        $userCount = User::count();
        
        $reservationCount = Reservation::count();
        $ratings = Reservation::whereNotNull('rating')->get();
        $totalRatings = $ratings->count();
        $satisfiedRatings = $ratings->where('rating', '>=', 4)->count();
        
        $satisfactionPercentage = $totalRatings > 0 
            ? round(($satisfiedRatings / $totalRatings) * 100) 
            : 99; // Valeur par défaut si aucun avis

        return view('pages.about', compact('studioCount', 'userCount', 'reservationCount', 'satisfactionPercentage'));
    }
}
