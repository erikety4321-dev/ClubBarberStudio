<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login_barbero.php");
    exit;
}

$archivo_reservas = "reservas.txt";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $linea_index = $_POST['linea_index'];
    $accion = $_POST['accion']; 

    $reservas = file($archivo_reservas, FILE_IGNORE_NEW_LINES);

    if(isset($reservas[$linea_index])){
        $parts = explode("|", $reservas[$linea_index]);
        if(strpos(end($parts), "Estado:") !== false){
            $parts[count($parts)-1] = " Estado: $accion";
        } else {
            $parts[] = " Estado: $accion";
        }
        $reservas[$linea_index] = implode("|", $parts);
        file_put_contents($archivo_reservas, implode(PHP_EOL, $reservas) . PHP_EOL);
    }
}

$reservas = file($archivo_reservas, FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reservas - Barbero</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: url('img/fondo_1.png') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 20px;
}
.lista {
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    max-width: 700px;
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
    padding: 15px;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn {
    padding: 8px 15px;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    margin-left: 5px;
    transition: all 0.3s ease;
}
.btn-aceptar { background-color: #28a745; }
.btn-aceptar:hover { transform: scale(1.1); }
.btn-cancelar { background-color: #dc3545; }
.btn-cancelar:hover { transform: scale(1.1); }
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
}
.btn-volver:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(0,0,0,0.5);
}
.estado {
    font-weight: bold;
    margin-left: 10px;
}
.estado-pendiente { color: #ffc107; }
.estado-aceptada { color: #28a745; }
.estado-cancelada { color: #dc3545; }
</style>
</head>
<body>
<div class="lista">
<h2>📋 Reservas</h2>
<ul>
<?php foreach ($reservas as $index => $r): ?>
    <?php
        $estado = "Pendiente";
        if (strpos($r, "Estado:") !== false) {
            preg_match("/Estado:\s*(\w+)/", $r, $matches);
            if(isset($matches[1])) $estado = $matches[1];
        }
        $estado_class = strtolower($estado) === "aceptada" ? "estado-aceptada" : (strtolower($estado) === "cancelada" ? "estado-cancelada" : "estado-pendiente");
    ?>
    <li>
        <span><?= htmlspecialchars($r) ?></span>
        <span class="estado <?= $estado_class ?>"><?= $estado ?></span>
        <form method="POST" style="display:inline;">
            <input type="hidden" name="linea_index" value="<?= $index ?>">
            <button type="submit" name="accion" value="Aceptada" class="btn btn-aceptar">Aceptar</button>
            <button type="submit" name="accion" value="Cancelada" class="btn btn-cancelar">Cancelar</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>
<a href="index.html" class="btn-volver">⬅️ Volver al inicio</a>
</div>
</body>
</html>
