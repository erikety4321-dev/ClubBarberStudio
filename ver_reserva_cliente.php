<?php
$reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Reservas</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('img/fondo_1.png') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 20px;
    }
    .lista {
      background: rgba(255,255,255,0.9);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      max-width: 800px;
      margin: auto;
      text-align: center;
    }
    .lista h2 {
      color: #d4af37;
      margin-bottom: 20px;
    }
    .lista ul {
      list-style: none;
      padding: 0;
      margin-bottom: 25px;
    }
    .lista li {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    .estado {
      font-weight: bold;
      padding: 3px 8px;
      border-radius: 6px;
      color: white;
      margin-left: 10px;
    }
    .pendiente { background-color: #ffc107; }
    .aceptada { background-color: #28a745; }
    .rechazada { background-color: #dc3545; }
    .btn-volver {
      display: inline-block;
      padding: 12px 25px;
      background: linear-gradient(135deg, #d4af37, #b8860b);
      color: #fff;
      font-weight: bold;
      border-radius: 8px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="lista">
    <h2>Mis Reservas</h2>
    <ul>
      <?php foreach ($reservas as $r): 
        $partes = explode("|", $r);
        if(count($partes) < 5) $partes[4] = "Pendiente"; 
        $estado = trim($partes[4]);
        $clase = strtolower($estado);
      ?>
        <li>
          <?= htmlspecialchars($partes[0] . " - " . $partes[1] . " - " . $partes[2] . " - Hora: " . $partes[3]) ?> 
          <span class="estado <?= $clase ?>"><?= htmlspecialchars($estado) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="index.html" class="btn-volver">Volver al inicio</a>
  </div>
</body>
</html>
