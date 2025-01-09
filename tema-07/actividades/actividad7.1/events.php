<?php

// Se inicia sesión o se continua la sesión actual
session_start();

// Obtenemos la hora y fecha actuales
$horaFechaInicio = date("Y-m-d H:i:s");

// Gestión de veces que se ha visitado la página
if($_SESSION['visitas']==0){
    $_SESSION['visitas'] = 1;
    $_SESSION['horaFecha'] = $horaFechaInicio;
} else {
    $_SESSION['visitas']++;
}

// Nombre de la página
$archivoActual = basename($_SERVER['PHP_SELF']);
echo $archivoActual."<br>";

// SID de la sesión
$sesion_id = session_id();
echo $sesion_id."<br>";

// Nombre de la sesión
$sesionNombre = session_name();
echo $sesionNombre."<br>";

// Fecha hora en la que se inició la sesión
echo $_SESSION['horaFecha']."<br>";

// Mostramos el número de visitas
echo $_SESSION['visitas'];