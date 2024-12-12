<?php

/*
    controlador: nuevo.php
    descripción: muestra formulario añadir libro
*/

// Configuración
include 'config/configDB.php';

// Clases
include 'class/class.conexion.php';
include 'class/class.libro.php';
include 'class/class.tabla_libros.php';

// Modelo
include 'models/model.nuevo.php';

// Vista
include 'views/view.nuevo.php';