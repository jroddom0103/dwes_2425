<?php

/**
 * Modelo: modelProducto.php
 * Descripción: producto de los valores del formulario
 */

//print_r($_GET);

// Cargo en variables

$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];

// Creo  variable con la operación
$operación = "Producto";

//Realizo los cálculos
$resultado = $valor1 * $valor2;