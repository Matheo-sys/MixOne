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

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'studio.user']);
        
        // Fetch messages between the artist and studio owner
        $messages = \App\Models\Message::where(function($q) use ($reservation) {
                $q->where('sender_id', $reservation->user_id)
                  ->where('receiver_id', $reservation->studio->user_id);
            })
            ->orWhere(function($q) use ($reservation) {
                $q->where('sender_id', $reservation->studio->user_id)
                  ->where('receiver_id', $reservation->user_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.disputes.show', compact('reservation', 'messages'));
    }

    public function resolve(Request $request, Reservation $reservation)
    {
        $action = $request->input('action'); // 'complete' or 'cancel'
        $adminNotes = $request->input('admin_notes');
        
        $reservation->admin_notes = $adminNotes;

        if ($action === 'complete') {
            $reservation->status = ReservationStatus::Completed;
            $reservation->save();
            return redirect()->route('admin.disputes.index')->with('success', 'Litige résolu : La session a été marquée comme terminée.');
        } elseif ($action === 'cancel') {
            $reservation->status = ReservationStatus::Cancelled;
            $reservation->save();
            return redirect()->route('admin.disputes.index')->with('success', 'Litige résolu : La session a été annulée.');
        }

        return back()->with('error', 'Action invalide.');
    }
}
