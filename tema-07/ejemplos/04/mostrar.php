<?php

/*
    Mostrar cookies
*/

// Comprobar si existe la cookie nombre
if(isset($_COOKIE['nombre'])) {
    echo 'La cookie nombre tiene el valor: ' . $_COOKIE['nombre'] . '<br>';
} else {
    echo 'La cookie nombre no existe <br>';
}

// Comprobar si existe la cookie edad
if(isset($_COOKIE['edad'])) {
    echo 'La cookie edad tiene el valor: ' . $_COOKIE['edad'] . '<br>';
} else {
    echo 'La cookie edad no existe <br>';
}

// Comprobar si existe la cookie ciudad
if(isset($_COOKIE['ciudad'])) {
    echo 'La cookie ciudad tiene el valor: ' . $_COOKIE['ciudad'] . '<br>';
} else {
    echo 'La cookie ciudad no existe <br>';
}

// Mostrar array asociativo con todas las cookies
echo '<pre>';
print_r($_COOKIE);

require 'index.php';