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
    public function liste(): View
    {
        $utilisateurs = User::orderBy('created_at', 'desc')->paginate(20);
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

        return view('admin.users.show', ['user' => $user]);
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
    public function bannir(User $user): RedirectResponse
    {
        $user->update(['banned_at' => now()]);
        return back()->with('success', 'Utilisateur banni avec succès.');
    }

    /**
     * Débannir un utilisateur.
     */
    public function debannir(User $user): RedirectResponse
    {
        $user->update(['banned_at' => null]);
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
}

