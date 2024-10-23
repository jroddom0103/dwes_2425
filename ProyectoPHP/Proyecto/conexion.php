<?php
// Datos de conexión
$host = 'localhost';
$dbname = 'basedatos';
$username = 'root';
$password = '';

try {
    // Crear una instancia de PDO para la conexión
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configurar PDO para que lance excepciones en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejar errores de conexión
    die("Error de conexión: " . $e->getMessage());
}
