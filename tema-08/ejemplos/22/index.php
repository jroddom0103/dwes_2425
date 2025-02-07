<?php

/*
    Crear archivo ZIP con PHP y la clase zipArchive

    Comprimir carpeta 

    La clase ZipArchive permite crear archivos comprimidos en formato ZIP.

    Funciones:
    - Crear archivo ZIP
    - Añadir archivos al archivo ZIP
    - Cerrar archivo ZIP
*/

// Nombre del archivo ZIP
$zipFile = 'files.zip';

// Crear objeto ZIP
$zip = new ZipArchive();

// Crear archivo ZIP
if($zip->open($zipFile) == FALSE){

    echo 'Error al crear el archivo ZIP';
    exit();    

}

// Añadir archivos al archivo ZIP
$files = glob('files/*');

// Recorro todo el array de archivos y los añado al archivo ZIP
foreach($files as $file){
    $zip->addFile($file,basename($file));
}

// Extraer archivos del archivo ZIP
$zip->extractTo('files');

// Cerrar archivo ZIP
$zip->close();

// Archivo creado correctamente
echo 'Archivos extraídos correctamente';