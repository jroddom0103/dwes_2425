<?php

/*
    Manejo de directorios

    glog() - permite establecer filtros en la selección de ficheros

    Funciones:

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

// Ver contenido del directorio fies con scandir
$files = glob('files/*.*');

// Muestro el contenido del directorio files
echo '<pre>';
var_dump($files);
echo '</pre>';
