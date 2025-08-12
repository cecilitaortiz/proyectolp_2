<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarbonFootprintService;

class CarbonFootprintController extends Controller
{
    // Formulario de donación
    public function showDonacionForm()
    {
        return view('donacion_form');
    }

    // Procesar donación
    public function submitDonacion(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'monto' => 'required|numeric|min:1',
        ]);

        // Aquí podrías guardar la donación en un archivo o base de datos si lo deseas

        return view('donacion_gracias', ['nombre' => $validated['nombre'], 'monto' => $validated['monto']]);
    }
    protected $calculator;

    public function __construct(CarbonFootprintService $calculator)
    {
        $this->calculator = $calculator;
    }

    public function showForm()
    {
        return view('carbon_footprint_form');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'matricula' => 'required|string|max:50',
            'age' => 'required|integer|min:1|max:120',
            'email' => 'required|email|max:255',
            'transport_mode' => 'required|string',
            'transport_distance' => 'required|numeric|min:0',
            'electricity_use' => 'required|numeric|min:0',
            'lab_pc_usage_hours' => 'required|numeric|min:0',
            'lab_pc_behavior' => 'required|string',
            'meals_red_meat' => 'required|integer|min:0',
            'meals_white_meat' => 'required|integer|min:0',
            'meals_vegetarian' => 'required|integer|min:0',
            'waste_management' => 'required|string'
        ]);

        $total = $this->calculator->calculate($validated);

        // Guardar en archivo CSV
        $csvFile = storage_path('app/resultados.csv');
        $row = $validated;
        $row['total_kg_co2e'] = $total;
        $headers = array_keys($row);
        $writeHeaders = !file_exists($csvFile);
        $fp = fopen($csvFile, 'a');
        if ($writeHeaders) {
            fputcsv($fp, $headers);
        }
        fputcsv($fp, $row);
        fclose($fp);

        // Guardar datos en sesión y redirigir a la página de resultado
        session(['carbon_result.data' => $validated, 'carbon_result.total_kg_co2e' => $total]);
        return redirect()->route('carbon.result');
    }

    public function showResult(Request $request)
    {
        $data = session('carbon_result.data');
        $total_kg_co2e = session('carbon_result.total_kg_co2e');
        if (!$data || !$total_kg_co2e) {
            return redirect()->route('carbon.form');
        }
        return view('carbon_footprint_result', [
            'data' => $data,
            'total_kg_co2e' => $total_kg_co2e
        ]);
    }

    public function showRecomendaciones()
    {
        return view('carbon_footprint_recomendaciones');
    }
}
