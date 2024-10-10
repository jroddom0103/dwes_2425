<?php

/*
    Array de dos dimensiones con índices numéricos

*/

$matriz = [
    [3, 5, 7, 8, 10],
    [6,2,7,0,9],
    [6,4,9,1,5]
];

// muestro el 7 del segundo array
// echo $matriz[1][2];

// mostrar todo el array
foreach ($matriz as $valor){
    foreach($valor as $num){
        echo $num;
        echo ", ";
        
    };
    echo "<br>";
};