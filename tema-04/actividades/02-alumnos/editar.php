<?php

/*
    controlador: editar.php
    descripción: muestra los detalles de un alumno en modo edición

    parámetros:
        - Método GET:
        - id - id del alumno que deseo editar
*/

# Clases
include 'class/class.alumno.php';
include 'class/class.tabla_alumnos.php';

# Librerias

# Model
include 'models/model.editar.php';

# Vista
include 'views/view.editar.php';