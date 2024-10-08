<?php

/**
 * Devolver el item de una calificación:
 *  - Deficiente, insuficiente, suficiente, ..
 */

$calif = 11;
switch ($calif) {

    case ($calif < 0 || $calif > 10):
        echo "Calificación No Permitida.";
        break;
    case ($calif < 2):
        echo "Deficiente.";
        break;
    case ($calif < 5):
        echo "Insuficiente.";
        break;
    case ($calif < 6):
        echo "Suficiente.";
        break;
    case ($calif < 7):
        echo "Bien.";
        break;
    case ($calif < 9):
        echo "Notable.";
        break;
    case ($calif <= 10):
        echo "Sobresaliente.";
        break;
}