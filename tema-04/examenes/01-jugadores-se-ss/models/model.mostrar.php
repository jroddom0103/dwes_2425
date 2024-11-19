<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos del jugador que deseo mostrar

        Método GET:

            - indice de la tabla en la que se encuentra el jugador
    */

$id = $_GET['id'];

$tabla_jugadores = new Class_tabla_jugadores();

$tabla = $tabla_jugadores->get_Datos();

$equipos = $tabla_jugadores->getEquipos();

$posiciones = $tabla_jugadores->getPosiciones();

$jugador = $tabla_jugadores->read($id);