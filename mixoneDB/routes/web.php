<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// User must be logged in
Route::group(['middleware' => 'auth'], function () {
    include 'custom/studios.php';
});

