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
        $this->view->csrf_token = $this->createToken();

        $this->view->render('contactar/index');

    }

    public function crearTokenCsrf(){

        // Crear token csrf
        $token = md5(uniqid(microtime(), true));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
}