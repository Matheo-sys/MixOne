<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $view = auth()->user()->profile == 'artist' ? 'dashboard.artist.booking' : 'dashboard.studio.dashboard';
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Version 2 : Requête directe sécurisée
        $reservations = Reservation::where('user_id', auth()->id())
            ->with('studio')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view($view, compact('reservations'));
    }
}
