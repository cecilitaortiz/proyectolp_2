<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

// Página principal con el formulario
Route::get('/', function () {
    return view('survey_test');
});

// Procesar formulario y mostrar resultados
Route::post('/resultados', [SurveyController::class, 'store'])->name('resultados');

