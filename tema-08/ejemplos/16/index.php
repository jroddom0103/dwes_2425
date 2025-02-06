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

// Mostramos detalles con pathinfo()
print_r(pathinfo('archivos_pdf/formulario.pdf'));