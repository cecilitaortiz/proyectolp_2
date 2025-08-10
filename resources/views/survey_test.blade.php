<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Probar Survey API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        label { display: block; margin-top: 1em; }
        input, select { width: 100%; padding: 0.5em; margin-top: 0.5em; }
        button { margin-top: 1.5em; padding: 0.7em 2em; }
        .result { margin-top: 2em; background: #f0f0f0; padding: 1em; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Probar Survey API</h1>
    <form id="surveyForm">
        <label>Tipo de transporte
            <select name="transport_type" required>
                <option value="">Seleccione...</option>
                <option value="car_petrol">Carro gasolina</option>
                <option value="car_diesel">Carro diésel</option>
                <option value="motorbike">Moto</option>
                <option value="bus">Autobús</option>
                <option value="train">Tren</option>
                <option value="bicycle">Bicicleta</option>
                <option value="walking">A pie</option>
            </select>
        </label>
        <label>Kilómetros por semana
            <input type="number" name="transport_km_per_week" required min="0">
        </label>
        <label>Electricidad (kWh/mes)
            <input type="number" name="electricity_kwh_per_month" min="0">
        </label>
        <label>Gas (m3/mes)
            <input type="number" name="gas_m3_per_month" min="0">
        </label>
        <label>Tipo de dieta
            <select name="diet_type" required>
                <option value="">Seleccione...</option>
                <option value="omnivore">Omnívora</option>
                <option value="vegetarian">Vegetariana</option>
                <option value="vegan">Vegana</option>
                <option value="pescatarian">Pescatariana</option>
            </select>
        </label>
        <label>Puntaje de consumo
            <input type="number" name="consumption_score" min="0">
        </label>
        <button type="submit">Enviar</button>
    </form>
    <div class="result" id="result"></div>
    <script>
        document.getElementById('surveyForm').onsubmit = async function(e) {
            e.preventDefault();
            const form = e.target;
            const data = {
                transport: {
                    type: form.transport_type.value,
                    km_per_week: Number(form.transport_km_per_week.value)
                },
                electricity_kwh_per_month: Number(form.electricity_kwh_per_month.value) || null,
                gas_m3_per_month: Number(form.gas_m3_per_month.value) || null,
                diet_type: form.diet_type.value,
                consumption_score: Number(form.consumption_score.value) || null
            };
            const res = await fetch('/api/survey', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const json = await res.json();
            // Guardar resultado en localStorage y redirigir
            localStorage.setItem('resultado_huella', JSON.stringify(json));
            window.location.href = '/resultados';
        };
    </script>
</body>
</html>
