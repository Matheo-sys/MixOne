<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'studio'])->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.reservations.index', compact('reservations'));
    }
}
