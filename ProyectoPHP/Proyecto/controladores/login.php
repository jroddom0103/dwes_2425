<?php
// /controladores/login.php
session_start();
require_once '../modelos/usuario.php';
require_once '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new Usuario($conexion);
    $idUsuario = $usuario->verificarUsuario($email, $password);

    if ($idUsuario) {
        $_SESSION['usuario_id'] = $idUsuario;
        header("Location: /vistas/dashboard.php");
    } else {
        header("Location: ../vistas/login_form.php?error=credenciales");
    }
}
?>
