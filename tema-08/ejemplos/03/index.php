<?php

/*
    Leer y guardar en un archivo texto plano 

    - file_get_contents
    - file_put_contents
*/

// Guardo el contenido del archivo en una variable
$archivo = file_get_contents('archivo.txt');

// Añado una nueva información al archivo
$archivo .= 'Nueva información añadida al archivo';

// Guardo el contenido en el archivo
file_put_contents('archivo.txt',$archivo);

// Mensaje de confirmación
echo "Información añadida correctamente";