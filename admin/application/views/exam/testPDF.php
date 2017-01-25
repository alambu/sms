<?php
require('pdf generator/fpdf.php');

$my_page="<h3 style='color:red;'>Hello Buddy</h3>";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$my_page);
$pdf->Output();
?>