	Route::get('/donacion', [CarbonFootprintController::class, 'showDonacionForm'])->name('donacion.form');
	Route::post('/donacion', [CarbonFootprintController::class, 'submitDonacion'])->name('donacion.submit');
<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CarbonFootprintController;
Route::get('/carbon-footprint', [CarbonFootprintController::class, 'showForm'])->name('carbon.form');
	Route::post('/carbon-footprint', [CarbonFootprintController::class, 'calculate'])->name('carbon.calculate');
	Route::get('/carbon-footprint/result', [CarbonFootprintController::class, 'showResult'])->name('carbon.result');
	Route::get('/carbon-footprint/recomendaciones', [CarbonFootprintController::class, 'showRecomendaciones'])->name('carbon.recomendaciones');
    
	use Illuminate\Support\Facades\Redirect;
    
	// Redirigir la ruta principal a /carbon-footprint
	Route::get('/', function () {
		return Redirect::to('/carbon-footprint');
	});
