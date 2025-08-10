<?php
namespace App\Services;

class FootprintService
{
    protected $factors;

    public function __construct()
    {
        $this->factors = config('emission_factors');
    }

    /**
     * Calcula huella anual estimada (kg CO2e/año) según los inputs
     * $data debe contener claves:
     *  - transport:{type, km_per_week}
     *  - electricity_kwh_per_month
     *  - gas_m3_per_month
     *  - diet_type
     *  - consumption_score
     */
    public function calculate(array $data): array
    {
        // Transporte
        $tipoTransporte = $data['transport']['type'] ?? 'car_petrol';
        $kmSemana = floatval($data['transport']['km_per_week'] ?? 0);
        $factorKm = $this->factors['transporte'][$tipoTransporte] ?? 0.19;
        $transporte_anual = $kmSemana * 52 * $factorKm; // kg CO2e / año

        // Electricidad
        $kwh_mes = floatval($data['electricity_kwh_per_month'] ?? 0);
        $electricidad_anual = $kwh_mes * 12 * $this->factors['electricidad_kwh'];

        // Gas
        $gas_m3_mes = floatval($data['gas_m3_per_month'] ?? 0);
        $gas_anual = $gas_m3_mes * 12 * $this->factors['gas_m3'];

        // Dieta
        $dieta = $data['diet_type'] ?? 'omnivore';
        $dieta_anual = $this->factors['dieta'][$dieta] ?? $this->factors['dieta']['omnivore'];

        // Consumo general
        $consumo_score = floatval($data['consumption_score'] ?? 0);
        $consumo_anual = $consumo_score * $this->factors['consumo_score'];

        // Total y porcentajes
        $total = $transporte_anual + $electricidad_anual + $gas_anual + $dieta_anual + $consumo_anual;
        $por_categoria = [
            'transporte' => $transporte_anual,
            'hogar_electricidad' => $electricidad_anual,
            'hogar_gas' => $gas_anual,
            'alimentacion' => $dieta_anual,
            'consumo' => $consumo_anual,
        ];

        // Recomendaciones simples basadas en categoría dominante
        arsort($por_categoria);
        $categoria_dominante = array_key_first($por_categoria);
        $recomendaciones = $this->generateRecommendations($categoria_dominante);

        return [
            'total_kgCO2e_anual' => round($total, 2),
            'por_categoria' => array_map(fn($v)=> round($v,2), $por_categoria),
            'categoria_dominante' => $categoria_dominante,
            'recomendaciones' => $recomendaciones,
        ];
    }

    protected function generateRecommendations(string $dominant): array
    {
        $map = [
            'transporte' => [
                "Reducir viajes en automóvil privado y optar por transporte público, bicicleta o caminata.",
                "Agrupar desplazamientos y teletrabajar cuando sea posible.",
                "Usar vehículos más eficientes o compartir coche."
            ],
            'hogar_electricidad' => [
                "Reducir consumo eléctrico: cambiar a bombillas LED, desconectar aparatos en standby.",
                "Mejorar eficiencia energética (aislamiento, electrodomésticos eficientes).",
                "Considerar cambiar a proveedor de energía renovable si está disponible."
            ],
            'hogar_gas' => [
                "Revisar aislamiento y calderas, bajar termostato 1–2°C y usar termostatos programables.",
                "Mantener mantenimiento de sistemas de calefacción."
            ],
            'alimentacion' => [
                "Reducir consumo de carne roja y aumentar alimentos de origen vegetal.",
                "Planificar compras para evitar desperdicio.",
                "Preferir productos locales y de temporada."
            ],
            'consumo' => [
                "Comprar menos, elegir productos duraderos y de segunda mano.",
                "Reparar prendas antes que reemplazarlas.",
                "Priorizar productos con menor huella por ciclo de vida."
            ],
        ];

        return $map[$dominant] ?? ["Adoptar hábitos más sostenibles en todas las áreas."];
    }
}
