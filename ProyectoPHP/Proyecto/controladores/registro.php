<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
    
    try {
        // Preparar la sentencia
        $stmt = $conexion->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Ejecutar la sentencia
        $stmt->execute();
        $_SESSION['mensaje'] = "Registro exitoso.";
        header("Location: ../index.php");
        exit();
    
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo "Error: " . $e->getMessage();
    }
}
?>
