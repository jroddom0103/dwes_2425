<?php

/**
 * Modelo: model.resultado.php
 * Descripción: calcula 
 */

//print_r($_GET);

// Cargo en variables

$velocidad = $_GET['velocidad'];
$angulo = $_GET['angulo'];

// Creo  variable con la operación
$operación = "Radianes";

//Realizo los cálculos
$radianes = deg2rad($velocidad);