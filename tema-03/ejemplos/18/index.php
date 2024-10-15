<?php

/*
    funciones y procedimientos
*/

function sumar(int $valor1, int $valor2){
    $resultado = $valor1+$valor2;
    return $resultado;
};

function producto($valor1, &$valor2){
    $resultado = $valor1*$valor2;
    $valor2 = 7;
    return $resultado;
};

function division($valor1, $valor2=3){
    $resultado = $valor1/$valor2;
    return $resultado;
};

$v1 = 6;
$v2 = 2;

# Utilizo la función división
$calculo = division($v1,$v2);

echo $calculo;