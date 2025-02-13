<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/wishlist', function() {
        return view('dashboard.artists.wishlist');
    })->name('dashboardWishlist');

});

