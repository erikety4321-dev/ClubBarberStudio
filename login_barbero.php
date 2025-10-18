<?php
session_start();

$archivo_barberos = "barberos.txt";
$usuarios = [];

if (file_exists($archivo_barberos)) {
    $lineas = file($archivo_barberos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($user, $hash) = explode("|", $linea);
        $usuarios[$user] = $hash;
    }
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    if (isset($usuarios[$usuario])) {
        if (password_verify($clave, $usuarios[$usuario])) {
            $_SESSION['barbero'] = $usuario;
            header("Location: ver_reserva_barbero.php");
            exit;
        } else {
            $error = "Usuario o contraseña incorrecta.";
        }
    } else {
        $error = "Usuario o contraseña incorrecta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso Barbero</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 flex items-center justify-center min-h-screen"
      style="background: url('img/fondo_1.png') no-repeat center center fixed; background-size: cover; font-family: 'Poppins', sans-serif;">

    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-amber-500">Ingreso Barbero</h1>
        <?php if($error): ?>
            <p class="bg-red-100 text-red-700 p-2 rounded mb-4"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Usuario</label>
                <input type="text" name="usuario" class="w-full px-3 py-2 border rounded-md focus:outline-amber-500" required>
            </div>
            <div class="mb-6">
                <label class="block mb-1 font-semibold">Contraseña</label>
                <input type="password" name="clave" class="w-full px-3 py-2 border rounded-md focus:outline-amber-500" required>
            </div>
            <button type="submit" class="w-full bg-amber-500 text-white py-2 rounded-md font-bold hover:bg-amber-600 transition">Ingresar</button>
        </form>
    </div>

</body>
</html>
