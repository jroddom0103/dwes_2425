<?php

/**
 * Modelo: modelCalcular.php
 * Descripción: define la constante de gravitación universal
 */

//print_r($_GET);

// Cargo en variables

$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];

// Creo  variable con la operación
$operación = "Radianes";

//Realizo los cálculos
$radianes = deg2rad('valor1');