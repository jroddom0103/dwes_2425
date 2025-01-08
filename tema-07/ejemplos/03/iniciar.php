<?php

    /*
        inicio de sesión
    */

    // iniciar sesión
    session_start();

    echo 'sesión iniciada'.'<br>';
    echo 'SID: '.session_id().'<br>';
    echo 'NAME: '.session_name();

    include 'index.php';