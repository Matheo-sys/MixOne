<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Illuminate\Http\Request;

class DisputeController extends Controller
{
    public function index()
    {
        $disputes = Reservation::where('status', ReservationStatus::Disputed)
            ->with(['user', 'studio'])
            ->orderBy('disputed_at', 'desc')
            ->paginate(20);

        return view('admin.disputes.index', compact('disputes'));
    }

    public function resolve(Request $request, Reservation $reservation)
    {
        $action = $request->input('action'); // 'complete' or 'cancel'
        
        if ($action === 'complete') {
            $reservation->update(['status' => ReservationStatus::Completed]);
            return back()->with('success', 'Litige résolu : La session a été marquée comme terminée.');
        } elseif ($action === 'cancel') {
            $reservation->update(['status' => ReservationStatus::Cancelled]);
            return back()->with('success', 'Litige résolu : La session a été annulée.');
        }

        return back()->with('error', 'Action invalide.');
    }
}
