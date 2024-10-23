<?php

    /*
        Ejemplo
        Descripción: crear objetos a partir de la clase Class_alumno
        Autor:
        Versión:
        Fecha:
    */

    # Incluyo archivo de la clase vehículo
    include 'class/class.vehiculo.php';

    # Creo un objeto de la clase vehículo
    $vehiculo = new Class_vehiculo();

    # Establecer la matrícula del vehículo 6712HRM
    $vehiculo->setMatricula('6712HRM');

    # Establecer velocidad a 10 km
    $vehiculo->setVelocidad(10);

    # Incrementar velocidad
    $vehiculo->aumentarVelocidad();

    # Mostrar detalles del vehículo
    echo "Matrícula: ".$vehiculo->getMatricula();
    echo "<br>";
    echo "Velocidad: ".$vehiculo->getVelocidad();