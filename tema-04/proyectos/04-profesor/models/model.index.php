<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase artículos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $obj_tabla_profesores = new Class_tabla_profesores();

    # Cargo tabla de marcas
    $especialidades = $obj_tabla_profesores->getEspecialidades();

    # Cargo tabla de categorías
    $etiquetas = $obj_tabla_profesores->getAsignaturas();

    # Relleno el array de objetos
    $obj_tabla_profesores->getDatos();

    # Obtener tabla de artículos
    $array_profesores = $obj_tabla_profesores->tabla;

