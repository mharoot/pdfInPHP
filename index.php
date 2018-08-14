<?php
/**
 * Created by PhpStorm.
 * User: Michael Harootoonyan
 * Date: 8/13/2018
 * Time: 6:37 PM
 */
require_once 'MotorCarrierProfilePDF.php';
$pdf = new MotorCarrierProfilePDF();

$pdf->view($pdf::UPDATE_PROFILE);
//$pdf->view($pdf::NEW_PROFILE);