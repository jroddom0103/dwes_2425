<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase alumnos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla alumnos
    $obj_tabla_alumnos = new Class_tabla_alumnos();

    # Cargo tabla de cursos
    $cursos = $obj_tabla_alumnos->getCursos();

    # Cargo tabla de asignaturas
    $asignaturas = $obj_tabla_alumnos->getAsignaturas();

    # Relleno el array de objetos
    $obj_tabla_alumnos->getDatos();

    # Obtener tabla de alumnos
    $array_alumnos = $obj_tabla_alumnos->getTabla();

