<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Huella de Carbono</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        h2, h3 { color: #2c3e50; }
        ul { margin-top: 1em; }
        li { margin-bottom: 0.5em; }
        p { font-size: 1.1em; }
        .volver { margin-top: 2em; }
    </style>
</head>
<body>
    <h2>Resultado de tu huella de carbono</h2>
    @if(!empty($resultado))
        <p>Tu huella de carbono estimada anual es: <strong>{{ $resultado['total_kgCO2e_anual'] ?? 'N/A' }}</strong> kg CO₂e.</p>
        <h3>Desglose por categoría:</h3>
        <ul>
            @foreach(($resultado['por_categoria'] ?? []) as $cat => $valor)
                <li><strong>{{ $cat }}:</strong> {{ $valor }} kg CO₂e/año</li>
            @endforeach
        </ul>
        @if(!empty($resultado['recomendaciones']))
            <h3>Recomendaciones:</h3>
            <ul>
                @foreach($resultado['recomendaciones'] as $rec)
                    <li>{{ $rec }}</li>
                @endforeach
            </ul>
        @endif
    @else
        <p>No se pudo calcular la huella de carbono.</p>
    @endif
    <div class="volver">
        <a href="/">Volver al formulario</a>
    </div>
</body>
</html>
