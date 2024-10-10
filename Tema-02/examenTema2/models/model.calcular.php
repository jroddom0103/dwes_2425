<?php

$radio = $_GET["radio"];
$frecuencia = $_GET["frecuencia"];
$masa = $_GET["masa"];

$velocidadT = 2*pi()*$radio*$frecuencia;
$acelerC = pow($velocidadT,2)/$radio;
$fuerzaC = $masa/$acelerC;
$periodo = 1/$frecuencia;  

$velocidadT = number_format($velocidadT,2,".",".");
$acelerC = number_format($acelerC,2,".",".");
$fuerzaC = number_format($fuerzaC,2,".",".");
$periodo = number_format($periodo,10,".",".");