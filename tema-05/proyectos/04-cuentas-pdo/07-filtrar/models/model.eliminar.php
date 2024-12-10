<?php

/*
    modelo: model.eliminar.php
    descripción: elimina una cuenta de la tabla
    
    Método GET:

        - id: de la tabla donde se encuentra la cuenta que voy a eliminar
*/

# Cargamos el id de la cuenta
$id = $_GET['id'];

# Creo un objeto de la clase tabla de cuentas
$conexion = new Class_tabla_cuentas();

#  Cargo los datos de cuentas
$conexion->getCuentas();

# Eliminar el objeto de la clase cuenta correspondiente a ese id
$conexion->delete($id);

# Obtengo un objeto de la clase pdostatement con los detalles de cuentas
$stmt_cuentas = $conexion->getCuentas();