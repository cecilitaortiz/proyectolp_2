<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\FoundationController;
use App\Http\Controllers\DonationController;

Route::post('/survey', [SurveyController::class, 'store']);
Route::get('/foundations', [FoundationController::class, 'index']);
Route::post('/donations', [DonationController::class, 'store']);
