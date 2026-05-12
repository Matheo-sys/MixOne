<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\DisputeController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', [AdminDashboardController::class, 'afficher'])->name('admin.dashboard');

Route::get('/utilisateurs', [UserController::class, 'liste'])->name('admin.users.index');
Route::get('/utilisateurs/{user}', [UserController::class, 'afficher'])->name('admin.users.show');
Route::post('/utilisateurs/{user}/bannir', [UserController::class, 'bannir'])->name('admin.users.ban');
Route::post('/utilisateurs/{user}/debannir', [UserController::class, 'debannir'])->name('admin.users.unban');
Route::post('/utilisateurs/{user}/basculer-admin', [UserController::class, 'basculerAdmin'])->name('admin.users.toggle-admin');
Route::post('/utilisateurs/{user}/verifier-email', [UserController::class, 'verifierEmail'])->name('admin.users.verify-email');
Route::post('/utilisateurs/{user}/envoyer-message', [UserController::class, 'envoyerMessage'])->name('admin.users.send-message');

Route::get('/studios', [StudioController::class, 'liste'])->name('admin.studios.index');
Route::delete('/studios/{studio}', [StudioController::class, 'supprimer'])->name('admin.studios.destroy');
Route::post('/studios/{studio}/basculer-verification', [StudioController::class, 'basculerVerification'])->name('admin.studios.toggle-verify');

Route::get('/reservations', [ReservationController::class, 'liste'])->name('admin.reservations.index');

Route::get('/litiges', [DisputeController::class, 'liste'])->name('admin.disputes.index');
Route::get('/litiges/{reservation}', [DisputeController::class, 'afficher'])->name('admin.disputes.show');
Route::post('/litiges/{reservation}/resoudre', [DisputeController::class, 'resoudre'])->name('admin.disputes.resolve');

Route::get('/virements', [PayoutController::class, 'liste'])->name('admin.payouts.index');
Route::post('/virements/{payoutRequest}/terminer', [PayoutController::class, 'terminer'])->name('admin.payouts.complete');

// Signalements (Messagerie)
Route::get('/signalements', [ReportController::class, 'index'])->name('admin.reports.index');
Route::get('/signalements/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
Route::post('/signalements/{report}/resoudre', [ReportController::class, 'resolve'])->name('admin.reports.resolve');

// Modération d'images
Route::get('/moderation-images', [\App\Http\Controllers\Admin\ModerationController::class, 'index'])->name('admin.moderation.index');
Route::post('/moderation-images/{imageRequest}/approuver', [\App\Http\Controllers\Admin\ModerationController::class, 'approve'])->name('admin.moderation.approve');
Route::post('/moderation-images/{imageRequest}/refuser', [\App\Http\Controllers\Admin\ModerationController::class, 'reject'])->name('admin.moderation.reject');
