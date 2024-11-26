<?php

/*
    Ejemplo clase mysqli_sql_exception

    Estructura try{} catch{}
*/

function division($valor1, $valor2){
    try {

        if($valor2==0){
            throw new Exception("ERROR: División por cero no permitida.");
        }

        return($valor1/$valor2);
    } catch (Exception $e) {
        echo "Mensaje: ".$e->getMessage();
        echo "<br>";
        echo "Fichero: ".$e->getFile();
        echo "<br>";
        echo "Line: ".$e->getLine();
        exit();
    }
}

echo division(4,0);
echo "Hola";