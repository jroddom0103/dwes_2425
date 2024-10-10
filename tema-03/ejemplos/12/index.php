<?php

/**
 * Array Asociativo
 * 
 * Define cada elemento array con el par clave => valor
 * 
 * 
 * 
 */

 $alumno = [
    'id' => 1,
    'nombre' => 'Juan',
    'poblacion' => 'Ubrique',
    'curso' => '2DAW',
 ];

 foreach( $alumno as $i => $valor) {
    echo "[$i] = $valor";
    echo "<BR>";
}