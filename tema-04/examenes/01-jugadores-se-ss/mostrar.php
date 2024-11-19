<?php
    /*
        controlador: mostrar.php
        descripción: muestra los detalles de un libro sin edición

        parámetros:

            - Método GET:
                - indice donde se ecuentra el libro dentro de la tabla
    */

# Cargar tablas
include('class/class.jugador.php');
include('class/class.tabla_jugadores.php');

# Cargar modelo
include('models/model.mostrar.php');

# Cargar vista
include('views/view.mostrar.php');