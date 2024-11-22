<?php

/*
    Conexión a base de datos:

        - servidor: localhost con usuario root a la base de datos
        - usuario: root
        - password:
        - base de datos: fp
*/

# variables de conexión
$ip = '127:9.9.1:3306';
$server = 'localhost';
$user = 'root';
$pass = '';
$bd = 'fp';

# establecemos la conexión
$conexion = new mysqli($server, $user, $pass, $bd);

# verificamos conexión
if ($conexion->connect_error) {
    echo 'ERROR DE CONEXIÓN Nº: ' . $conexion->connect_errno;
    echo '<BR>';
    echo 'DESCRIPCIÓN ERROR    : ' . $conexion->connect_errno;
    exit();
}

echo "conexión establecida con éxito";
echo "<BR>";

# ejecuto sql
$sql = 'select * from alumnos order by id';
$result = $conexion->query($sql);

# Manejo de resultado
// $result objeto de clase mysqli_result

# Muestro todos los alumnos
while($alumno = $result->fetch_assoc()){
    echo 'id: '.$alumno['id'];
    echo '<BR>';
    echo 'nombre: '.$alumno['nombre'];
    echo '<BR>';
    echo 'curso: '.$alumno['poblacion'];
    echo '<BR>';
    
}

# libero memoria y cierro conexión
$result->free();
$conexion->close();