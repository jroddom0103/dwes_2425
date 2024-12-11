<?php

/*
    Modelo: model.nuevo.php
    Descripción: genera los datos necesarios para añadir nueva cuenta
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Creo un objeto de la clase tabla cuenta
$conexion = new Class_tabla_cuentas();

$clientes = $conexion->getClientes();

$cuenta = $conexion->getCuentas();