<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Artist\DashboardController as ArtistDashboardController;
use App\Http\Controllers\Studio\DashboardController as StudioDashboardController;
use App\Http\Controllers\WalletController;

Auth::routes(['verify' => true]);

// Page d'accueil principale
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studios/search', [StudioController::class, 'rechercher'])->name('studios.search');
Route::get('/studios/geocode', [StudioController::class, 'rechercherGeocode'])->name('studios.geocode');
Route::get('/studios/reverse-geocode', [StudioController::class, 'geocodeInverse'])->name('studios.reverse-geocode');
Route::get('/studios/{studio}', [StudioController::class, 'afficher'])->name('studios.show');
Route::get('/studios/{studio}/time-slots', [StudioController::class, 'recupererCreneauxDisponibles'])->name('studios.time-slots');

// --- ZONE SÉCURISÉE (Auth + Verified) ---
Route::group(['middleware' => ['auth', 'verified']], function () {
    
    // Dashboard & Actions
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Artist Dashboard
        Route::group(['prefix' => 'artist'], function() {
            Route::get('/', [ArtistDashboardController::class, 'index'])->name('dashboard.artist.index');
            Route::get('/booking', [ArtistDashboardController::class, 'reservations'])->name('dashboard.artist.booking');
        });

        // Studio Dashboard
        Route::group(['prefix' => 'studio'], function() {
            Route::get('/', [StudioDashboardController::class, 'index'])->name('dashboard.studio');
            Route::get('/my-studios', [StudioDashboardController::class, 'listeStudios'])->name('dashboard.studio.myStudios');
            Route::get('/booking', [StudioDashboardController::class, 'reservations'])->name('dashboard.studio.booking');
            Route::get('/studios/create', [StudioController::class, 'creer'])->name('studio.create');
            Route::post('/studios', [StudioController::class, 'enregistrer'])->name('studio.store');
            Route::get('/studios/{studio}/edit', [StudioController::class, 'modifier'])->name('dashboard.studio.edit');
            Route::put('/studios/{studio}', [StudioController::class, 'mettreAJour'])->name('dashboard.studio.update');
            Route::delete('/studios/{studio}', [StudioController::class, 'supprimer'])->name('dashboard.studio.destroy');
        });

        // Paramètres communs
        Route::get('/settings', [UserSettingsController::class, 'modifier'])->name('dashboard.settings');
        Route::post('/settings/update', [UserSettingsController::class, 'mettreAJour'])->name('dashboard.settings.update');
        Route::post('/settings/update-password', [UserSettingsController::class, 'mettreAJourMotDePasse'])->name('dashboard.settings.password');
        Route::delete('/settings/delete', [UserSettingsController::class, 'supprimer'])->name('dashboard.settings.delete');
        
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist', [WishlistController::class, 'basculer'])->name('wishlist.toggle');

        // Virements
        Route::post('/wallet/payout', [\App\Http\Controllers\PayoutController::class, 'demanderVirement'])->name('wallet.payout')->middleware('throttle:5,1');

        // Paiement Stripe
        Route::get('/payment/checkout/{reservation}', [PaymentController::class, 'caisse'])->name('payment.checkout');
        Route::get('/payment/success', [PaymentController::class, 'succes'])->name('payment.success');
        Route::get('/payment/cancel', [PaymentController::class, 'annuler'])->name('payment.cancel');

        // Messagerie
        Route::middleware(['throttle:60,1'])->group(function () {
            Route::post('/message', [MessageController::class, 'enregistrer']);
            Route::put('/message/{message}', [MessageController::class, 'mettreAJour']);
            Route::get('/message', [MessageController::class, 'index']);
            Route::post('/message/hide/{contactId}', [MessageController::class, 'masquerConversation'])->whereNumber('contactId');
            Route::get('/message/unread-count', [MessageController::class, 'recupererNombreMessagesNonLus']);
            Route::post('/message/read', [MessageController::class, 'marquerCommeLu']);
            Route::get('/api/users/search', [MessageController::class, 'rechercherUtilisateurs']);
        });

        // Réservations
        Route::middleware(['throttle:30,1'])->group(function () {
            Route::post('/reservation', [ReservationController::class, 'enregistrer'])->name('reservation.store');
            Route::post('/reservations/{reservation}/confirm', [ReservationController::class, 'confirmer'])->name('reservations.confirm');
            Route::post('/reservations/{reservation}/refuse', [ReservationController::class, 'refuser'])->name('reservations.refuse');
            Route::delete('/reservations/{reservation}/cancel', [ReservationController::class, 'annuler'])->name('reservations.cancel');
            Route::post('/reservations/{reservation}/complete', [ReservationController::class, 'terminer'])->name('reservations.complete');
            Route::post('/reservations/{reservation}/dispute', [ReservationController::class, 'litige'])->name('reservations.dispute');
            Route::post('/reservations/{reservation}/rate', [ReservationController::class, 'noter'])->name('reservations.rate');
        });
    });

    // Admin routes
    Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'afficher'])->name('admin.users.show');
        Route::post('/users/{user}/ban', [\App\Http\Controllers\Admin\UserController::class, 'bannir'])->name('admin.users.ban');
        Route::post('/users/{user}/unban', [\App\Http\Controllers\Admin\UserController::class, 'debannir'])->name('admin.users.unban');
        Route::post('/users/{user}/verify-email', [\App\Http\Controllers\Admin\UserController::class, 'verifierEmail'])->name('admin.users.verify-email');
        
        Route::get('/studios', [\App\Http\Controllers\Admin\StudioController::class, 'index'])->name('admin.studios.index');
        Route::delete('/studios/{studio}', [\App\Http\Controllers\Admin\StudioController::class, 'supprimer'])->name('admin.studios.destroy');
        Route::post('/studios/{studio}/toggle-verify', [\App\Http\Controllers\Admin\StudioController::class, 'basculerVerification'])->name('admin.studios.toggle-verify');
        Route::get('/reservations', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('admin.reservations.index');
        
        Route::get('/disputes', [\App\Http\Controllers\Admin\DisputeController::class, 'index'])->name('admin.disputes.index');
        Route::get('/disputes/{reservation}', [\App\Http\Controllers\Admin\DisputeController::class, 'afficher'])->name('admin.disputes.show');
        Route::post('/disputes/{reservation}/resolve', [\App\Http\Controllers\Admin\DisputeController::class, 'resoudre'])->name('admin.disputes.resolve');
        Route::get('/payouts', [\App\Http\Controllers\Admin\PayoutController::class, 'index'])->name('admin.payouts.index');
        Route::post('/payouts/{payoutRequest}/complete', [\App\Http\Controllers\Admin\PayoutController::class, 'terminer'])->name('admin.payouts.complete');
    });
});

// Pages publiques
Route::get('/become-expert', function() { return view('pages.become-expert'); })->name('become-expert');
Route::get('/contact', function() { return view('pages.contact'); })->name('contact');
Route::get('/terms', function() { return view('pages.terms'); })->name('terms');
Route::get('/privacy', function() { return view('pages.privacy'); })->name('privacy');
Route::get('/legal', function() { return view('pages.legal'); })->name('legal');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact POST
Route::post('/contact', [ContactController::class, 'envoyerEmail'])->name('send.email')->middleware('throttle:5,1');

// Wallet test (dev only)
Route::post('/wallet/recharge', [WalletController::class, 'recharger'])->name('wallet.recharge')->middleware('auth');

// Webhook Stripe
Route::post('/stripe/webhook', [StripeWebhookController::class, 'gerer'])->name('stripe.webhook');
