<?php

/*
    Ver los metadatos de un archivo

    - stat: Devuelve información sobre un archivo
*/

// Acceso a la ruta del archivo
$ruta = 'files';
$archivo = 'archivo.txt';

// Ruta completa
$ruta = $ruta . '/' . $archivo;

// Obtener los metadatos del archivo
// Devuelve en forma de array
$metadatos = stat($ruta);

// Mostrar los metadatos
echo '<pre>';
print_r($metadatos);
echo '</pre';