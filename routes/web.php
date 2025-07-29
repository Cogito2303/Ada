<?php

use Illuminate\Support\Facades\Route;

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

// // webhook pour wave
// Route::post('/wave/webhook', [PaymentController::class, 'handleWebhook'])->name('wave.webhook');
// Route::get('/payment/success', fn() => view('payment.success'))->name('payment.success');
// Route::get('/payment/failed', fn() => view('payment.failed'))->name('payment.failed');