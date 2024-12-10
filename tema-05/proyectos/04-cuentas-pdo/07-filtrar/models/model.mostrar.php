<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos de la cuenta que deseo actualizar

        Método GET:

            - id de la tabla en la que se encuentra la cuenta
    */

    # Cargamos el id de la cuenta
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla de cuentas
    $conexion = new Class_tabla_cuentas();

    #  Cargo los datos de los cuentas
    $conexion->getCuentas();

    # Obtener el objeto de la clase cuenta correspondiente a ese id
    $cuenta = $conexion->read($id);

    # Forma alternativa por la propiedad de no encapsulamiento
    // $cuenta = $conexion->tabla[$indice];