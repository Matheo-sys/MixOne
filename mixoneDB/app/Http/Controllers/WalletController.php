<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class WalletController extends Controller
{
    /**
     * Recharger le portefeuille de l'utilisateur (Dev uniquement).
     *
     * @param Request $requete
     * @return RedirectResponse
     */
    public function recharger(Request $requete): RedirectResponse
    {
        // Sécurité : cette route ne devrait pas exister en production
        if (app()->isProduction()) {
            abort(403, 'Route désactivée en production.');
        }

        $utilisateur = Auth::user();
        if (!$utilisateur->portefeuille) {
            $utilisateur->portefeuille()->create();
            $utilisateur->refresh();
        }

        // Ajout de 100€ pour la démo avec historisation
        $utilisateur->portefeuille->deposer(100, 'Rechargement de test via carte fictive');


        return redirect()->back()->with('success', 'Votre portefeuille a été crédité de 100€ avec succès !');
    }

}
