<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos del cliente que deseo actualizar

        Método GET:

            - id de la tabla en la que se encuentra el cliente
    */

    # Cargamos el id del cliente
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla de clientes
    $conexion = new Class_tabla_clientes();

    #  Cargo los datos de los clientes
    $conexion->getClientes();

    # Obtener el objeto de la clase cliente correspondiente a ese id
    $cliente = $conexion->read($id);

    # Forma alternativa por la propiedad de no encapsulamiento
    // $cliente = $conexion->tabla[$indice];