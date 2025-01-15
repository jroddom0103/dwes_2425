<?php

// Se inicia o se continua la sesión (para poder manejar datos)
session_start();

if (!isset($_SESSION['hora_inicio'])) {
    $_SESSION['hora_inicio'] = time();
    $_SESSION['vecesTotal'] = 0;
}

// Se imprime el id de la sesión
echo session_id() . '<br>';

// Se imprime el nombre de la sesión
echo session_name() . '<br>';

// Se incrementa el número de veces totales
$_SESSION['vecesTotal']++;

// Se imprime el número total de visitas en la web
echo $_SESSION['vecesTotal'] . '<br>';

// Se imprime la hora en la que se inició sesión
echo date('H:i:s', $_SESSION['hora_inicio']) . '<br>';

// Se crea la hora de cierre de sesión
$_SESSION['hora_final'] = time();

// Se imprime la hora final
echo date('H:i:s', $_SESSION['hora_final']) . '<br>';

// Se calcula la duración entre la hora de inicio de sesión y la hora final
$duracion = $_SESSION['hora_final'] - $_SESSION['hora_inicio'];

// Convertir la duración a formato horas, minutos, segundos
$horas = floor($duracion / 3600);  // Calcula las horas
$minutos = floor(($duracion % 3600) / 60);  // Calcula los minutos
$segundos = $duracion % 60;  // Calcula los segundos restantes

// Mostrar la duración en formato legible
if ($horas > 0) {
    echo 'La sesión ha durado ' . $horas . ' horas, ' . $minutos . ' minutos y ' . $segundos . ' segundos';
} elseif ($minutos > 0) {
    echo 'La sesión ha durado ' . $minutos . ' minutos y ' . $segundos . ' segundos';
} else {
    echo 'La sesión ha durado ' . $segundos . ' segundos';
}

// Se cierra la sesión
session_destroy();