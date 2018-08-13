<?php
// http://www.fpdf.org/en/tutorial/tuto1.htm
// http://www.fpdf.org/en/doc/index.php
require_once 'fpdf/fpdf.php';

// Minimal Example
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>