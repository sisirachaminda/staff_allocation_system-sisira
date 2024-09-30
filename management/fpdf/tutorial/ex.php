<?php
require('alphapdf.php');

$pdf = new AlphaPDF();
$pdf->AddPage();
$pdf->SetLineWidth(1.5);



// set alpha to semi-transparency
$pdf->SetAlpha(0.5);



// draw jpeg image
$pdf->Image('lena.jpg',30,30,40);

// restore full opacity
$pdf->SetAlpha(1);

// print name
$pdf->SetFont('Arial', '', 12);
$pdf->Text(46,68,'Lena');

$pdf->Output();
?>
