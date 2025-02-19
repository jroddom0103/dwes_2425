<?php

class Pdf_libros extends FPDF_UTF8
{

    public function Header()
    {
        
        // Seleccionar courier normal tamaño 9
        $this->setFont('Courier', '', 9);

        // Celdas
        $this->Cell(50, 10, 'Geslibros 1.0', 'B', 0, 'L');
        $this->Cell(100, 10, 'Rodríguez Domínguez, Juan Antonio', 'B', 0, 'C');
        $this->Cell(0, 10, '2DAW 24/25', 'B', 1, 'R');
        
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
        $this->SetFillColor(54, 221, 64);

        // Escribimos el título
        $this->Cell(0, 10, 'Listado de libros', 1, 1, 'C', true);

        // Dejar un espacio de dos líneas
        $this->Ln(40+ 10);

        // Añadir imagen centrada debajo del título
        $this->Image('imgs/libro.png', 10, 43, 190, 40);
    }

    public function cabecera()
    {

        // Sombreado de fondo
        $this->SetFillColor(21, 130, 245);

        // Establecemos el color de letra
        $this->SetTextColor(255,255,255);

        // Escribimos los nombres de las columnas
        $this->Cell(10, 10, 'ID', 0, 0, 'C', true);
        $this->Cell(55, 10, 'Título', 0, 0, 'L', true);
        $this->Cell(55, 10, 'Autor', 0, 0, 'L', true);
        $this->Cell(55, 10, 'Editorial', 0, 0, 'L', true);
        $this->Cell(15, 10, 'Precio', 0, 1, 'R', true);
    }

}