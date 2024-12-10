<?php
/*
    controlador: eliminar.php
    descripción: elimina una cuenta por el id

    parámetros:

        - Método GET:
            - id de la cuenta
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.cuenta.php';
include 'class/class.conexion.php';
include 'class/class.tabla_cuentas.php';

# Librerias

# Model
include 'models/model.eliminar.php';

# Vista
include 'views/view.index.php';