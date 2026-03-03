<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\SearchReservationsAction;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct(
        private SearchReservationsAction $searchReservationsAction
    ) {}

    public function index()
    {
        if (Auth::user()->profile == 'artist') {
            return redirect()->route('dashboard.artist.booking');
        } else {
            return redirect()->route('dashboard.studio');
        }
    }

    public function bookingArtist(): View
    {
        $reservations = Reservation::getReservationArtist();
        return view('dashboard.artist.booking', compact('reservations'));
    }

    public function studioIndex(): View
    {
        $reservations = Reservation::getReservations();
        return view('dashboard.studio.dashboard', compact('reservations'));
    }

    public function studioBooking(Request $request): View
    {
        $query = $request->get('query');
        $reservations = $this->searchReservationsAction->execute($query);
        
        return view('dashboard.studio.booking', compact('reservations', 'query'));
    }

    public function studioList(): View
    {
        $studios = Studio::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('dashboard.studio.myStudios', compact('studios'));
    }
}
