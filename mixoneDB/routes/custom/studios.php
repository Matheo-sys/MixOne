<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;

Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
Route::post('/studio/store', [StudioController::class, 'store'])->name('studio.store');


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/studio', [StudioController::class, 'dashboardStudio']
    )->name('dashboard.studio');

    Route::get('/studio/booking', [StudioController::class, 'bookingStudios'])->name('dashboard.studio.booking');

    Route::get('/studio/list', [StudioController::class, 'myStudios'])->name('dashboard.studio.myStudios');

    Route::get('/dashboard/studio/create', [StudioController::class, 'create'])->name('dashboard.studio.create');
});


