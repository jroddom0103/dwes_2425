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

    # Método constructor
    public function __construct(
        $valor1=0,
        $valor2=0,
        $operador=null,
        $resultado=0
    ) {
        $this->valor1 = $valor1;
        $this->valor2 = $valor2;
        $this->operador = $operador;
        $this->resultado = $resultado;
    }

    # Métodos get y set
    function getValor1(){
        return $this->valor1;
    }
    function setValor1($valor1){
        $this->valor1 = $valor1;
    }

    function getValor2(){
        return $this->valor2;
    }
    function setValor2($valor2){
        $this->valor2 = $valor2;
    }

    function getOperador(){
        return $this->operador;
    }
    function setOperador($operador){
        $this->operador = $operador;
    }

    function getresultado(){
        return $this->resultado;
    }
    function setResultado($resultado){
        $this->resultado = $resultado;
    }
    
    # Métodos que calculan el resultado de la operación
    function suma()
    {
        $this->operador = '+';
        $this->resultado = $this->valor1 + $this->valor2;
    }
    function resta()
    {
        $this->operador = '-';
        $this->resultado = $this->valor1 - $this->valor2;
    }
    function division()
    {
        $this->operador = '/';
        $this->resultado = $this->valor1 / $this->valor2;
    }
    function multiplicacion()
    {
        $this->operador = '*';
        $this->resultado = $this->valor1 * $this->valor2;
    }
    function potencia()
    {
        $this->operador = 'Potencia';
        $this->resultado = pow($this->valor1, $this->valor2);
    }

}