<?php

/*
    controlador: ordenar.php
    descripción: ordena los detalles
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.alumno.php';
include 'class/class.conexion.php';
include 'class/class.tabla_alumnos.php';

# Librerias

# Model
include 'models/model.ordenar.php';

# Redirecciono al controlador index
include 'views/view.index.php';