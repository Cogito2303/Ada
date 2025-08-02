<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirthCertificate\BirthCertificateWithNumController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Settings\SettingsController;

Route::get('/', function () {
    return view('ask-document');
})->name('ask');

Route::get('/search', function () {
    return view('search-document');
})->name('search');

Route::get('/tracking', function () {
    return view('tracking-document');
})->name('tracking');

// // Route d'appel vers l'api wave
// Route::get('/wave/redirect/{transaction}', [PaymentController::class, 'redirectToWave'])->name('wave.payment.loader');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/birth-certificates', [BirthCertificateWithNumController::class, 'index']);
});


Route::middleware('super.admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');