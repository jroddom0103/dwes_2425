<?php

include 'class/class.calculadora.php';

$operacion = new Class_calculadora(2,3,'-');
if($operacion.getOperador()=='+'){
    $operacion.suma(1,2);
}else if($operacion.getOperador()== '-'){

}else if($operacion.getOperador()== '/'){

}else if($operacion.getOperador()== '*'){

}else if($operacion.getOperador()== 'pow'){

}