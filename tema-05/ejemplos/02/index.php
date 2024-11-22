<?php

/*
    Ejemplo sentencia preparada para añadir un alumno a la tabla de la base de datos FP
*/

//1. Configuración de la conexión

$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'fp';

// 1. Conexión a la base de datos
$db = new mysqli($server, $user, $pass, $dbname);

// verificar conexión
if ($db->connect_errno) {
    die("Error de conexión " . $db->connect_error);
}

// 2. Preparar la sentencia
$sql = "
        INSERT INTO
            alumnos(
                id,
                nombre,
                apellidos,
                email,
                telefono,
                nacionalidad,
                dni,
                fechaNac,
                id_curso
            )
        VALUES  (null, ?, ?, ?, ?, ?, ?, ?, ?)        
";
$stmt = $db->prepare($sql);

// verifico la sentencia
if (!$stmt) {
    die("Error al preparar sql " . $db->error);
}

// Vinculamos los parámetros
$stmt->bind_param('sssisssi',
        $nombre,
       $apellidos,
              $email,
              $telefono,
              $nacionalidad,
              $dni,
              $fechaNac,
              $id_curso
);

// 3. Asignamos valores
$nombre = 'Juan';
$apellidos = "Sánchez";
$email = "juansanchez@gmail.com";
$telefono = 123456345;
$nacionalidad = "España";
$dni = "34543123A";
$fechaNac = "2010/12/31";
$id_curso = 2;

$stmt->execute();

// 4. Mensaje
echo "registro añadido correctamente";

// 5. Cerrar la sentencia y la conexión
$stmt->close();
$db->close();
