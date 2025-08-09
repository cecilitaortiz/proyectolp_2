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
            <input type="text" name="transport_type" required>
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
            <input type="text" name="diet_type" required>
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
            document.getElementById('result').textContent = JSON.stringify(json, null, 2);
        };
    </script>
</body>
</html>
