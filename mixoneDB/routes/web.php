<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;

Auth::routes();

// Page d'accueil principale
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'index']);

// Studios - placez les routes plus spécifiques avant les routes dynamiques
Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::delete('/studio/{studio}', [StudioController::class, 'destroy'])->name('studio.destroy')->middleware('auth');

// Liste des studios
Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studio_list', [StudioController::class, 'search'])->name('studio_list');

// Recherche de studios
Route::get('/api/geocode/search', [StudioController::class, 'searchGeocode'])->name('api.geocode.search');
Route::get('/api/geocode/reverse', [StudioController::class, 'reverseGeocode'])->name('api.geocode.reverse');


// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    // Dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Artist Dashboard
        Route::group(['prefix' => 'artist'], function() {
            Route::get('/', [DashboardController::class, 'artistIndex'])->name('dashboard.artist.index');
            Route::get('/booking', [DashboardController::class, 'bookingArtist'])->name('dashboard.artist.booking');
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('dashboard.artist.wishlist');
        });

        // Studio Dashboard
        Route::group(['prefix' => 'studio'], function() {
            Route::get('/', [DashboardController::class, 'studioIndex'])->name('dashboard.studio');
            Route::get('/my-studios', [DashboardController::class, 'studioList'])->name('dashboard.studio.myStudios');
            Route::get('/booking', [DashboardController::class, 'studioBooking'])->name('dashboard.studio.booking');
            Route::get('/create', [StudioController::class, 'create'])->name('dashboard.studio.create');
            Route::post('/create', [StudioController::class, 'store'])->name('studio.store');
            Route::get('/{studio}/edit', [StudioController::class, 'edit'])->name('dashboard.studio.edit');
            Route::put('/{studio}', [StudioController::class, 'update'])->name('dashboard.studio.update');
        });

        // Common Dashboard
        Route::get('/settings', [UserSettingsController::class, 'edit'])->name('dashboard.settings');
        Route::post('/settings/update', [UserSettingsController::class, 'update'])->name('dashboard.settings.update');
        Route::post('/settings/update-password', [UserSettingsController::class, 'updatePassword'])->name('dashboard.settings.password');
        
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

        Route::post('/wallet/recharge', [DashboardController::class, 'rechargeWallet'])->name('wallet.recharge');
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

// Messagerie
Route::middleware('auth')->group(function () {
    Route::post('/message', [MessageController::class, 'store']);
    Route::put('/message/{id}', [MessageController::class, 'update']);
    Route::get('/message', [MessageController::class, 'index']);
    Route::post('/message/hide/{contact_id}', [MessageController::class, 'hideConversation']);
    Route::get('/message/unread-count', [MessageController::class, 'getUnreadCount']);
    Route::post('/message/read', [MessageController::class, 'markAsRead']);
    Route::get('/api/users/search', [MessageController::class, 'searchUsers']);
});

Route::post('/contact', [ContactController::class, 'sendEmail'])->name('send.email');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store')->middleware('auth');

Route::post('/reservations/{reservation}/confirm', [ReservationController::class, 'confirm'])
    ->name('reservations.confirm')
    ->middleware('auth');

Route::post('/reservations/{reservation}/refuse', [ReservationController::class, 'refuse'])
    ->name('reservations.refuse')
    ->middleware('auth');

Route::delete('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])
    ->name('reservations.cancel')
    ->middleware('auth');

Route::post('/reservations/{reservation}/complete', [ReservationController::class, 'complete'])
    ->name('reservations.complete')
    ->middleware('auth');

Route::post('/reservations/{reservation}/rate', [ReservationController::class, 'rate'])
    ->name('reservations.rate')
    ->middleware('auth');

