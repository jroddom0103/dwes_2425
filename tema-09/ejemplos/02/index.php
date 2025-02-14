<?php

/*
    Ejemplo

    Hola mundo fpdf
*/
// Incluimos la librería fpdf
require('fpdf186/fpdf_utf8.php');

// Instanciamos un objeto de la clase fpdf
$pdf = new FPDF_UTF8();

// Añadimos una página
$pdf->AddPage();

// Establecemos la fuente y el tamaño
$pdf->SetFont('Courier','B',16);

// Escribimos el texto
$pdf->Cell(40,10,'¡Hola, mundo FPDF!');

// Alternativa
//$pdf->Cell(40,10,'¡Hola, mundo FPDF!');

// Cerramos pdf
$pdf->Output();