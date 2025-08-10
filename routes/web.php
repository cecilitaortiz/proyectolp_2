<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonacionController;

Route::get('/donaciones', [DonacionController::class, 'index']);  // Lectura
Route::post('/donaciones', [DonacionController::class, 'store']); // Escritura



// Mostrar la vista survey_test en la página principal
Route::get('/', function () {
    return view('survey_test');
});

// Vista de resultados de huella de carbono
Route::get('/resultados', function () {
    return view('resultados');
});

