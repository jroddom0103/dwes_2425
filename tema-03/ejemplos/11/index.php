<?php

/**
 * ejemplo
 * 
 * array de tipo indexado o escalar
 * 
 * sólo un índice numérico
 */

 // $numeros = array(3,4,7,9);
 $numeros = [3,4,7,9];

 // Mostrar array
 // print_r($numeros);
 foreach( $numeros as $i => $valor) {
    echo "[$i] = $valor";
    echo "<BR>";
}



