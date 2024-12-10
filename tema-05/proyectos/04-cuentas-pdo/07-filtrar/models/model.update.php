<?php

/*
    Modelo: model.update.php
    Descripción: actualiza los datos de la cuenta

     Métod POST:

        - num_cuenta
        - saldo
    
    Método GET:

        - id de la cuenta
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo el id de la cuenta
$id = $_GET['id'];

# Cargo los detalles del formulario
$num_cuenta = $_POST['num_cuenta'];
$saldo = $_POST['saldo'];

# Conecto con la base de datos gesbank
$conexion = new Class_tabla_cuentas();

# Cargo datos restantes de la cuenta
$stmt = $conexion->getCuentaById($id);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$cuentaDatos = $stmt->fetch();


# Validación

# Creamos objeto de la clase Class_cuenta
$cuenta = new Class_cuenta(
    $id,
    $num_cuenta,
    $cuentaDatos->id_cliente,
    $cuentaDatos->fecha_alta,
    $cuentaDatos->fecha_ul_mov,
    $cuentaDatos->num_movtos,
    $saldo,
);

var_dump($cuenta->id_cliente);

# Llamo al método update de Class_tabla_cuentas
$conexion->update($cuenta, $id);