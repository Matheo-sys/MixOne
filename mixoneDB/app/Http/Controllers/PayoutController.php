<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function requestPayout(Request $request)
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        if (!$wallet) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de portefeuille actif.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:10|max:' . ($wallet->balance ?? 0),
            'iban' => ['required', 'string', 'regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{11,30}$/i'],
        ], [
            'iban.regex' => 'Le format de l\'IBAN est invalide (ex: FR76...).',
            'amount.max' => 'Vous ne pouvez pas retirer plus que votre solde actuel (' . ($wallet->balance ?? 0) . '€).',
        ]);

        try {
            $wallet->requestPayout($request->amount, $request->iban);
            return redirect()->back()->with('success', 'Votre demande de virement a été enregistrée avec succès. Elle sera traitée sous peu.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
