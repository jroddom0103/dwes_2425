<?php

/**
 * Modelo: model.calcular.php
 * Descripción: calcula 
 */

//print_r($_GET);

// Cargo en variables

$velocidad = $_POST['velocidad'];
$angulo = $_POST['angulo'];

// Definición de la constante de gravedad en la Tierra
const gravedad = 9.81;

// Creo  variable con la operación
$operacion = "Ángulos Radianes";
$operacion2 = "Velocidad Inicial X";
$operacion3 = "Velocidad Inicial Y";
$operacion4 = "Alcance Máximo del Proyectil";
$operacion5 = "Tiempo de Vuelo del Proyectil";
$operacion6 = "Altura Máxima del Proyectil";

//Realizo los cálculos
$radianes = deg2rad($angulo);
$velocidadX = $velocidad * cos($radianes);
$velocidadY = $velocidad * sin($radianes);
$alcanceMaximo = pow($velocidad,2)*sin(2*$radianes)/gravedad;
$tiempoVuelo = 2*$velocidad*sin($radianes)/gravedad;
$alturaMaxima = pow($velocidad, 2)*pow(sin($radianes),2)/(2*gravedad);

//Formatear cálculos

$radianes = number_format($radianes,2,',','.');
$velocidadX = number_format($velocidadX,2,',','.');
$velocidadY = number_format($velocidadY,2,',','.');
$alcanceMaximo = number_format($alcanceMaximo,2,',','.');
$tiempoVuelo = number_format($tiempoVuelo,2,',','.');
$velocidadY = number_format($velocidadY,2,',','.');