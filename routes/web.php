<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BirthCertificate\BirthCertificateController;
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

    Route::get('/birth-certificates', [BirthCertificateController::class, 'index']);
});

// routes accessibles uniquement par le super-admin
Route::middleware('super.admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('super/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('super/profile/update', [UserController::class, 'update_profile'])->name('profile.super.update');
    Route::put('super/profile/update', [UserController::class, 'update_profile'])->name('profile.super.update');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/admin/toggle/{id}', [UserController::class, 'toggleStatus'])->name('users.status-toggle');
    
});

// Routes accessibles par le super admin et l'admin
Route::middleware('superOrAdmin')->group(function(){
    // Obtenir tous les extrait (super admin) ou extrait selon son lieu de residence(admin)
    Route::get('/birth-certificate', [BirthCertificateController::class, 'get_birth_certificate'])->name('birth-certificate.index');
    Route::get('/birth-certificate/details/{asking_number}', [BirthCertificateController::class, 'birth_certificate_details'])->name('birth-certificate.details');
    // PROFILE USER
    Route::get('admin/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('admin/profile/update', [UserController::class, 'update_profile'])->name('profile.admin.update');
    Route::put('admin/profile/update', [UserController::class, 'update_profile'])->name('profile.admin.update');

});
