<?php

/*
    Ejemplo

    Hola mundo fpdf
*/

// Generar array de datos de alumnos
// id, nombre, apellidos, edad, curso
$alumnos = [
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
    [1, 'Juan', 'García', 18, 'DAW'],
    [2, 'María', 'López', 19, 'DAW'],
    [3, 'Pedro', 'Martínez', 20, 'DAW'],
    [4, 'Ana', 'González', 21, 'DAW'],
    [5, 'Luis', 'Rodríguez', 22, 'DAW'],
    [6, 'Carmen', 'Sánchez', 23, 'DAW'],
    [7, 'Javier', 'Fernández', 24, 'DAW'],
    [8, 'Rosa', 'Gómez', 25, 'DAW'],
    [9, 'Miguel', 'Jiménez', 26, 'DAW'],
    [10, 'Isabel', 'Pérez', 27, 'DAW'],
];

// Incluimos la librería fpdf
require('fpdf186/fpdf_utf8.php');

// Instanciamos un objeto de la clase fpdf
$pdf = new FPDF_UTF8('P','mm','A4');

// Añadimos una página
$pdf->AddPage();

// Establecemos la fuente y el tamaño
$pdf->SetFont('Courier','B',10);

// Color de fondo
$pdf->SetFillColor(200,220,255);

// Escribimos el título
$pdf->Cell(0,10,'Listado de alumnos', 0, 1, 'C', true);

// Dejar un espacio de dos líneas
$pdf->Ln(10);

// Sombreado de fondo
$pdf->SetFillColor(240,120,10);

// Escribimos los nombres de las columnas
$pdf->Cell(10,10,'#', 0, 0, 'C', true);
$pdf->Cell(60,10,'Nombre', 0, 0, 'L', true);
$pdf->Cell(80,10,'Apellidos', 0, 0, 'L', true);
$pdf->Cell(20,10,'Curso', 0, 0, 'L', true);
$pdf->Cell(0,10,'Edad', 0, 1, 'R', true);

$pdf->SetFont('Courier','',10);

// Color de fondo
$fondo = false;

// Escribimos los datos de los alumnos
foreach ($alumnos as $alumno) {
    $pdf->SetFillColor(205,205,205);
    $pdf->Cell(10,8,$alumno[0], 0, 0, 'C', $fondo);
    $pdf->Cell(60,8,$alumno[1], 0, 0, 'L', $fondo);
    $pdf->Cell(80,8,$alumno[2], 0, 0, 'L', $fondo);
    $pdf->Cell(20,8,$alumno[4], 0, 0, 'L', $fondo);
    $pdf->Cell(0,8,$alumno[3], 0, 1, 'R', $fondo);
    $fondo = !$fondo;
}

// Cerramos pdf
$pdf->Output('I','listado_alumnos.pdf',true);