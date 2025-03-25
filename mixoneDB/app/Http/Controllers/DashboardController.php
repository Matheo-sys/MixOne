<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->profile == 'artist') {
            $view = 'dashboard.artist.booking';
            // Pour les artistes, récupérer les réservations où user_id correspond à l'artiste
            $reservations = Reservation::where('user_id', $user->id)
                ->with('studio')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $view = 'dashboard.studio.dashboard';
            // Pour un studio, récupérer les réservations des studios qui appartiennent à l'utilisateur connecté
            $reservations = Reservation::whereIn('studio_id', function($query) use ($user) {
                $query->select('id')
                    ->from('studios')
                    ->where('user_id', $user->id);
            })
                ->with('studio')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view($view, compact('reservations'));
    }

}
