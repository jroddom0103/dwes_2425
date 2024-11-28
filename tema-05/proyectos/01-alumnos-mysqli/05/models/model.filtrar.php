<?php
/*
    Modelo: model.filtrar.php
    Descripción: permite filtrar la tabla a partir de una expresión. 
    Todas las filas que contengan dicha expresión se mostrarán

    Método GET:
        - expresion: expresión de filtrado

*/

# Obtenemos patrón
$expresion = $_GET['expresion'];

# Creo un objeto de la clase tabla alumnos
$alumnos = new Class_tabla_alumnos();

$alumnos = $alumnos->filtrar($expresion);