<?php

/*
    controlador: update.php
    descripción: actualiza la información del cliente

    Método POST:

        - detalles del cliente
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.libro.php';
include 'class/class.conexion.php';
include 'class/class.tabla_libros.php';

# Librerias

# Model
include 'models/model.update.php';

# Vista

# Redirecciono al controlador index
header("location: index.php");