<?php
/*
    apellidos: model.create.php
    descripción: añade el nuevo alumno a la tabla
    
    Métod POST (alumno):
        - nombre
        - apellidos
        - ciudad
        - telefono
        - dni
        - email
        
*/

# Cargo los detalles del  formulario

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$telefono = $_POST['telefono'];
$dni = $_POST['dni'];
$email = $_POST['email'];

# Validación

# Creamos objeto de la clase Class_cliente
$cliente = new Class_cliente(
    null,
    $apellidos,
    $nombre,
    $telefono,
    $ciudad,
    $dni,
    $email,
);

# Añadimos alumno a la tabla
$conexion = new Class_tabla_clientes();

$conexion->create($cliente);

# Vista
# Redirecciono al controlador index
header("location: index.php");