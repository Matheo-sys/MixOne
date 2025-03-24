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
        $reservationCount = Reservation::count(); // Ajoute cette ligne

        return view('pages.about', compact('studioCount', 'userCount', 'reservationCount'));
    }
}
