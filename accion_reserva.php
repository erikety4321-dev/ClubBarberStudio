<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['indice'], $_POST['accion'])) {
    $indice = (int)$_POST['indice'];
    $accion = $_POST['accion'];

    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES);

    if (isset($reservas[$indice])) {
        $partes = explode("|", $reservas[$indice]);

        if (count($partes) < 5) $partes[4] = " Pendiente";

        if ($accion === "aceptar") {
            $partes[4] = " Aceptada";
        } elseif ($accion === "rechazar") {
            $partes[4] = " Rechazada";
        }

        $reservas[$indice] = implode(" |", $partes);

        file_put_contents("reservas.txt", implode(PHP_EOL, $reservas) . PHP_EOL);
    }

    header("Location: ver_reserva_barbero.php");
    exit;
} else {

    header("Location: ver_reserva_barbero.php");
    exit;
}
?>
