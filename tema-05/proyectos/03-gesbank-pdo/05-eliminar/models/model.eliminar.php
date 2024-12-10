<?php

/*
    modelo: model.eliminar.php
    descripción: elimina un cliente de la tabla
    
    Método GET:

        - id: de la tabla donde se encuentra el cliente que voy a eliminar
*/

# Cargamos el id del cliente
$id = $_GET['id'];

# Creo un objeto de la clase tabla de clientes
$conexion = new Class_tabla_clientes();

#  Cargo los datos de clientes
$conexion->getClientes();

# Eliminar el objeto de la clase cliente correspondiente a ese id
$conexion->delete($id);

# Obtengo un objeto de la clase pdostatement con los detalles de clientes
$stmt_clientes = $conexion->getClientes();