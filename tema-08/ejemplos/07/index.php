<?php

/*
    Leer archivo línea a línea

    - fgets: Lee un archivo línea por línea
*/

// Abrir archivo en modo lectura
$archivo = fopen('archivo.txt','r');

// Validar si el archivo se abrió correctamente
if(!$archivo){
    die('No se pudo abrir el archivo');
}

// array vacío
$lineas = [];

// Recorro el archivo línea por línea
while(!feof($archivo)){
    $lineas[] = fgets($archivo);
}

// Cerrar archivo
fclose($archivo);

// Imprimo el contenido del archivo
echo '<pre>';
print_r($lineas);
echo '<pre>';