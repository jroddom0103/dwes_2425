<?php

    /*
        inicio de sesión
    */

    // inicio sesión
    session_start();
    
    echo 'sesión iniciada'.'<br>';
    echo 'SID: '.session_id().'<br>';
    echo 'NAME: '.session_name();