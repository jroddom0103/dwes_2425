<?php

/*
    archivo:class.jugador.php
    nombre: define la clase jugador sin encapsulamiento
*/

class Class_jugador{

    public $id;
    public $nombre;
    public $f_nacimiento;
    public $altura;
    public $peso;
    public $nacionalidad;
    public $num_camiseta;
    public $valor_mercado;
    public $equipo_id;
    public $posiciones_id;

    public function __construct(){
        $this->id=null;
        $this->nombre=null;
        $this->f_nacimiento=null;
        $this->altura=null;
        $this->peso=null;
        $this->nacionalidad=null;
        $this->num_camiseta=null;
        $this->valor_mercado=null;
        $this->equipo_id=null;
        $this->posiciones_id= [];
    }

    public function edad($f_nacimiento){
        $fecha_actual = new DateTime(date("Y-m-d",$f_nacimiento->getTimestamp()));
        $diferencia = $fecha_actual->diff($f_nacimiento);
        $edad = $diferencia->format("%y");
        return $edad;

    }
}



