<?php

use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    include 'custom/studios.php';


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

Route::get('/dashboard', function() {
    return view('dashboard.artist.booking');
})->name('dashboard');

Route::get('/dashboard/wishlist', function() {
    return view('pages.dbArtistwishlist');
})->name('dashboardWishlist');

Route::get('/dashboard/settings', function() {
    return view('pages.dbSettings');
})->name('dashboardSettings');

Route::get('/dashboard/studio', function() {
    return view('dashboard.studio.dashboard');
})->name('dashboard.studio');

Route::get('/dashboard/studio/booking', function() {
    return view('dashboard.studio.booking');
})->name('dashboard.studio.booking');

Route::get('/dashboard/studio/list', function() {
    return view('dashboard.studio.myStudios');
})->name('dashboard.studio.list');

Route::get('/dashboard/studio/create', function() {
    return view('dashboard.studio.create');
})->name('dashboard.studio.add');
