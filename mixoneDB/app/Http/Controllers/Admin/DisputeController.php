<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Illuminate\Http\Request;

class DisputeController extends Controller
{
    /**
     * Liste des litiges en cours.
     */
    public function liste(Request $request)
    {
        $query = Reservation::with(['client', 'studio']);

        // Par défaut, afficher uniquement les litiges en cours. 
        // Si on a un filtre status = 'all', on affiche l'historique des litiges.
        if ($request->input('status') === 'all') {
            $query->whereNotNull('disputed_at');
        } else {
            $query->where('status', ReservationStatus::Disputed);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Recherche par ID de réservation
                $q->where('id', 'like', "%{$search}%")
                // Recherche par nom de client ou pseudo
                ->orWhereHas('client', function($qClient) use ($search) {
                    $qClient->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                })
                // Recherche par nom de studio
                ->orWhereHas('studio', function($qStudio) use ($search) {
                    $qStudio->where('name', 'like', "%{$search}%");
                });
            });
        }

        $disputes = $query->orderBy('disputed_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.disputes.index', compact('disputes'));
    }

    /**
     * Détails d'un litige.
     */
    public function afficher(Reservation $reservation)
    {
        $reservation->load(['client', 'studio.proprietaire']);
        
        // Récupérer les messages entre l'artiste et le propriétaire du studio
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

        return view('admin.disputes.show', [
            'reservation' => $reservation,
            'messages' => $messages
        ]);
    }

    /**
     * Résoudre un litige.
     */
    public function resoudre(Request $requete, Reservation $reservation)
    {
        $action = $requete->input('action'); // 'complete' ou 'cancel'
        $notesAdmin = $requete->input('admin_notes');
        
        $reservation->admin_notes = $notesAdmin;

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

