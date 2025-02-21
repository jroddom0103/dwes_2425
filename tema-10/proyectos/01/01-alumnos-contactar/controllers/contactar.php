<?php

class Contactar extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    function render()
    {
        // Crear token csrf
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $this->view->render('contactar/index');

    }
}