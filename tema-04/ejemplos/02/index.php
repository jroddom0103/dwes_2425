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
    $vehiculo = new Class_vehiculo('1234BFH',10);

    # Mostrar detalles del vehículo
    echo "Matrícula: ".$vehiculo->getMatricula();
    echo "<br>";
    echo "Velocidad: ".$vehiculo->getVelocidad();
    echo "<br>";
    var_dump($vehiculo);