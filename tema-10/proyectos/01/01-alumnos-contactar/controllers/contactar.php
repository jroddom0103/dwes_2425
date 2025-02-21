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

        // Inicializo las variables para los campos del formulario
        $this->view->name = '';
        $this->view->email = '';
        $this->view->subject = '';
        $this->view->message = '';

        $this->view->render('contactar/index');

    }
}