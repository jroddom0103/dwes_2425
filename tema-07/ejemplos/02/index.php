<?php

    /*
        inicio de sesión

        personaliar SID y NAME
    */

    // Personalizar SID
    session_id('10100000111RT');

    // Personalizar NAME
    session_name('GesBank_01');

    // inicio sesión
    session_start();
    
    echo 'sesión iniciada'.'<br>';
    echo 'SID: '.session_id().'<br>';
    echo 'NAME: '.session_name();