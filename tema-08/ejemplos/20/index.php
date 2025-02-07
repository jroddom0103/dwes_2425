<?php

/*
    Crear archivo comprimido con la clase ZipArchive

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
if($zip->open($zipFile,ZipArchive::CREATE) == TRUE){
    // Añadir archivos al archivo ZIP
    $zip->addFile('files/loro.jpg.');
    $zip->addFile('files/perro.jpg');
    $zip->addFile('files/formulario.jpg');

    // Cerrar archivo ZIP
    $zip->close();
}else{
    echo 'Error al crear archivo ZIP';
}

// Archivo creado correctamente
echo 'Archivo ZIP creado correctamente';

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="'.basename($zipFile).'"');
header('Content-Lenght: '.filesize($zipFile));
readfile($zipFile);