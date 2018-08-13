<?php
// http://www.fpdf.org/en/tutorial/tuto1.htm
// http://www.fpdf.org/en/doc/index.php

// Minimal Example

require_once 'fpdf/fpdf.php';
/**
 * After including the library file, we create an FPDF object. The constructor is used here with the
 * default values: pages are in A4 portrait and the unit of measure is millimeter. It could have 
 * been specified explicitly with:
 *                                  $pdf = new FPDF('P','mm','A4');
 */
$pdf = new FPDF();
$pdf->AddPage(); // There's no page at the moment, so we have to add one with AddPage(). 
                 // The origin is at the upper-left corner and the current position is by default 
                 // set at 1 cm from the borders; the margins can be changed with SetMargins(). 


$pdf->SetFont('Arial','B',16); // Before we can print text, it's mandatory to select a font with SetFont(). We choose Arial bold 16:
    
$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(40,10,'Hello World2!');
$pdf->Cell(40,10,'Hello World3!');
// Insert a logo in the top-left corner at 300 dpi
// $pdf->Image('logo.png',10,10,-300);
// Insert a dynamic image from a URL
$pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',60,30,90,0,'PNG');
$pdf->Output();
?>