<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    /**
     * Effectue une demande de virement du solde vers un compte bancaire.
     *
     * @param Request $requete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function demanderVirement(Request $requete)
    {
        $utilisateur = Auth::user();
        $portefeuille = $utilisateur->portefeuille;

        if (!$portefeuille) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de portefeuille actif.');
        }

        $requete->validate([
            'amount' => 'required|numeric|min:10|max:' . ($portefeuille->balance ?? 0),
            'iban' => ['required', 'string', 'regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{11,30}$/i'],
        ], [
            'iban.regex' => 'Le format de l\'IBAN est invalide (ex: FR76...).',
            'amount.max' => 'Vous ne pouvez pas retirer plus que votre solde actuel (' . ($portefeuille->balance ?? 0) . '€).',
        ]);

        try {
            $portefeuille->demanderVirement($requete->amount, $requete->iban);
            return redirect()->back()->with('success', 'Votre demande de virement a été enregistrée avec succès. Elle sera traitée sous peu.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur demande virement', [
                'user_id' => $utilisateur->id,
                'amount' => $requete->amount,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Impossible de traiter votre demande de virement pour le moment. Veuillez vérifier vos informations et réessayer.');
        }
    }

}
