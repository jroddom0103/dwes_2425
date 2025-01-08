<?php

    /*
        Crear variables de sesión
    */

    // inicia o continua sesión

    session_start();

    echo 'SID: '.session_id()."<br>";
    echo 'NAME: '.session_name()."<br>";

    $_SESSION['nombre'] = 'Juan';
    $_SESSION['email'] = 'juan@gmail.es';
    $_SESSION['perfil'] = 'Admin';

    echo 'Variables de sesión creadas';
    