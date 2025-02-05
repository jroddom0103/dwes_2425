<?php

/*
    Operaciones básicas de archivos y directorios

    - chdir
    - chroot()
    - closedir()
    - dir()
    - getcwd()
    - opendir()
    - readdir()
    - rewinddir()
    - scandir()
*/

// Directorio actual

echo 'Directorio actual: '.getcwd()."<br>";

// Cambiar directorio actual a files
chdir('files');
echo 'Directorio actual: '.getcwd()."<br>";

// Cambiar directorio padre
chdir('..');
echo 'Directorio actual: '.getcwd()."<br>";

// Cambiar directorio actual a files/pdf
chdir('files/pdf');
echo 'Directorio actual: '.getcwd()."<br>";

// Mostrar contenido de un directorio
$dir = dir('.');
var_dump($dir);
while(false !== ($file=$dir->read())){
    echo $file . "<br>";
}

// Cambiar directorio actual a files
chdir('..');
echo 'Directorio actual: '.getcwd()."<br>";

// Mostrar contenido de un directorio
$dir = dir('.');
var_dump($dir);
while(false !== ($file=$dir->read())){
    echo $file . "<br>";
}