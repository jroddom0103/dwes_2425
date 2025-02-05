<?php

/*
    Operaciones básicas de archivos y directorios

    - chdir
    - chroot()
    - closedir()
    - dir()
    - getcwd() - directorio actual
    - opendir()
    - readdir()
    - rewinddir()
    - scandir() - lista de archivos y directorios
*/

// Directorio actual
echo 'Directorio actual: '.getcwd()."<br>";

// Abrir directorio files
$dir = opendir('files');

echo 'Archivos y directorios en files:'."<br>";

// Leer directorio
while($file = readdir($dir)){
    if(is_file('files/'.$file)){
        echo "Archivo:" . $file . ": " . filesize('files/'.$file) . ' bytes <br>';
    }else if(is_dir('files/'.$file)){
        echo "Directorio:" . $file . "<br>";
    }
    
}

closedir($dir);