<?php

    /*
        controlador: delete.php
        descripción: muestra los detalles de los alumnos
    */

 # Archivos de configuración
 include 'config/configDB.php';
    
 # Clases
 include 'class/class.libro.php';
 include 'class/class.conexion.php';
 include 'class/class.tabla_libros.php';

 # Librerias

 # Model
 include 'models/model.eliminar.php';

 # Vista
 # Redirecciono al controlador index
 header("location: index.php");