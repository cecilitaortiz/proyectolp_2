<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonacionController;

Route::get('/donaciones', [DonacionController::class, 'index']);  // Lectura
Route::post('/donaciones', [DonacionController::class, 'store']); // Escritura

// Vista para probar la API de survey
Route::get('/survey-test', function () {
    return view('survey_test');
});

