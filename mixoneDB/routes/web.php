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

// Studios - placez les routes plus spécifiques avant les routes dynamiques
Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::delete('/studio/{studio}', [StudioController::class, 'destroy'])->name('studio.destroy')->middleware('auth');

// Liste des studios
Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studio_list', [StudioController::class, 'search'])->name('studio_list');

// Recherche de studios — protégé par throttle pour éviter l'abus de proxy Nominatim
Route::middleware('throttle:30,1')->group(function () {
    Route::get('/api/geocode/search', [StudioController::class, 'searchGeocode'])->name('api.geocode.search');
    Route::get('/api/geocode/reverse', [StudioController::class, 'reverseGeocode'])->name('api.geocode.reverse');
});


// User must be logged in and verified
Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Artist Dashboard
        Route::group(['prefix' => 'artist'], function() {
            Route::get('/', [ArtistDashboardController::class, 'index'])->name('dashboard.artist.index');
            Route::get('/booking', [ArtistDashboardController::class, 'booking'])->name('dashboard.artist.booking');
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('dashboard.artist.wishlist');
        });

        // Studio Dashboard
        Route::group(['prefix' => 'studio'], function() {
            Route::get('/', [StudioDashboardController::class, 'index'])->name('dashboard.studio');
            Route::get('/my-studios', [StudioDashboardController::class, 'studioList'])->name('dashboard.studio.myStudios');
            Route::get('/booking', [StudioDashboardController::class, 'booking'])->name('dashboard.studio.booking');
            Route::get('/create', [StudioController::class, 'create'])->name('dashboard.studio.create');
            Route::post('/create', [StudioController::class, 'store'])->name('studio.store')->middleware('throttle:3,60');
            Route::get('/{studio}/edit', [StudioController::class, 'edit'])->name('dashboard.studio.edit');
            Route::put('/{studio}', [StudioController::class, 'update'])->name('dashboard.studio.update');
        });

        // Common Dashboard
        Route::get('/settings', [UserSettingsController::class, 'edit'])->name('dashboard.settings');
        Route::post('/settings/update', [UserSettingsController::class, 'update'])->name('dashboard.settings.update');
        Route::post('/settings/update-password', [UserSettingsController::class, 'updatePassword'])->name('dashboard.settings.password');
        
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

        Route::post('/wallet/payout', [\App\Http\Controllers\PayoutController::class, 'requestPayout'])
            ->name('wallet.payout')
            ->middleware('throttle:5,1');
    }); // Close dashboard group

    // Admin routes
    Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Users
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
        Route::post('/users/{user}/ban', [\App\Http\Controllers\Admin\UserController::class, 'ban'])->name('admin.users.ban');
        Route::post('/users/{user}/unban', [\App\Http\Controllers\Admin\UserController::class, 'unban'])->name('admin.users.unban');
        Route::post('/users/{user}/verify-email', [\App\Http\Controllers\Admin\UserController::class, 'verifyEmail'])->name('admin.users.verify-email');
        
        Route::get('/studios', [\App\Http\Controllers\Admin\StudioController::class, 'index'])->name('admin.studios.index');
        Route::delete('/studios/{studio}', [\App\Http\Controllers\Admin\StudioController::class, 'destroy'])->name('admin.studios.destroy');
        Route::post('/studios/{studio}/toggle-verify', [\App\Http\Controllers\Admin\StudioController::class, 'toggleVerify'])->name('admin.studios.toggle-verify');
        Route::get('/reservations', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('admin.reservations.index');
        
        // Litiges
        Route::get('/disputes', [\App\Http\Controllers\Admin\DisputeController::class, 'index'])->name('admin.disputes.index');
        Route::post('/disputes/{reservation}/resolve', [\App\Http\Controllers\Admin\DisputeController::class, 'resolve'])->name('admin.disputes.resolve');

        // Virements
        Route::get('/payouts', [\App\Http\Controllers\Admin\PayoutController::class, 'index'])->name('admin.payouts.index');
        Route::post('/payouts/{payoutRequest}/complete', [\App\Http\Controllers\Admin\PayoutController::class, 'complete'])->name('admin.payouts.complete');
    });
});

// Pages publiques
Route::get('/become-expert', function() {
    return view('pages.become-expert');
})->name('become-expert');

Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

Route::get('/terms', function() {
    return view('pages.terms');
})->name('terms');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// Messagerie — avec throttle anti-flood
Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    Route::post('/message', [MessageController::class, 'store']);
    Route::put('/message/{message}', [MessageController::class, 'update']);
    Route::get('/message', [MessageController::class, 'index']);
    Route::post('/message/hide/{contactId}', [MessageController::class, 'hideConversation'])
        ->whereNumber('contactId');
    Route::get('/message/unread-count', [MessageController::class, 'getUnreadCount']);
    Route::post('/message/read', [MessageController::class, 'markAsRead']);
    Route::get('/api/users/search', [MessageController::class, 'searchUsers']);
});

// Contact — throttle anti-spam
Route::post('/contact', [ContactController::class, 'sendEmail'])
    ->name('send.email')
    ->middleware('throttle:5,1');

// Réservations
Route::middleware(['auth', 'throttle:30,1'])->group(function () {
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

    Route::post('/reservations/{reservation}/confirm', [ReservationController::class, 'confirm'])
        ->name('reservations.confirm');

    Route::post('/reservations/{reservation}/refuse', [ReservationController::class, 'refuse'])
        ->name('reservations.refuse');

    Route::delete('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');

    Route::post('/reservations/{reservation}/complete', [ReservationController::class, 'complete'])
        ->name('reservations.complete');

    Route::post('/reservations/{reservation}/dispute', [ReservationController::class, 'dispute'])
        ->name('reservations.dispute');

    Route::post('/reservations/{reservation}/rate', [ReservationController::class, 'rate'])
        ->name('reservations.rate');
});

// Paiement Stripe
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/checkout/{reservation}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Wallet test (dev only)
Route::post('/wallet/recharge', [WalletController::class, 'recharge'])->name('wallet.recharge')->middleware('auth');

// Webhook Stripe (pas de CSRF, pas d'auth — Stripe envoie directement)
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');
