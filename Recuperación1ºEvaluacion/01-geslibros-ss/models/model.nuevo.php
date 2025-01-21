<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo cliente
    */

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Creo un objeto de la clase tabla libros
$conexion = new Class_tabla_libros();

# Obtengo un objeto de la clase pdostatement con los detalles de libros
$stmt_libros = $conexion->get_libros();

# Obtengo un objeto de la clase pdostatement con los detalles de los autores
$stmt_autores = $conexion->get_autores();

# Obtengo un objeto de la clase pdostatement con los detalles de las editoriales
$stmt_editoriales = $conexion->get_editoriales();

# Obtengo un objeto de la clase pdostatement con los detalles de los géneros
$stmt_generos = $conexion->get_generos();