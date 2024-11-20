<?php

/*
    Conexión a base de datos:

        - servidor: localhost con usuario root a la base de datos
        - usuario: root
        - password:
        - base de datos: fp
*/

# variables de conexión
$ip = '127:9.9.1:3306';
$server = 'localhost';
$user = 'root';
$pass = '';
$bd = 'fp';

# establecemos la conexión
$conexion = new PDO();