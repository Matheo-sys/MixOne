<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeConnectController extends Controller
{
    public function __construct(
        private readonly StripeService $stripeService
    ) {}

    /**
     * Initie le flux d'onboarding Stripe Connect pour un studio.
     */
    public function onboard(Request $request)
    {
        $user = auth()->user();

        try {
            // Si l'utilisateur n'a pas encore de compte Stripe, on lui en crée un
            if (!$user->stripe_account_id) {
                $account = $this->stripeService->creerCompteConnect($user->email);
                $user->update(['stripe_account_id' => $account->id]);
            }

            // Création du lien d'onboarding
            $accountLink = $this->stripeService->creerLienCompteConnect(
                $user->stripe_account_id,
                route('stripe.connect.return'),
                route('stripe.connect.refresh')
            );

            // Redirection vers le portail d'onboarding de Stripe
            return redirect($accountLink->url);

        } catch (\Exception $e) {
            Log::error('Erreur Onboarding Stripe Connect', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('dashboard.studio')
                ->with('error', 'Erreur Stripe : ' . $e->getMessage());
        }
    }

    /**
     * URL de retour après un onboarding réussi (ou complété).
     */
    public function return(Request $request)
    {
        return redirect()->route('dashboard.studio')
            ->with('success', 'Votre compte bancaire a bien été connecté via Stripe ! Les paiements vous seront désormais virés automatiquement.');
    }

    /**
     * URL de rafraichissement si le lien a expiré ou si l'utilisateur est revenu en arrière.
     */
    public function refresh(Request $request)
    {
        return redirect()->route('stripe.connect.onboard');
    }
}
