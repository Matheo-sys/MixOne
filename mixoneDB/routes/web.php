<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;

Auth::routes();

// Page d'accueil principale
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'index']);

// Studios - placez les routes plus spécifiques avant les routes dynamiques
Route::get('/studio/create', function() {
    return view('dashboard.studio.create');
})->name('studio.create')->middleware('auth');
Route::post('/studio', [StudioController::class, 'store'])->name('studio.store')->middleware('auth');
Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::delete('/studio/{studio}', [StudioController::class, 'destroy'])->name('studio.destroy')->middleware('auth');

// Liste des studios
Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studio_list', [StudioController::class, 'search'])->name('studio_list');

// Recherche de studios


// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    include 'custom/studios.php';
    include 'custom/artists.php';

    // Dashboard generic routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-studios', [StudioController::class, 'myStudios'])->name('dashboard.studios');
        Route::get('/settings', [UserSettingsController::class, 'edit'])->name('dashboard.settings');
        Route::post('/settings/update', [UserSettingsController::class, 'update'])->name('dashboard.settings.update');
        Route::post('/settings/update-password', [UserSettingsController::class, 'updatePassword'])->name('dashboard.settings.password');
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

Route::get('/about', function() {
    return view('pages.about');
})->name('about');

// Messagerie
Route::middleware('auth')->group(function () {
    Route::post('/message', [MessageController::class, 'store']);
    Route::get('/message', [MessageController::class, 'index']);
});


Route::post('/contact', [ContactController::class, 'sendEmail'])->name('send.email');
