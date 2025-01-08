<?php
// Iniciar la sesión
session_start();

// Obtener el nombre del SID
$sid_name = session_name();

// Obtener el ID de la sesión
$sid_id = session_id();

// Mostrar el nombre del SID y su ID
echo "Nombre del SID: " . $sid_name . "<br>";
echo "ID de la sesión: " . $sid_id;

include 'index.php';