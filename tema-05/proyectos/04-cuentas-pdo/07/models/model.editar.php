<?php

/*
    modelo: model.editar.php
    descripción: carga los datos del alumno que deseo actualizar

    Método GET:

        - id del alumno
*/

# Cargamos el id del alumno que vamos a editar
$id = $_GET['id'];

# Creo un objeto de la clase tabla clientes
$conexion = new Class_tabla_clientes();

# Obtener los detalles del cliente
// objeto de la clase cliente
$cliente = $conexion->read($id);