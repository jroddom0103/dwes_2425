<?php

/*
    Crear fichero csv con los datos de los alumnos de un curso

    Funciones:

    - Crear fichero csv
    - Escribir con fputs
    - Cerrar fichero csv
*/

// Obtenemos los datos de los alumnos
$alumnos = [
    [
        'id' => 1,
        'nombre' => 'María',
        'apellidos' => 'García López',
        'curso' => '1DAW',
        'poblacion' => 'Madrid'
    ],
    [
        'id' => 2,
        'nombre' => 'Juan',
        'apellidos' => 'Pérez García',
        'curso' => '2SMR',
        'poblacion' => 'Barcelona'
    ],
    [
        'id' => 3,
        'nombre' => 'Ana',
        'apellidos' => 'Rodríguez Martínez',
        'curso' => '2DAW',
        'poblacion' => 'Valencia'
    ]
];

// Creamos el fichero csv
$fichero = fopen('csv/alumnos.csv','wB');

// Escribimos los datos de los alumnos
foreach($alumnos as $alumno){
    fputcsv($fichero,$alumno,";",'"',"\t");
}

// Cerramos el fichero
fclose($fichero);