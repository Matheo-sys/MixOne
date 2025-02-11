<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;

Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');
