<?php

/*
    controlador: filtrar.php
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
include 'models/model.filtrar.php';

# Redirecciono al controlador index
include 'views/view.index.php';