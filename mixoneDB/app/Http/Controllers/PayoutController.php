<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function requestPayout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'iban' => 'required|string|min:15',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;

        if (!$wallet) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de portefeuille actif.');
        }

        try {
            $wallet->requestPayout($request->amount, $request->iban);
            return redirect()->back()->with('success', 'Votre demande de virement a été enregistrée avec succès. Elle sera traitée sous peu.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
