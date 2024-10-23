<?php
session_start(); // Inicia la sesión

// Redirigir según si el usuario está autenticado o no
if (isset($_SESSION['usuario_id'])) {
    // Si el usuario está autenticado, redirigir a su panel de control
    header("Location: vistas/dashboard.php");
    exit();
} else {
    // Si no está autenticado, redirigir a la página de inicio o de inicio de sesión
    header("Location: vistas/login_form.php");
    exit();
}
?>
