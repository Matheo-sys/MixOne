<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Auth::routes();

// Page d'accueil principale
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'index'])->name('home');
Route::delete('/studio/{studio}', [StudioController::class, 'destroy'])->name('studio.destroy')->middleware('auth');
// Studios
Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::get('/studio/create', function() {
    return view('dashboard.studio.create');
})->name('studio.create')->middleware('auth');
Route::post('/studio', [StudioController::class, 'store'])->name('studio.store')->middleware('auth');

// Recherche de studios
Route::get('/', [StudioController::class, 'search'])->name('studio.search');

// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    include 'custom/studios.php';
    include 'custom/artists.php';

    // Dashboard generic routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-studios', [StudioController::class, 'myStudios'])->name('dashboard.studios');
        Route::get('/settings', function() {
            return view('dashboard.artist.settings');
        })->name('dashboardSettings');
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

Route::get('/studio_list', function() {
    return view('pages.studio_list');
})->name('studio_list');

// Messagerie
Route::middleware('auth')->group(function () {
    Route::post('/message', [MessageController::class, 'store']);
    Route::get('/message', [MessageController::class, 'index']);
});

// Dans le groupe avec middleware 'auth'
Route::get('/dashboard/settings', [UserSettingsController::class, 'edit'])->name('dashboard.settings');
Route::post('/dashboard/settings/update', [UserSettingsController::class, 'update'])->name('dashboard.settings.update');
Route::post('/dashboard/settings/update-password', [UserSettingsController::class, 'updatePassword'])->name('dashboard.settings.password');
