<?php

/*
    Ejemplo 1: crear un archivo de texto plano

    Abrir, escribir y cerrar archivo
*/

// Abrir el archivo en modo escritura
$archivo = fopen("miarchivo.txt","w"); 
if(!$archivo){
    echo "Error en el archivo";
    exit;
}

// Escribir en el archivo
fwrite($archivo,"Hola mundo\n");
fwrite($archivo,"Este es  un archivo de texto\n");
fwrite($archivo,"Soy el guía php Juan Antonio");

// Cerrar el archivo
fclose($archivo);

// Mensaje de éxito
echo "Archivo creado";