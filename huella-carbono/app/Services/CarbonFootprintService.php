<?php

namespace App\Services;

class CarbonFootprintService
{
    // Factores de emisión (kg CO₂e) por opción
    private $factors = [
        'transport' => [
            'walk' => 0,
            'bike' => 1,
            'bus' => 0.06, // por km
            'car_shared' => 0.10,
            'car_solo' => 0.20
        ],
        'electricity' => 0.30, // por kWh
        'lab_pc' => [
            'off' => 0,
            'sleep' => 0.05,
            'on' => 0.10
        ],
        'food' => [
            'vegetarian' => 1.0,
            'white_meat' => 3.0,
            'red_meat' => 5.0
        ],
        'waste' => [
            'compost' => 0,
            'separated' => 5,
            'mixed' => 10
        ]
    ];

    public function calculate(array $data)
    {
        $total = 0;

        // Transporte (ejemplo: distancia mensual)
        if (isset($data['transport_mode']) && isset($data['transport_distance'])) {
            $mode = $data['transport_mode'];
            $distance = (float)$data['transport_distance']; // km/mes
            $total += $distance * ($this->factors['transport'][$mode] ?? 0);
        }

        // Electricidad (kWh/mes)
        if (isset($data['electricity_use'])) {
            $total += ((float)$data['electricity_use']) * $this->factors['electricity'];
        }

        // Computadora de laboratorio
        if (isset($data['lab_pc_usage_hours']) && isset($data['lab_pc_behavior'])) {
            $hours = (float)$data['lab_pc_usage_hours'];
            $behavior = $data['lab_pc_behavior'];
            $total += $hours * ($this->factors['lab_pc'][$behavior] ?? 0);
        }

        // Comida
        if (isset($data['meals_red_meat'])) {
            $total += ((int)$data['meals_red_meat']) * $this->factors['food']['red_meat'];
        }
        if (isset($data['meals_white_meat'])) {
            $total += ((int)$data['meals_white_meat']) * $this->factors['food']['white_meat'];
        }
        if (isset($data['meals_vegetarian'])) {
            $total += ((int)$data['meals_vegetarian']) * $this->factors['food']['vegetarian'];
        }

        // Residuos
        if (isset($data['waste_management'])) {
            $total += $this->factors['waste'][$data['waste_management']] ?? 0;
        }

        return $total; // kg CO₂e
    }
}
