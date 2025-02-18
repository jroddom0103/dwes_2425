<?php

class Pdf_alumnos extends FPDF_UTF8
{

    public function Header()
    {

        // Seleccionar courier normal tamaño 9
        $this->setFont('Courier', '', 9);

        // Celda
        $this->Cell(0, 10, 'Lista de Alumnos - 2DAW - Curso 24/25', 'B', 1, 'C');

        // Salto de línea
        $this->Ln(10);
    }

    public function Footer()
    {

        $this->SetY(-10);

        $this->SetFont('Courier', '', 10);

        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');

    }

    public function titulo()
    {

        // Establecemos la fuente y el tamaño
        $this->SetFont('Courier', 'B', 10);

        // Color de fondo
        $this->SetFillColor(200, 220, 255);

        // Escribimos el título
        $this->Cell(0, 10, 'Listado de alumnos', 0, 1, 'C', true);

        // Dejar un espacio de dos líneas
        $this->Ln(10);
    }

    public function cabecera()
    {

        // Sombreado de fondo
        $this->SetFillColor(240, 120, 10);

        // Escribimos los nombres de las columnas
        $this->Cell(10, 10, '#', 0, 0, 'C', true);
        $this->Cell(60, 10, 'Nombre', 0, 0, 'L', true);
        $this->Cell(80, 10, 'Apellidos', 0, 0, 'L', true);
        $this->Cell(20, 10, 'Curso', 0, 0, 'L', true);
        $this->Cell(0, 10, 'Edad', 0, 1, 'R', true);
    }

}