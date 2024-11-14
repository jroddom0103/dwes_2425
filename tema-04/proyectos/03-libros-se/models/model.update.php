<?php

/*
    autor: model.update.php
    Descripción: actualiza los datos del libro

    Método POST:
        - id
        - titulo
        - autor
        - editorial 
        - fecha_edicion
        - materia (indice)
        - etiquetas (array)
        - precio
    
    Método GET:
                - indice (indice de la tabla correspondiente a dicho registro)
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo el índice del libro que voy a editar
$indice = $_GET['indice'];

# Cargo los detalles del  formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$fecha_edicion = $_POST['fecha_edicion'];
$materia = $_POST['materia'];
$etiquetas = $_POST['etiquetas'];
$precio = $_POST['precio'];

# Crear un objeto de la clase libro a partir de los detalles del formulario
$libro = new Class_libro(
    $id,
    $titulo,
    $autor,
    $editorial,
    $fecha_edicion,
    $materia,
    $etiquetas,
    $precio
);

# Creo un objeto de la clase tabla_libros
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los libros
$obj_tabla_libros->getDatos();

# Obtengo el array de materias
$materias = $obj_tabla_libros->getMaterias();

# Extraer array de edit$editorials para la vista
$etiquetas = $obj_tabla_libros->getEtiquetas();

# Actualizo los detalles del libro
//$obj_tabla_libros->update($libro,$indice);

# Comando alternativo por la propiedad NO encapsulamiento
$obj_tabla_libros->tabla[$indice]=$libro;

# Obtener el array libros
$array_libros = $obj_tabla_libros->tabla;