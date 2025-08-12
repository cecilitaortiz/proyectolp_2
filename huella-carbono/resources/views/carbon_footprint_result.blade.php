<!DOCTYPE html>
<html>
<head>
    <title>Resultado Huella de Carbono</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
        .container { background: #fff; max-width: 500px; margin: 40px auto; padding: 30px 40px; border-radius: 10px; box-shadow: 0 2px 8px #ccc; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #eee; }
        th { background: #f0f0f0; }
        .result { font-size: 1.3em; color: #27ae60; margin-bottom: 10px; }
        .annual { color: #2980b9; }
        .back { display: inline-block; margin-top: 15px; text-decoration: none; color: #fff; background: #3498db; padding: 8px 18px; border-radius: 5px; }
        .back:hover { background: #217dbb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resultado de tu Huella de Carbono</h1>
        <table>
            <tr><th colspan="2">Datos personales</th></tr>
            <tr><td>Nombre</td><td>{{ $data['name'] }}</td></tr>
            <tr><td>Matrícula</td><td>{{ $data['matricula'] }}</td></tr>
            <tr><td>Edad</td><td>{{ $data['age'] }}</td></tr>
            <tr><td>Email</td><td>{{ $data['email'] }}</td></tr>
        </table>
        <table>
            <tr><th colspan="2">Consumo y hábitos</th></tr>
            <tr><td>Modo de transporte</td><td>{{ $data['transport_mode'] }}</td></tr>
            <tr><td>Distancia mensual (km)</td><td>{{ $data['transport_distance'] }}</td></tr>
            <tr><td>Electricidad (kWh/mes)</td><td>{{ $data['electricity_use'] }}</td></tr>
            <tr><td>Horas PC laboratorio/mes</td><td>{{ $data['lab_pc_usage_hours'] }}</td></tr>
            <tr><td>Comportamiento PC</td><td>{{ $data['lab_pc_behavior'] }}</td></tr>
            <tr><td>Comidas carne roja/mes</td><td>{{ $data['meals_red_meat'] }}</td></tr>
            <tr><td>Comidas carne blanca/mes</td><td>{{ $data['meals_white_meat'] }}</td></tr>
            <tr><td>Comidas vegetarianas/mes</td><td>{{ $data['meals_vegetarian'] }}</td></tr>
            <tr><td>Gestión de residuos</td><td>{{ $data['waste_management'] }}</td></tr>
        </table>
        <div class="result">
            <strong>Huella de carbono mensual:</strong> {{ number_format($total_kg_co2e, 2) }} kg CO₂e
        </div>
        <div class="annual">
            <strong>Huella de carbono anual:</strong> {{ number_format(($total_kg_co2e * 12) / 1000, 3) }} t CO₂e
        </div>
        <a class="back" href="{{ route('carbon.form') }}">Volver al formulario</a>
    </div>
</body>
</html>
