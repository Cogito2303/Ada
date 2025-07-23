<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaiementController;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('demande-document');
})->name('demande');

Route::get('/recherche-document', function () {
    return view('recherche-document');
})->name('recherche');

Route::get('/suivre-document', function () {
    return view('suivre-document');
})->name('suivi');

