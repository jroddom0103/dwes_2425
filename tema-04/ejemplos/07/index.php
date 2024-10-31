<?php

/*
    Concepto de herencias
*/

include 'class/class.producto.php';

$producto = new Class_producto(
    1,
    'La tormenta',
    20.45,
    'Juan',
    'Riquelme'
);

$libro = new Class_libro(
    2,
    'La Regenta',
    16.50,
    'Leopoldo',
    'Alas Clarin',
    896,
    'Alfaguara'
);

// $producto->titulo = 'La tormenta perfecta';
//$producto->setTitulo('La tormenta perfecta');

//var_dump($producto);
//echo '<br>';

$libro->muestra_libro();