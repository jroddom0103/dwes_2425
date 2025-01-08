<?php
// Iniciar la sesión
session_start();

// destruye las variables de sesión
session_unset();

// Finalmente, destruir la sesión
session_destroy();

// Mostrar el nombre del SID y su ID
echo "Nombre del SID: " . session_name() . "<br>";
echo "ID de la sesión: " . session_id();

include 'index.php';