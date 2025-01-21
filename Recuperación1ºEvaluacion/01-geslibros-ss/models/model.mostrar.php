<?php

/*
    modelo: model.mostrar.php
    descripción: carga los datos del libro que deseo actualizar

    Método GET:

        - indice de la tabla en la que se encuentra el libro
*/

# Cargamos el indice del libro
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de libros
$conexion = new Class_tabla_libros();

$libro = $conexion->read($indice);