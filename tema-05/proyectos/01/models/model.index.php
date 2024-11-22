<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase artículos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $tabla_alumnos = new Class_tabla_alumnos(
        'localhost',
        'root',
        '',
        'fp'
    );
    # Relleno el array de objetos
    $alumnos=$tabla_alumnos->getAlumnos();
