<?php
/*
    apellidos: model.create.php
    descripción: añade el nuevo artículo a la tabla
    
    Métod POST:
        - id
*/

# Cargo los detalles del  formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$nacionalidad = $_POST['nacionalidad'];
$dni = $_POST['dni'];
$fechaNac = $_POST['fechaNac'];
$id_curso = $_POST['id_curso'];

# Validación

# Creamos un objeto de la Class_alumno
$alumno = new Class_alumno(
    null,
    $nombre,
    $apellidos,
    $email,
    $telefono,
    $nacionalidad,
    $dni,
    $fechaNac,
    $id_curso
);

# Añadimos alumno a la tabla 
$alumnos = new Class_tabla_alumnos(
    'localhost',
    'root',
    '',
    'fp'
);

$alumnos->create($alumno);

# Redirecciono al controlador index
header("location: index.php");