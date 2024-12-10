<?php

/*
    modelo: model.editar.php
    descripción: carga los datos de la cuenta que deseo actualizar

    Método GET:

        - id de la cuenta
*/

# Cargamos el id de la cuenta que vamos a editar
$id = $_GET['id'];

# Creo un objeto de la clase tabla cuentas
$conexion = new Class_tabla_cuentas();

# Obtener los detalles de la cuenta
// objeto de la clase cuenta
$cuenta = $conexion->read($id);