<?php
// config/emission_factors.php
return [
    // kg CO2e por km (valores ejemplo — configúralos según fuentes confiables)
    'transporte' => [
        'car_petrol' => 0.192,   // kgCO2e / km
        'car_diesel' => 0.171,
        'motorbike'  => 0.103,
        'bus'        => 0.105,
        'train'      => 0.041,
        'bicycle'    => 0.0,
        'walking'    => 0.0,
    ],

    // kWh -> kgCO2e (ejemplo: electricidad mix)
    'electricidad_kwh' => 0.233, // kgCO2e / kWh

    // m3 gas natural -> kgCO2e
    'gas_m3' => 1.9, // kgCO2e / m3

    // factores dietéticos por tipo de dieta (kg CO2e / año aproximado por persona)
    'dieta' => [
        'omnivore' => 2500,
        'vegetarian' => 1600,
        'vegan' => 1200,
        'pescatarian' => 1800,
    ],

    // factor general para consumo de bienes (por unidad de "score" ingresado)
    'consumo_score' => 150, // kgCO2e por punto/por año (ejemplo)
];
