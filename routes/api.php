<?php

use App\Http\Controllers\BirthCertificate\BirthCertificateWithNumController;
use Illuminate\Support\Facades\Route;


// Enregistrer un extrait avec numero
Route::post('/birth-certificate-with-number', [BirthCertificateWithNumController::class, 'store']);

// Retrouver un extrait utilisant le numero de demande
Route::get('/birth-certificate/{asking_number}', [BirthCertificateWithNumController::class, 'show']);
