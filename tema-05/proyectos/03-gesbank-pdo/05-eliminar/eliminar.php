<?php
/*
    controlador: eliminar.php
    descripción: elimina un cliente por el id

    parámetros:

        - Método GET:
            - id del cliente
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.cliente.php';
include 'class/class.conexion.php';
include 'class/class.tabla_clientes.php';

# Librerias

# Model
include 'models/model.eliminar.php';

# Vista
include 'views/view.index.php';