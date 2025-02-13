<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;

Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::post('/studio/store', [StudioController::class, 'store'])->name('studio.store');


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/studio', function() {
        return view('dashboard.studio.dashboard');
    })->name('dashboard.studio');

    Route::get('/studio/booking', function() {
        return view('dashboard.studio.booking');
    })->name('dashboard.studio.booking');

    Route::get('/studio/list', function() {
        return view('dashboard.studio.myStudios');
    })->name('dashboard.studio.list');

    Route::get('/studio/create', function() {
        return view('dashboard.studio.create');
    })->name('dashboard.studio.create');
});


