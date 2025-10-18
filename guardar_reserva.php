<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre   = $_POST['nombre']   ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha    = $_POST['fecha']    ?? '';
    $hora     = $_POST['hora']     ?? '';


    $reserva = "Nombre: $nombre | Teléfono: $telefono | Fecha: $fecha | Hora: $hora | Pendiente" . PHP_EOL;


    file_put_contents("reservas.txt", $reserva, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reserva Exitosa</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('img/fondo_1.png') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background: rgba(255, 255, 255, 0.9);
      color: #333;
      padding: 40px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0,0,0,0.4);
      max-width: 400px;
    }
    .card h2 {
      color: #d4af37;
      margin-bottom: 15px;
      font-size: 1.8em;
    }
    .card p {
      font-size: 18px;
      margin-bottom: 25px;
    }
    .card a {
      display: inline-block;
      margin-top: 15px;
      padding: 12px 20px;
      background: #d4af37;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s, transform 0.3s;
    }
    .card a:hover {
      background: #444;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>¡Tu reserva está lista!</h2>
    <p>Gracias por confiar en nosotros.</p>
    <a href="index.html">Volver al inicio</a>
  </div>
</body>
</html>
