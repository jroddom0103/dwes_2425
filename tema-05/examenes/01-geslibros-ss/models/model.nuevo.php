<?php

/*
    Modelo: model.nuevo.php
    Descripción: genera los datos necesarios para añadir nuevo cliente
*/

$conexion = new Class_tabla_libros();

$autores = $conexion->get_autores();

$editoriales = $conexion->get_editoriales();

$generos = $conexion->get_generos();