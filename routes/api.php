<?php

use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\ExtraitAvecNumeroController;
use App\Models\ExtraitAvecNumero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/status',[TestController::class, 'index'])
    ->name('api.status');

// Route::post('/extrait-avec-numero', function (Request $request) {
//     // validation ou traitement ici
//     return redirect()->route('confirmation')->with([
//         'nomEnfant' => $request->nom,
//         'numeroExtrait' => $request->numeroExtrait,
//     ]);
// });

// Enregistrer un extrait avec numero
Route::post('/extrait-avec-numero', [ExtraitAvecNumeroController::class, 'store']);

// Retrouver un extrait utilisant le numero de demande
Route::get('/extrait/{numero_demande}', [ExtraitAvecNumeroController::class, 'show']);
