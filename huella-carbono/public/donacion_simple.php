<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $monto = htmlspecialchars($_POST['monto'] ?? '');
    $motivo = htmlspecialchars($_POST['motivo'] ?? '');
    echo "<h1>¡Gracias por tu donación, $nombre!</h1>";
    echo "<p>Monto donado: <strong>$$monto USD</strong></p>";
    if ($motivo) {
        echo "<p>Motivo/Descripción: <em>$motivo</em></p>";
    }
    echo "<p>Tu apoyo es muy importante.</p>";
    echo '<a href="donacion_simple.php">Volver al formulario</a>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Donación Simple</title>
</head>
<body>
    <h1>Haz una donación</h1>
    <form action="donacion_simple.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label>Correo electrónico:</label>
        <input type="email" name="email" required><br><br>
        <label>Monto a donar (USD):</label>
        <input type="number" name="monto" min="1" step="0.01" required><br><br>
        <label>Motivo o descripción:</label>
        <textarea name="motivo" rows="3" cols="30" placeholder="¿Por qué quieres donar? (opcional)"></textarea><br><br>
        <button type="submit">Donar</button>
    </form>
</body>
</html>
