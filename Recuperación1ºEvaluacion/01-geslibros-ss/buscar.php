<?php

/*
    controlador: buscar.php
    descripción: busca los alumnos que coincidan con la búsqueda
*/

# Archivos de configuración
include 'config/configDB.php';
    
# Clases
include 'class/class.libro.php';
include 'class/class.conexion.php';
include 'class/class.tabla_libros.php';

# Librerias

# Model
include 'models/model.buscar.php';

# Vista
include 'views/view.index.php';