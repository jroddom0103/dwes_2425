<?php

Class Alumno Extends Controller{

    function __construct(){

        parent ::__construct();

    }

    public function render(){

        $this->view->render('alumno/main/index');

    }

}