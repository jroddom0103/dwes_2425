<?php

/*
    modelo: model.editar.php
    descripción: carga el formulario para actualizar tabla

    Método GET:

        - indice de la tabla en la que se encuentra el libro
*/

# Cargamos el indice del libro
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de libros
$conexion = new Class_tabla_libros();

$libro = $conexion->read($indice);

$stmt_autores = $conexion->get_autores();

$stmt_editoriales = $conexion->get_editoriales();

$stmt_generos = $conexion->get_generos();