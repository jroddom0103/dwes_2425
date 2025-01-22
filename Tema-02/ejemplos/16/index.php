<?php

    /**
     * Función: is_null()
    */

    // Variable no definida
    var_dump(value: is_null(value:$var));
    echo "<BR>";

    // Variable definida asignando valor null
    $var=null;
    var_dump(value: is_null(value:$var));
    echo "<BR>";

    // Variable eliminada
    unset($var);
    var_dump(value: is_null(value:$var));
    echo "<BR>";