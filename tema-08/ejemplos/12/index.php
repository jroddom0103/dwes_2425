<?php

/*
    Manejo de directorios

    Mediante la función scandir() 

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
$files = scandir('files',0);

// Muestro el contenido del directorio files
echo '<pre>';
var_dump($files);
echo '</pre>';

// Recorro el array de ficheros
foreach($files as $file){
    // muestro los ficheros y carpetas del directorio distinguiendo entre ficheros y carpetas
    if(is_dir('files/'.$file)){
        echo "Directorio:" . $file . "<br>";
    }else{
        echo "Fichero:" . $file . "<br>";
    }
    
    echo $file . "<br>";
}