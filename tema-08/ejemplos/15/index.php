<?php

/*
    Manejo de directorios

    Funciones:

    - chdir - cambiar directorio actual
    - getcwd() - directorio actual
    - mkdir() - crear directorio
    - rmdir() - eliminar directorio
    - glob() - acceder al contenido del directorio
    - dirname() - devuelve el directorio padre de la ruta establecida
    - is_dir() - determina si es un directorio
    - pathinfo() - devuelve información sobre ruta de un archivo
    - basename() - devuelve el nombre del directorio actual
    - unlink() - eliminar un archivo
*/

// ruta completa del directorio actual
echo 'Ruta completa del directorio actual: '.getcwd() . "<br>";

// nombre del directorio actual
echo 'Directorio actual: '. basename(getcwd()) . "<br>";

// directorio padre del directorio actual
echo 'Directorio padre del actual: '. dirname(getcwd()) . "<br>";

// Cambiamos como directorio actual files
chdir('files');

// ruta completa del directorio actual
echo 'Ruta completa del directorio actual: '.getcwd() . "<br>";

// nombre del directorio actual
echo 'Directorio actual: '. basename(getcwd()) . "<br>";

// directorio padre del directorio actual
echo 'Directorio padre del actual: '. dirname(getcwd()) . "<br>";

// Modificar el nombre de una carpeta
// pdf -> archivos_pdf
rename('pdf','archivos_pdf');

$files = glob('*');
echo "<pre>";
print_r($files);
echo "</pre>";

// Crear la carpeta imagenes
// mkdir('imagenes');

$files = glob('*');
echo "<pre>";
print_r($files);
echo "</pre>";

// Entro en la carpeta txt_new
chdir('txt_new');

// Eliminar todos los archivos
$files = glob('*');

foreach($files as $file){
    if(is_file($file)){
        unlink($file);
    }else if(is_dir($file)){
        rmdir($file);
    }
    
}

// Pongo directorio activo el directorio padre
chdir('..');

// Elimino la carpeta
rmdir('txt_new');

echo 'Carpeta eliminada correctamente.';