<?php
require('htmlpdf.php');

$pdf = new AlphaPDF();
// First page
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$html = "<table border='1'>
	<tr>
		<td width='200'></td>
		<td width='200'>Department of Examination - Sri Lanka</td>
	</tr>
</table>";

 $pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetAutoPageBreak(true , 2.0);
$pdf->Output();
?>
