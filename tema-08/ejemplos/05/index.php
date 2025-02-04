<?php

/*
    Leer archivo como array

    - file(): Lee un archivo y lo almacena en un array
*/

// Abrir archivo en modo lectura
$archivo = file('archivo.txt');

// Muestro el array
echo '<pre>';
print_r($archivo);
echo '<pre>';

// Muestra sólo la última línea
echo 'Última: '.$archivo[count($archivo)-1];

// Cerrar archivo
fclose($archivo);