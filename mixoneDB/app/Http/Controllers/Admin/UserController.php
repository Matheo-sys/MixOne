<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs.
     */
    public function liste(Request $request): View
    {
        $query = User::query();

        // Filtre Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Filtre Profil
        if ($request->filled('profile') && in_array($request->profile, ['artist', 'studio'])) {
            $query->where('profile', $request->profile);
        }

        // Filtre Statut
        if ($request->filled('status')) {
            if ($request->status === 'banned') {
                $query->whereNotNull('banned_at');
            } elseif ($request->status === 'verified') {
                $query->whereNotNull('email_verified_at')->whereNull('banned_at');
            } elseif ($request->status === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        // Toujours garder les filtres pendant la pagination
        $utilisateurs = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.users.index', ['users' => $utilisateurs]);
    }

    /**
     * Détails d'un utilisateur.
     */
    public function afficher(User $user): View
    {
        $user->load([
            'studios', 
            'reservations.studio', 
            'reservationsRecues.client',
            'portefeuille.transactions' => function($query) {
                $query->orderBy('created_at', 'desc')->limit(10);
            }
        ]);

        // Signalements (reçus et envoyés)
        $reportsReceived = \App\Models\Report::where('reported_id', $user->id)->with('reporter')->orderBy('created_at', 'desc')->get();
        $reportsSent = \App\Models\Report::where('reporter_id', $user->id)->with('reported')->orderBy('created_at', 'desc')->get();

        // Litiges
        $disputes = \App\Models\Reservation::where(function($q) use ($user) {
            $q->where('user_id', $user->id)->orWhereHas('studio', fn($sq) => $sq->where('user_id', $user->id));
        })->where('status', \App\Enums\ReservationStatus::Disputed)->with('studio')->orderBy('updated_at', 'desc')->get();

        // Virements
        $payouts = \App\Models\PayoutRequest::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('admin.users.show', compact('user', 'reportsReceived', 'reportsSent', 'disputes', 'payouts'));
    }

    /**
     * Basculer le statut administrateur.
     */
    public function basculerAdmin(User $user): RedirectResponse
    {
        // Empêcher de s'enlever soi-même les droits admin pour éviter d'être bloqué
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas retirer vos propres droits administrateur.');
        }

        $user->update(['is_admin' => !$user->is_admin]);
        
        $message = $user->is_admin 
            ? "L'utilisateur est désormais administrateur." 
            : "Les droits administrateur ont été retirés.";

        return back()->with('success', $message);
    }

    /**
     * Bannir un utilisateur.
     */
    public function bannir(User $user, Request $request): RedirectResponse
    {
        $user->update([
            'banned_at' => now(),
            'ban_reason' => $request->input('reason', 'Violation des conditions d\'utilisation.')
        ]);
        return back()->with('success', 'Utilisateur banni avec succès.');
    }

    /**
     * Débannir un utilisateur.
     */
    public function debannir(User $user): RedirectResponse
    {
        $user->update([
            'banned_at' => null,
            'ban_reason' => null
        ]);
        return back()->with('success', 'Utilisateur débanni avec succès.');
    }

    /**
     * Vérifier manuellement l'email.
     */
    public function verifierEmail(User $user): RedirectResponse
    {
        $user->email_verified_at = now();
        $user->save();
        return back()->with('success', "L'email de l'utilisateur a été vérifié manuellement.");
    }

    /**
     * Envoyer un message admin à l'utilisateur.
     */
    public function envoyerMessage(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $admin = auth()->user();
        
        \App\Models\Message::create([
            'sender_id' => $admin->id,
            'receiver_id' => $user->id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', "Message envoyé avec succès à l'utilisateur.");
    }
}

