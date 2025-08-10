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
    <p id="huella"></p>
    <h3>Desglose por categoría:</h3>
    <ul id="categorias"></ul>
    <div id="recomendaciones"></div>
    <div class="volver">
        <a href="/">Volver al formulario</a>
    </div>
    <script>
        // Obtener datos desde localStorage
        const resultado = JSON.parse(localStorage.getItem('resultado_huella'));
        if(resultado) {
            document.getElementById('huella').innerHTML = `Tu huella de carbono estimada anual es: <strong>${resultado.total_kgCO2e_per_year}</strong> kg CO₂e.`;
            const ul = document.getElementById('categorias');
            for(const cat in resultado.by_category) {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${cat}:</strong> ${resultado.by_category[cat]} kg CO₂e/año`;
                ul.appendChild(li);
            }
            if(resultado.recommendations) {
                let recHtml = '<h3>Recomendaciones:</h3><ul>';
                resultado.recommendations.forEach(r => {
                    recHtml += `<li>${r}</li>`;
                });
                recHtml += '</ul>';
                document.getElementById('recomendaciones').innerHTML = recHtml;
            }
        } else {
            document.getElementById('huella').textContent = 'No se pudo calcular la huella de carbono.';
        }
    </script>
</body>
</html>
