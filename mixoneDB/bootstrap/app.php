<?php

use Illuminate\Foundation\Application;

// Chargement des helpers personnalisés
require_once __DIR__ . '/../app/helpers.php';
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'verified'])
                ->prefix('tableau-de-bord')
                ->group(base_path('routes/dashboard.php'));

            \Illuminate\Support\Facades\Route::middleware(['web', 'auth', 'verified', 'admin'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');

        $middleware->validateCsrfTokens(except: [
            'stripe/webhook',
        ]);

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $middleware->appendToGroup('web', [
            \App\Http\Middleware\RedirectToMainDomain::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // ─── Gestion des erreurs pour les requêtes AJAX/API ───
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'La ressource demandée est introuvable.',
                ], 404);
            }
            return null; // Laisser le rendu par défaut (page 404 Blade)
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'L\'élément demandé n\'existe pas ou a été supprimé.',
                ], 404);
            }

            return redirect()->route('home')
                ->with('error', 'L\'élément que vous recherchez n\'existe pas ou a été supprimé.');
        });

        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vous n\'avez pas les droits nécessaires pour effectuer cette action.',
                ], 403);
            }

            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.');
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Votre session a expiré. Veuillez vous reconnecter.',
                ], 401);
            }
            return null; // Redirect par défaut vers login
        });

        $exceptions->render(function (TooManyRequestsHttpException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Trop de requêtes. Veuillez patienter quelques instants avant de réessayer.',
                ], 429);
            }

            return back()->with('error', 'Vous effectuez trop de requêtes. Merci de patienter quelques instants.');
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->ajax() || $request->wantsJson()) {
                $firstError = collect($e->errors())->flatten()->first();
                return response()->json([
                    'status' => 'error',
                    'message' => $firstError ?? 'Les données soumises sont invalides. Veuillez vérifier votre saisie.',
                    'errors' => $e->errors(),
                ], 422);
            }
            return null; // Redirect par défaut avec errors flashed
        });

        // ─── Filet de sécurité : toute exception non gérée ───
        $exceptions->render(function (\Throwable $e, Request $request) {
            // Ne pas intercepter les erreurs déjà gérées ci-dessus en production
            if (app()->environment('local')) {
                return null; // Afficher le détail en dev
            }

            // Erreurs Stripe spécifiques
            if ($e instanceof \Stripe\Exception\ApiErrorException) {
                \Illuminate\Support\Facades\Log::error('Erreur Stripe non interceptée', [
                    'message' => $e->getMessage(),
                    'stripe_code' => $e->getStripeCode(),
                    'url' => $request->fullUrl(),
                ]);

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Le service de paiement est temporairement indisponible. Veuillez réessayer.',
                    ], 503);
                }

                return back()->with('error', 'Le service de paiement est temporairement indisponible. Veuillez réessayer dans quelques instants.');
            }

            // Uniquement pour les erreurs 500 non interceptées
            if (!$e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                \Illuminate\Support\Facades\Log::error('Erreur non interceptée', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'url' => $request->fullUrl(),
                ]);

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Une erreur inattendue est survenue. Notre équipe technique a été notifiée. Veuillez réessayer.',
                    ], 500);
                }
            }

            return null; // Laisser le rendu par défaut pour les pages
        });
    })->create();
