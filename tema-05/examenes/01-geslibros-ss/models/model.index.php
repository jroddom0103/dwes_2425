<?php

/*
    Modelo: model.index.php
    Descripción: muestra los detalles de clientes

*/

$conexion = new Class_tabla_libros();

$stmt_libros = $conexion->get_libros();

$generos_id = $stmt_libros->fetch()->generos_id;

$generos = $conexion->get_generos_asociados($generos_id);