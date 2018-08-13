<?php
require_once 'fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',16); // Before we can print text, it's mandatory to select a font with SetFont(). We choose Arial bold 16:
    
// $pdf->Cell(40,10,'Hello World!');
// $pdf->Cell(40,10,'Hello World2!');
// $pdf->Cell(40,10,'Hello World3!');
// Insert a logo in the top-left corner at 300 dpi
// $pdf->Image('images/logo.png',10,10,-300);
// Insert a dynamic image from a URL


$sizeX = 270;
$sizeY = 360;

$offsetX = -35;
$offsetY = -40;

// 1st favorite so far
$pdf->Image('images/CA number application chp362 page 1.jpg',$offsetX, $offsetY, $sizeX, $sizeY,'JPG');
$pdf->AddPage(); 
$pdf->Image('images/CA number application chp362 page 2.jpg',$offsetX, $offsetY+5, $sizeX, $sizeY,'JPG');

// 2nd favorite so far
// $pdf->Image('images/CA number application chp362 page 1.jpg',-35, -20, 270, 360,'JPG');

// 3rd favorite so far
// $pdf->Image('images/CA number application chp362 page 1.jpg',-30, -20, 270, 270,'JPG');


$pdf->Output();
?>