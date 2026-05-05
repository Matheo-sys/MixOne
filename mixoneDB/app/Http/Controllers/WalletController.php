<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class WalletController extends Controller
{
    public function recharge(Request $request): RedirectResponse
    {
        // Sécurité : cette route ne devrait pas exister en production
        if (app()->isProduction()) {
            abort(403, 'Route désactivée en production.');
        }

        $user = Auth::user();
        if (!$user->wallet) {
            $user->wallet()->create();
            $user->refresh();
        }

        // Ajout de 100€ pour la démo avec historisation
        $user->wallet->deposit(100, 'Rechargement de test via carte fictive');

        return redirect()->back()->with('success', 'Votre portefeuille a été crédité de 100€ avec succès !');
    }
}
