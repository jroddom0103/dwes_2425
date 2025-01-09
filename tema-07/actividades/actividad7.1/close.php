<?php

// Se inicia sesión o se continua la sesión actual
session_start();

// Se elimina la sesión
session_destroy();

// Obtenemos la hora y fecha actuales
$horaFechaInicio = date("Y-m-d H:i:s");

$_SESSION['horaFechaFinal'] = date("Y-m-d H:i:s");

// Gestión de veces que se ha visitado la página
if (isset($_SESSION['visitas'])) {

    $visitas = $_SESSION['visitas'];

    if ($visitas == 0) {
        $_SESSION['visitas'] = 1;
        $_SESSION['horaFechaInicio'] = $horaFechaInicio;
    } else {
        $_SESSION['visitas']++;
    }
}



// SID de la sesión
$sesion_id = session_id();
echo $sesion_id . "<br>";

// Nombre de la sesión
$sesionNombre = session_name();
echo $sesionNombre . "<br>";

// Contador de visitas totales en la página
echo $_SESSION['visitas'] . "<br>";

// Fecha hora en la que se inició la sesión
echo $_SESSION['horaFechaInicio'] . "<br>";

// Fecha hora en la que se finalizó la sesión
echo $_SESSION['horaFechaFinal'] . "<br>";

// Duración de la sesión
$horaFechaInicio = strtotime($_SESSION['horaFechaInicio']);
$horaFechaFin = strtotime($_SESSION['horaFechaFinal']);
$duracion = $horaFechaFin - $horaFechaInicio;
echo "Duración de la sesión: " . $duracion . " segundos";