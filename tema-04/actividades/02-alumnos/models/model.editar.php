<?php

/*
    modelo: model.editar.php
    descripción: carga los datos del alumno que deseo actualizar

    Método GET:
        - indice del alumno
*/

# Cargamos el id del alumno
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de alumnos
$obj_tabla_alumnos = new Class_tabla_alumnos();

# Cargo los datos de alumnos
$obj_tabla_alumnos->getDatos();

# Cargo el array de cursos - lista desplegable dinámica
$cursos = $obj_tabla_alumnos->getCursos();

# Cargo el array de asignaturas - lista checkbox dinámica
$asignaturas = $obj_tabla_alumnos->getAsignaturas();

# Obtener el objeto de la clase alumno correspondiente a ese índice
$alumno = $obj_tabla_alumnos->read($indice);