<?php
session_start();

if (!isset($_SESSION['barbero'])) {
    header("Location: index.php");
    exit;
}


$reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservas - Barbero</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('img/fondo_1.png') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 20px;
    }

    nav {
      background-color: #1f2937; 
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    nav h1 {
      font-size: 1.8rem;
      font-weight: bold;
      color: #d4af37;
    }
    .nav-buttons a {
      background: linear-gradient(135deg, #d4af37, #b8860b);
      color: white;
      font-weight: bold;
      padding: 8px 16px;
      border-radius: 8px;
      text-decoration: none;
      margin-left: 10px;
      transition: all 0.3s ease;
    }
    .nav-buttons a:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .lista {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      max-width: 900px;
      margin: auto;
      text-align: center;
    }
    .lista h2 {
      color: #d4af37;
      margin-bottom: 20px;
      font-size: 2rem;
    }
    .lista ul {
      list-style: none;
      padding: 0;
      margin-bottom: 25px;
    }
    .lista li {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .estado {
      font-weight: bold;
      padding: 3px 8px;
      border-radius: 6px;
      color: white;
    }
    .pendiente { background-color: #ffc107; }
    .aceptada { background-color: #28a745; }
    .rechazada { background-color: #dc3545; }
    .btn {
      padding: 8px 16px;
      margin-left: 5px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }
    .btn-aceptar { background-color: #28a745; color: white; }
    .btn-aceptar:hover { background-color: #218838; }
    .btn-cancelar { background-color: #dc3545; color: white; }
    .btn-cancelar:hover { background-color: #c82333; }
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
    .btn-volver:hover { transform: scale(1.05); }
  </style>
</head>
<body>

  <nav>
    <h1>CLUB BARBER STUDIO</h1>
    <div class="nav-buttons">
      <a href="registrar_barbero.php">Registrar Barbero</a>
      <a href="index.html">Inicio</a>
    </div>
  </nav>

  <div class="lista">
    <h2>RESERVAS</h2>
    <ul>
      <?php foreach ($reservas as $index => $r): 
        $partes = explode("|", $r);
        if(count($partes) < 5) $partes[4] = " Pendiente";
        $estado = trim($partes[4]);

        $clase_estado = '';
        if($estado === 'Pendiente') $clase_estado = 'pendiente';
        elseif($estado === 'Aceptada') $clase_estado = 'aceptada';
        elseif($estado === 'Rechazada') $clase_estado = 'rechazada';
      ?>
        <li>
          <span><?= htmlspecialchars($partes[0] . " | " . $partes[1] . " | " . $partes[2]) ?> 
          <span class="estado <?= $clase_estado ?>"><?= $estado ?></span></span>

          <?php if($estado === "Pendiente"): ?>
            <div>
              <form action="accion_reserva.php" method="post" style="display:inline;">
                <input type="hidden" name="indice" value="<?= $index ?>">
                <input type="hidden" name="accion" value="aceptar">
                <button type="submit" class="btn btn-aceptar">Aceptar</button>
              </form>
              <form action="accion_reserva.php" method="post" style="display:inline;">
                <input type="hidden" name="indice" value="<?= $index ?>">
                <input type="hidden" name="accion" value="rechazar">
                <button type="submit" class="btn btn-cancelar">Rechazar</button>
              </form>
            </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="index.html" class="btn-volver">Volver al inicio</a>
  </div>

</body>
</html>
