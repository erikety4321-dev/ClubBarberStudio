<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    if (!empty($usuario) && !empty($contrasena)) {
        if (preg_match("/^\d+$/", $contrasena)) {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $linea = $usuario . "|" . $hash . PHP_EOL;
            file_put_contents("barberos.txt", $linea, FILE_APPEND);
            $message = "Barbero registrado correctamente!";
        } else {
            $message = "La contraseña debe contener solo números.";
        }
    } else {
        $message = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Barbero</title>
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
        .form-container {
            background: rgba(255,255,255,0.9);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            width: 350px;
        }
        .form-container h2 {
            color: #d4af37;
            margin-bottom: 20px;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .form-container button {
            background: linear-gradient(135deg, #d4af37, #b8860b);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        .form-container button:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .form-container p {
            margin-top: 15px;
            color: green;
        }
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
            margin-top: 15px;
        }
        .btn-volver:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>REGISTRAR BARBERO</h2>
        <?php if($message != ""): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña (solo números)" required>
            <button type="submit">Registrar</button>
        </form>

        <a href="index.html" class="btn-volver">Volver al inicio</a>
    </div>
</body>
</html>
