<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FootprintService;

class SurveyController extends Controller
{
    protected $service;

    public function __construct(FootprintService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transport.type' => 'required|string',
            'transport.km_per_week' => 'required|numeric|min:0',
            'electricity_kwh_per_month' => 'nullable|numeric|min:0',
            'gas_m3_per_month' => 'nullable|numeric|min:0',
            'diet_type' => 'required|string',
            'consumption_score' => 'nullable|numeric|min:0',
        ]);

        $resultado = $this->service->calculate($validated);

        return view('resultados', compact('resultado'));
    }
}
