<?php

/**
 * Ejemplo 3
 * Calificación de una nota de 0 a 10
 * Mostrará: deficiente, insuficiente, suficiente, bien, notable o 
 * sobresaliente
 * 
 */

 $a = 3;

 if( $a>=9 ){

    echo "sobresaliente";
 
}elseif($a>=7 && $a<9){

    echo "notable";

}elseif($a>=5 && $a<7){

    echo "suficiente";

}elseif($a>=2 && $a<5){

    echo "insuficiente";

}elseif($a<2 && $a>=0){

    echo "deficiente";

}elseif($a<0 || $a>10){

    echo "calificación no permitida";

}

// Solución más óptima

if($a < 0 || $a > 10){

    echo "Calificación No Permitida";

}elseif($a < 2){

    echo "Deficiente";

}elseif($a < 5){

    echo "Insuficiente";

}
elseif($a < 6){

    echo "Suficiente";

}elseif($a < 7){

    echo "Bien";

}elseif($a < 9){

    echo "Notable";

}elseif($a <= 10){

    echo "Sobresaliente";

}