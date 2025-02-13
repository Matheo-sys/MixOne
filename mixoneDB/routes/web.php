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
    return view('pages.dbArtistBooking');
})->name('dashboard');

Route::get('/dashboard/wishlist', function() {
    return view('pages.dbArtistwishlist');
})->name('dashboardWishlist');

Route::get('/dashboard/settings', function() {
    return view('pages.dbSettings');
})->name('dashboardSettings');
