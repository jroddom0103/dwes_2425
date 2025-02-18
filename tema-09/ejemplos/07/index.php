<?php

/*
    Ejemplo

    Hola mundo fpdf
*/


// Incluimos la librería fpdf
require('fpdf186/fpdf_utf8.php');

// Incluimos la clase pdf_alumnos
require('class/pdf_alumnos.php');

// Incluir datos
require('datos/basedatos.php');

// Creo objeto pdf_alumnos
$pdf = new Pdf_alumnos('P','mm','A4');

// Imprimir número página actual
$pdf->AliasNbPages();

// Añadimos una página
$pdf->AddPage();

// Añado el título
$pdf->titulo();

// Cabecera del listado
$pdf->cabecera();

// Cuerpo listado
$pdf->SetFont('Courier','',10);
// Fondo
$pdf->SetFillColor(205,205,205);

// Color de fondo
$fondo = false;

// Escribimos los datos de los alumnos
foreach ($alumnos as $alumno) {
    
    $pdf->Cell(10,8,$alumno[0], 0, 0, 'C', $fondo);
    $pdf->Cell(60,8,$alumno[1], 0, 0, 'L', $fondo);
    $pdf->Cell(80,8,$alumno[2], 0, 0, 'L', $fondo);
    $pdf->Cell(20,8,$alumno[4], 0, 0, 'L', $fondo);
    $pdf->Cell(0,8,$alumno[3], 0, 1, 'R', $fondo);
    $fondo = !$fondo;
}

// Cerramos pdf
$pdf->Output('I','listado_alumnos.pdf',true);