<?php

use App\Http\Controllers\BirthCertificate\BirthCertificateController;
use Illuminate\Support\Facades\Route;


// Enregistrer un extrait avec numero
Route::post('/birth-certificate-with-number', [BirthCertificateController::class, 'store']);

// Retrouver un extrait utilisant le numero de demande
Route::get('/birth-certificate/{asking_number}', [BirthCertificateController::class, 'show']);
