<?php

    /**
     * tipos de variables
     * 
     * 
     */

    # tipo boolean

    $test = false;
    echo "\$test: ";
    var_dump(value: $test);

    echo "<BR>";

    // # tipo int
    $edad = 50;
    echo "\$edad: ";
    var_dump(value: $edad);

    // # tipo float
    $altura = 1.70
    echo '$altura: ';
    var_dump(value: $altura);

    // # tipo exponencial
    $exp = 1.70e10
    echo '$exp: ';
    var_dump(value: $exp);

    #tipo string ""
    $mensaje = "La distancia recorrida fue de $distancia km";
    echo "\$mensaje: ";
    var_dump(value: $mensaje);

    echo "<BR>";

    #tipo string '' con concatenar
    $mensaje = 'La distancia recorrida fue de' . $distancia . ' km";
    echo "\$mensaje: ";
    var_dump(value: $mensaje);

    echo "<BR>";

