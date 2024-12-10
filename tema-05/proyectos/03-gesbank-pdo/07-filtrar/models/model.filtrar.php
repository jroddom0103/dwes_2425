<?php
/*
    Modelo: model.filtrar.php
    Descripción: permite filtrar la tabla a partir de una expresión. 
    Todas las filas que contengan dicha expresión se mostrarán

    Método GET:
        - expresion: expresión de filtrado

*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Obtenemos patrón
$expresion = $_GET['expresion'];

# Creo un objeto de la clase PDOStatement
$conexion = new Class_tabla_clientes();

$stmt_clientes = $conexion->filtrar($expresion);