<?php

/*
        autor: model.update.php
        Descripción: actualizo los datos del registro a partir de los detalles del formulario

        Método POST:
                - id
                - titulo
                - autor
                - editorial
                - fecha_edicion
                - precio
                - categorias

    Método GET:
                - indice (indice de la tabla correspondiente a dicho registro)
                */

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo los detalles del  formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$fecha_edicion = $_POST['fecha_edicion'];
$materia_obj = $_POST['materia'];
$etiquetas_obj = $_POST['etiquetas'];
$precio = $_POST['precio'];

# Cargo el índice de la tabla donde se encuentra el artículo
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla artículos
$obj_tabla_alumnos = new Class_tabla_alumnos();

# Cargo los datos en el objeto de la clase table de artículos
$obj_tabla_alumnos->getDatos();

# Crear un objeto de la clase artículos a partir de los detalles del formulario
$libro = new Class_alumno(
    $id,
    $titulo,
    $autor,
    $editorial,
    $fecha_edicion,
    $materia_obj,
    $etiquetas_obj,
    $precio
);
# Actualizo la tabla
$obj_tabla_alumnos->update($libro, $indice);

#  Extraer la tabla para la vista
$array_alumnos = $obj_tabla_alumnos->tabla;

# Extraer array de materias
$materia = $obj_tabla_alumnos->getMaterias();

# Extraer array de etiquetas
$etiquetas = $obj_tabla_alumnos->getEtiquetas();

