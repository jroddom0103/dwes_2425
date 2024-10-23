<?php

/*
    archivo: class.calculadora.php
    descripción: define clase calculadora con propiedad encapsulamiento
        - Propiedades: valor1, valor2, operador, resultado
        - Métodos: suma(), resta(); division(), multiplicacion(), potencia()

*/

class Class_calculadora
{
    # Atributos o propiedades
    private $valor1;
    private $valor2;
    private $operador;
    private $resultado;
    public function __construct(
        $valor1,
        $valor2,
        $operador,
        $resultado = null
    ) {
        $this->valor1 = $valor1;
        $this->valor2 = $valor2;
        $this->operador = $operador;
        $this->resultado = $resultado;
    }

    function getValor1(){
        return $this->valor1;
    }

    function getValor2(){
        return $this->valor2;
    }

    function getOperador(){
        return $this->operador;
    }

    function getresultado(){

    }
    
    function suma($valor1, $valor2)
    {
        $this->resultado = $valor1 + $valor2;
    }
    function resta($valor1, $valor2)
    {
        $this->resultado = $valor1 - $valor2;
    }
    function division($valor1, $valor2)
    {
        $this->resultado = $valor1 / $valor2;
    }
    function multiplicacion($valor1, $valor2)
    {
        $this->resultado = $valor1 * $valor2;
    }
    function potencia($valor1, $valor2)
    {
        $this->resultado = pow($valor1, $valor2);
    }

}