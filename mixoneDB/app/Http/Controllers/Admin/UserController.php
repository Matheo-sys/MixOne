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
    public function index(): View
    {
        $utilisateurs = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', ['users' => $utilisateurs]);
    }

    /**
     * Détails d'un utilisateur.
     */
    public function afficher(User $utilisateur): View
    {
        return view('admin.users.show', ['user' => $utilisateur]);
    }

    /**
     * Bannir un utilisateur.
     */
    public function bannir(User $utilisateur): RedirectResponse
    {
        $utilisateur->update(['banned_at' => now()]);
        return back()->with('success', 'Utilisateur banni avec succès.');
    }

    /**
     * Débannir un utilisateur.
     */
    public function debannir(User $utilisateur): RedirectResponse
    {
        $utilisateur->update(['banned_at' => null]);
        return back()->with('success', 'Utilisateur débanni avec succès.');
    }

    /**
     * Vérifier manuellement l'email.
     */
    public function verifierEmail(User $utilisateur): RedirectResponse
    {
        $utilisateur->email_verified_at = now();
        $utilisateur->save();
        return back()->with('success', "L'email de l'utilisateur a été vérifié manuellement.");
    }
}

