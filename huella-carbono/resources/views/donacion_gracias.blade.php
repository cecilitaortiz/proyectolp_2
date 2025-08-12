<!DOCTYPE html>
<html>
<head>
    <title>¡Gracias por tu donación!</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
        .container { background: #fff; max-width: 400px; margin: 40px auto; padding: 30px 40px; border-radius: 10px; box-shadow: 0 2px 8px #ccc; text-align: center; }
        h1 { color: #27ae60; }
        .monto { font-size: 1.2em; color: #2980b9; margin: 20px 0; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #fff; background: #3498db; padding: 8px 18px; border-radius: 5px; }
        a:hover { background: #217dbb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Gracias por tu donación, {{ $nombre }}!</h1>
        <div class="monto">Monto donado: <strong>${{ number_format($monto, 2) }} MXN</strong></div>
        <p>Tu apoyo ayuda a proyectos ambientales y a reducir la huella de carbono.</p>
        <a href="{{ route('carbon.form') }}">Volver al inicio</a>
    </div>
</body>
</html>
