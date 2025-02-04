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

// Recorro el archivo línea por línea
while(!feof($archivo)){
    $linea = fgets($archivo);
    echo $linea.'<br>';
}

// Cerrar archivo
fclose($archivo);