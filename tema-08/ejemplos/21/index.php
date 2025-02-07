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
$zipFile = 'archivo.zip';

// Crear objeto ZIP
$zip = new ZipArchive();

// Crear archivo ZIP
if($zip->open($zipFile,ZipArchive::CREATE) == FALSE){

    echo 'Error al crear el archivo ZIP';
    exit();    

}

// Añadir archivos al archivo ZIP
$files = glob('files/*');

// Recorro todo el array de archivos y los añado al archivo ZIP
foreach($files as $file){
    $zip->addFile($file,basename($file));
}

// Cerrar archivo ZIP
$zip->close();

// Archivo creado correctamente
echo 'Archivo ZIP creado correctamente';

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="'.basename($zipFile).'"');
header('Content-Lenght: '.filesize($zipFile));
readfile($zipFile);