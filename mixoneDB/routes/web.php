<?php

use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::get('/studio/{studio}', [StudioController::class, 'show'])
    ->name('studio.show');

Route::post('/studio', [StudioController::class, 'store'])
    ->name('studio.store');

Route::get('/studios', [StudioController::class, 'index'])
    ->name('studios.index');

Route::get('/studios', [StudioController::class, 'store'])
    ->name('studios.index');

Route::get('/', [StudioController::class, 'index'])
    ->name('studios.index');

Route::get('/', [StudioController::class, 'index'])
    ->name('home');

Route::get('/', [StudioController::class, 'search'])
    ->name('studio.search');

Route::get('/studio/create', function() {
    return view('dashboard.studio.create');
})->name('studio.create');

Route::post('/studio', [StudioController::class, 'store'])->name('studio.store');

// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    include 'custom/studios.php';
    include 'custom/artists.php';


    // Dashboard generic routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


        Route::get('/settings', function() {
            return view('dashboard.artist.settings');
        })->name('dashboardSettings');

    });
});

// User must not be logged in
// Become expert

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

