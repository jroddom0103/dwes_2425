<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase jugadores
    */

$tabla_jugadores = new Class_tabla_jugadores();

$tabla = $tabla_jugadores->get_Datos();

$equipos = $tabla_jugadores->getEquipos();

$posiciones = $tabla_jugadores->getPosiciones();