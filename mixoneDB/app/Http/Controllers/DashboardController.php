<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index() {

        if( auth()->user()->profile == 'artist' ) return redirect(route('dashboard.artist.booking'));
        else return redirect(route('dashboard.studio'));

    }

    public function bookingArtist()
    {
        $reservations = Reservation::getReservationArtist();
        return view('dashboard.artist.booking', compact('reservations'));
    }

}
