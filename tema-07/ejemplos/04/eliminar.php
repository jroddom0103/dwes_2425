<?php

/*
    Eliminación cookies
*/

// Eliminar cookie nombre
setcookie('nombre', '', time() - 3600);

// Eliminar cookie edad
setcookie('edad');

// Eliminar cookie ciudad
setcookie('ciudad', '', time() - 3600);

echo 'Cookies eliminadas correctamente';

require 'index.php';