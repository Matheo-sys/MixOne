<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Artist\DashboardController as ArtistDashboardController;
use App\Http\Controllers\Studio\DashboardController as StudioDashboardController;
use App\Http\Controllers\Core\StudioController;
use App\Http\Controllers\Account\UserSettingsController;
use App\Http\Controllers\Account\WishlistController;
use App\Http\Controllers\Financial\PayoutController;
use App\Http\Controllers\Financial\PaymentController;
use App\Http\Controllers\Account\MessageController;
use App\Http\Controllers\Core\ReservationController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', [DashboardController::class, 'rediger'])->name('dashboard');

// Tableau de Bord Artiste
Route::group(['prefix' => 'artiste'], function() {
    Route::get('/', [ArtistDashboardController::class, 'afficher'])->name('dashboard.artist.index');
    Route::get('/reservations', [ArtistDashboardController::class, 'reservations'])->name('dashboard.artist.booking');
});

// Tableau de Bord Studio
Route::group(['prefix' => 'studio'], function() {
    Route::get('/', [StudioDashboardController::class, 'afficher'])->name('dashboard.studio');
    Route::get('/mes-studios', [StudioDashboardController::class, 'listeStudios'])->name('dashboard.studio.myStudios');
    Route::get('/reservations', [StudioDashboardController::class, 'reservations'])->name('dashboard.studio.booking');
    
    Route::get('/studios/creer', [StudioController::class, 'creer'])->name('studio.create');
    Route::get('/studios', function() {
        return redirect()->route('studio.create');
    });
    Route::post('/studios', [StudioController::class, 'enregistrer'])->name('studio.store');
    Route::get('/studios/{studio}/modifier', [StudioController::class, 'modifier'])->name('dashboard.studio.edit');
    Route::put('/studios/{studio}', [StudioController::class, 'mettreAJour'])->name('dashboard.studio.update');
    Route::delete('/studios/{studio}', [StudioController::class, 'supprimer'])->name('dashboard.studio.destroy');

    // Onboarding Stripe Connect
    Route::get('/stripe/connect', [\App\Http\Controllers\Financial\StripeConnectController::class, 'onboard'])->name('stripe.connect.onboard');
    Route::get('/stripe/return', [\App\Http\Controllers\Financial\StripeConnectController::class, 'return'])->name('stripe.connect.return');
    Route::get('/stripe/refresh', [\App\Http\Controllers\Financial\StripeConnectController::class, 'refresh'])->name('stripe.connect.refresh');
});

// Paramètres communs
Route::get('/parametres', [UserSettingsController::class, 'modifier'])->name('dashboard.settings');
Route::post('/parametres/mise-a-jour', [UserSettingsController::class, 'mettreAJour'])->name('dashboard.settings.update');
Route::put('/parametres/mot-de-passe', [UserSettingsController::class, 'mettreAJourMotDePasse'])->name('dashboard.settings.password');
Route::delete('/parametres/suppression', [UserSettingsController::class, 'supprimer'])->name('dashboard.settings.delete');
Route::get('/parametres/export', [UserSettingsController::class, 'exporterDonnees'])->name('dashboard.settings.export');

// Favoris
Route::get('/favoris', [WishlistController::class, 'afficher'])->name('wishlist.index');
Route::post('/favoris', [WishlistController::class, 'basculer'])->name('wishlist.toggle');

// Virements
Route::post('/portefeuille/virement', [PayoutController::class, 'demanderVirement'])->name('wallet.payout')->middleware('throttle:5,1');

// Paiement Stripe
Route::get('/paiement/caisse/{reservation}', [PaymentController::class, 'caisse'])->name('payment.checkout');
Route::get('/paiement/succes', [PaymentController::class, 'succes'])->name('payment.success');
Route::get('/paiement/annuler', [PaymentController::class, 'annuler'])->name('payment.cancel');

// Messagerie
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/message', [MessageController::class, 'enregistrer']);
    Route::put('/message/{message}', [MessageController::class, 'mettreAJour']);
    Route::get('/message', [MessageController::class, 'afficher']);
    Route::post('/message/masquer/{contactId}', [MessageController::class, 'masquerConversation'])->whereNumber('contactId');
    Route::get('/message/nombre-non-lus', [MessageController::class, 'recupererNombreMessagesNonLus']);
    Route::post('/message/lire', [MessageController::class, 'marquerCommeLu']);
    Route::get('/api/utilisateurs/rechercher', [MessageController::class, 'rechercherUtilisateurs']);
});

// Réservations
Route::middleware(['throttle:30,1'])->group(function () {
    Route::post('/reservation', [ReservationController::class, 'enregistrer'])->name('reservation.store');
    Route::post('/reservations/{reservation}/confirmer', [ReservationController::class, 'confirmer'])->name('reservations.confirm');
    Route::post('/reservations/{reservation}/refuser', [ReservationController::class, 'refuser'])->name('reservations.refuse');
    Route::delete('/reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])->name('reservations.cancel');
    Route::post('/reservations/{reservation}/terminer', [ReservationController::class, 'terminer'])->name('reservations.complete');
    Route::post('/reservations/{reservation}/litige', [ReservationController::class, 'litige'])->name('reservations.dispute');
    Route::post('/reservations/{reservation}/noter', [ReservationController::class, 'noter'])->name('reservations.rate');
});
