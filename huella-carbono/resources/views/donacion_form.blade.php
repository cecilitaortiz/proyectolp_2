<!DOCTYPE html>
<html>
<head>
    <title>Donar para proyectos ambientales</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
        .container { background: #fff; max-width: 400px; margin: 40px auto; padding: 30px 40px; border-radius: 10px; box-shadow: 0 2px 8px #ccc; }
        h1 { color: #2c3e50; }
        label { display: block; margin-top: 15px; }
        input[type="text"], input[type="email"], input[type="number"] { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; }
        button { margin-top: 20px; background: #27ae60; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        button:hover { background: #219150; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Haz una donación</h1>
        <form action="{{ route('donacion.submit') }}" method="POST">
            @csrf
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="monto">Monto a donar (MXN):</label>
            <input type="number" id="monto" name="monto" min="1" required>

            <button type="submit">Donar</button>
        </form>
    </div>
</body>
</html>
