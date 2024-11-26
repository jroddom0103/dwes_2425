<?php

/*
    Ejemplo clase mysqli_sql_exception

    Estructura try{} catch{}
*/

// Conexión base de datos fp

try {
    
    // Habilitar el modo de excepciones en mysqli. Sólo 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Conectamos a la base de datos
    $db = new mysqli('localhost','root','','fp');

    // Ejecutamos consulta de alumnos
    $result = $db->query("select id, nombe from alumnos order by id");

} catch (mysqli_sql_exception $e) {
    echo "Mensaje: ".$e->getMessage();
        echo "<br>";
        echo "Fichero: ".$e->getFile();
        echo "<br>";
        echo "Line: ".$e->getLine();
        exit();
}

print_r($result->fetch_all(MYSQLI_ASSOC));