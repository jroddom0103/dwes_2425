<?php

/*
    Ejemplo

    Hola mundo fpdf
*/
// Incluimos la librería fpdf
require('fpdf186/fpdf_utf8.php');

// Instanciamos un objeto de la clase fpdf
$pdf = new FPDF_UTF8('P','mm','A4');

// Añadimos una página
$pdf->AddPage();

// Establecemos la fuente y el tamaño
$pdf->SetFont('Courier','',10);

// Línea 1 que abarque todo el ancho del folioi
$pdf->Cell(0,10,'¡Hola, mundo FPDF!', 1, 1, 'C');

// Escribimos el texto
$pdf->Cell(40,10,'¡Hola, mundo FPDF!', 1);
$pdf->Cell(40,10,'¡Me llamo Juan!', 1);
$pdf->Cell(77,10,'Clase de DAW viernes a última hora.', 1, 1);

$pdf->Cell(40,10,'¡Hola, mundo FPDF!', 1);
$pdf->Cell(40,10,'¡Me llamo Juan!', 1);
$pdf->Cell(90,10,'Clase de DAW viernes a última hora.', 1, 1, 'R');

// Línea 3s

// Alternativa
//$pdf->Cell(40,10,'¡Hola, mundo FPDF!');

// Cerramos pdf
$pdf->Output('I','informe.pdf',true);