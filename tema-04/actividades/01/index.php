<?php

# Inclusión de biblioteca
include 'class/class.calculadora.php';

# Declaración de objeto
$operacion1 = new Class_calculadora();

# Declaración de variables
$valor1 = 2;
$valor2 = 4;

# Operaciones
$operacion1->suma($valor1, $valor2);
echo 'Suma: '.$valor1.$operacion1->getOperador().$valor2.' = '.$operacion1->getresultado();
echo '<br>';

$operacion1->resta($valor1, $valor2);
echo 'Resta: '.$valor1.$operacion1->getOperador().$valor2.' = '.$operacion1->getresultado();
echo '<br>';

$operacion1->division($valor1, $valor2);
echo 'División: '.$valor1.$operacion1->getOperador().$valor2.' = '.$operacion1->getresultado();
echo '<br>';

$operacion1->multiplicacion($valor1, $valor2);
echo 'Multiplicación: '.$valor1.$operacion1->getOperador().$valor2.' = '.$operacion1->getresultado();
echo '<br>';

$operacion1->potencia($valor1, $valor2);
echo 'Potencia: '.$valor1.$operacion1->getOperador().$valor2.' = '.$operacion1->getresultado();
echo '<br>';