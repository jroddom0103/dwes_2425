<?php

/*
    Modelo: model.buscar.php
    Descripción: busca los clientes mediante expresión regular

    Método GET:
        - expresión: expresión regular con la que se buscará
*/

setlocale(LC_MONETARY, "es_ES");

$expresion = $_GET['expresion'];

$conexion = new Class_tabla_libros();

$stmt_libros = $conexion->filter($expresion);