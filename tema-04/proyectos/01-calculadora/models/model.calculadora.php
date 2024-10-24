<?php

/*
    modelo: model.calculadora.php
    descripción: realiza los cálculos
*/

# Cargar los datos del formulario
$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];
$operacion = $_GET['operacion'];

# creo objeto calculadora
$calcular = new Class_calculadora(
    $valor1, 
    $valor2, 
    $operacion,
    null
);

# Evalúo la operación
switch ($operacion) {
    case 'sumar': $calcular->suma();break;
    case 'restar': $calcular->resta();break;
    case 'producto': $calcular->multiplicacion();break;
    case 'division': $calcular->division();break;
    case 'potencia': $calcular->potencia();break;               
}

