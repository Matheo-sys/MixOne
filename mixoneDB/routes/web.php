<?php

use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Core\StudioController;
use App\Http\Controllers\Financial\StripeWebhookController;
use App\Http\Controllers\Financial\WalletController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

// Page d'accueil principale
Route::get('/test-mail', function() {
    try {
        \Illuminate\Support\Facades\Mail::raw('Test MixOne', function($message) {
            $message->to('mixone.contact@gmail.com')->subject('Diagnostic Mail');
        });
        return 'Tentative d\'envoi effectuée. Vérifie ta boîte (et tes spams) !';
    } catch (\Exception $e) {
        return 'Erreur lors de l\'envoi : ' . $e->getMessage();
    }
});

Route::get('/', [HomeController::class, 'afficher'])->name('home');

Route::get('/studios', [StudioController::class, 'liste'])->name('studios.index');
Route::get('/studios/rechercher', [StudioController::class, 'rechercher'])->name('studios.search');
Route::get('/studios/geocoder', [StudioController::class, 'rechercherGeocode'])->name('studios.geocode');
Route::get('/studios/geocoder-inverse', [StudioController::class, 'geocodeInverse'])->name('studios.reverse-geocode');
Route::get('/studios/{studio}', [StudioController::class, 'afficher'])->name('studios.show');
Route::get('/studios/{studio}/creneaux', [StudioController::class, 'recupererCreneauxDisponibles'])->name('studios.time-slots');

// Les routes sécurisées (Tableau de bord et Admin) sont désormais dans routes/dashboard.php et routes/admin.php
// Elles sont chargées automatiquement via bootstrap/app.php

// Pages publiques
Route::get('/devenir-expert', function() { return view('pages.become-expert'); })->name('become-expert');
Route::get('/contact', function() { return view('pages.contact'); })->name('contact');
Route::get('/conditions', function() { return view('pages.terms'); })->name('terms');
Route::get('/confidentialite', function() { return view('pages.privacy'); })->name('privacy');
Route::get('/mentions-legales', function() { return view('pages.legal'); })->name('legal');
Route::get('/a-propos', [AboutController::class, 'afficher'])->name('about');

// Contact POST
Route::post('/contact', [ContactController::class, 'envoyerEmail'])->name('send.email')->middleware('throttle:20,1');

// Portefeuille test (dev only)
Route::post('/portefeuille/recharge', [WalletController::class, 'recharger'])->name('wallet.recharge')->middleware('auth');

// Webhook Stripe
Route::post('/stripe/webhook', [StripeWebhookController::class, 'gerer'])->name('stripe.webhook');
