<?php

/*
    Leer archivo

    - fread
*/

// Abrir archivo en modo lectura
$archivo = fopen('archivo.txt','r');

// Valido apertura del archivo
if(!$archivo){

    // Mensaje error
    echo "No se pudo abrir el archivo";
    exit();
}

// Leer archivo
$contenido = fread($archivo, 20);

// Mostrar contenido
echo nl2br($contenido);

// Cerrar archivo
fclose($archivo);