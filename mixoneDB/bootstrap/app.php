<?php

use Illuminate\Foundation\Application;

// Chargement des helpers personnalisés
require_once __DIR__ . '/../app/helpers.php';
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        //
    })->create();
