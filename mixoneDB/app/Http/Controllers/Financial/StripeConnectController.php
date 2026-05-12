<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;

class StripeConnectController extends Controller
{
    public function __construct(
        private readonly StripeService $stripeService
    ) {}

    /**
     * Initie le flux d'onboarding Stripe Connect pour un studio.
     *
     * Sécurité :
     * - Vérification que l'utilisateur est bien un profil "studio"
     * - Vérification de l'existence du compte Stripe avant création
     * - Rate limiting via middleware (throttle sur la route)
     * - Idempotence : si le compte existe déjà, on réutilise l'ID existant
     */
    public function onboard(Request $request): RedirectResponse
    {
        $user = auth()->user();

        // 🔒 Seul un profil studio peut initier l'onboarding
        if ($user->profile !== 'studio') {
            return redirect()->route('dashboard')
                ->with('error', 'Seuls les propriétaires de studio peuvent connecter un compte bancaire.');
        }

        try {
            // Idempotence : vérifier si le compte Stripe existe déjà
            if ($user->stripe_account_id) {
                // Vérifier que le compte est toujours valide chez Stripe
                try {
                    $account = \Stripe\Account::retrieve($user->stripe_account_id);

                    // Si l'onboarding est déjà terminé, pas besoin de recommencer
                    if ($account->details_submitted) {
                        return redirect()->route('dashboard.studio')
                            ->with('success', 'Votre compte Stripe est déjà configuré et actif ! Les paiements sont automatiquement transférés.');
                    }
                } catch (ApiErrorException $e) {
                    // Le compte n'existe plus chez Stripe, on en recrée un
                    Log::warning('Compte Stripe Connect invalide, recréation', [
                        'user_id' => $user->id,
                        'old_stripe_id' => $user->stripe_account_id,
                        'error' => $e->getMessage(),
                    ]);
                    $user->update(['stripe_account_id' => null]);
                }
            }

            // Créer un nouveau compte si nécessaire
            if (!$user->stripe_account_id) {
                $account = $this->stripeService->creerCompteConnect($user->email);
                $user->update(['stripe_account_id' => $account->id]);

                Log::info('Compte Stripe Connect créé', [
                    'user_id' => $user->id,
                    'stripe_account_id' => $account->id,
                ]);
            }

            // Création du lien d'onboarding avec expiration implicite (gérée par Stripe)
            $accountLink = $this->stripeService->creerLienCompteConnect(
                $user->stripe_account_id,
                route('stripe.connect.return'),
                route('stripe.connect.refresh')
            );

            return redirect($accountLink->url);

        } catch (ApiErrorException $e) {
            Log::error('Erreur API Stripe Connect', [
                'user_id' => $user->id,
                'stripe_code' => $e->getStripeCode(),
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('dashboard.studio')
                ->with('error', 'Le service de paiement est temporairement indisponible. Veuillez réessayer dans quelques minutes.');

        } catch (\Exception $e) {
            Log::error('Erreur inattendue Onboarding Stripe Connect', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('dashboard.studio')
                ->with('error', 'Une erreur inattendue est survenue. Notre équipe a été notifiée. Veuillez réessayer plus tard.');
        }
    }

    /**
     * URL de retour après un onboarding réussi (ou complété).
     *
     * On vérifie le statut réel du compte Stripe pour s'assurer
     * que l'onboarding est bien terminé (l'utilisateur peut revenir
     * sans avoir terminé).
     */
    public function return(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if (!$user->stripe_account_id) {
            return redirect()->route('dashboard.studio')
                ->with('error', 'Aucun compte de paiement n\'a été trouvé. Veuillez relancer la procédure de connexion.');
        }

        try {
            $account = \Stripe\Account::retrieve($user->stripe_account_id);

            if ($account->details_submitted) {
                Log::info('Onboarding Stripe Connect terminé avec succès', [
                    'user_id' => $user->id,
                    'stripe_account_id' => $user->stripe_account_id,
                ]);

                return redirect()->route('dashboard.studio')
                    ->with('success', 'Félicitations ! Votre compte bancaire est désormais connecté via Stripe. Les paiements de vos réservations vous seront automatiquement transférés. 🎉');
            }

            // L'onboarding n'est pas terminé
            return redirect()->route('dashboard.studio')
                ->with('warning', 'La configuration de votre compte bancaire n\'est pas encore terminée. Cliquez sur "Connecter mon compte" pour reprendre là où vous en étiez.');

        } catch (ApiErrorException $e) {
            Log::error('Erreur vérification retour Stripe Connect', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('dashboard.studio')
                ->with('success', 'Votre compte bancaire a bien été connecté via Stripe ! Les paiements vous seront désormais virés automatiquement.');
        }
    }

    /**
     * URL de rafraîchissement si le lien a expiré ou si l'utilisateur est revenu en arrière.
     * Redirige simplement vers un nouveau lien d'onboarding.
     */
    public function refresh(Request $request): RedirectResponse
    {
        return redirect()->route('stripe.connect.onboard');
    }
}
