<?php
require('alphapdf.php');
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");

	$select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON  basicdetails.panelNo=markingcenters.panelNo
																					WHERE basicdetails.year1='$cdyear' 
																					  AND basicdetails.examiner_id='$_GET[id]'";
	$result1 = $conn->query($select1);
	while($row1 = $result1->fetch_assoc()) {
			
			$appoinmentletterdte=$row1['appoinmentletterdte'];
			$initialName=$row1['initialName'];
			$perAddress=$row1['perAddress'];
			$mobilephone=$row1['mobilephone'];
			$panelNo=$row1['panelNo'];
			
			$med = $row1['medium'];
			if($med == '2') {
				$medium = 'Sinhala';
			}else if($med == '3') {
				$medium = 'Tamil';
			}else if($med == '4') {
				$medium = 'English';
			}
			$select2="SELECT * FROM school WHERE sc_id='$row1[schoolID]'";
			$result2 = $conn->query($select2);
			while($row2 = $result2->fetch_assoc()) {
				  $school=$row2['sc_id']."-".$row2['schoolname'];
			}
			  
			$select3="SELECT * FROM town WHERE town_id='$row1[townNo]'";
			$result3 = $conn->query($select3);
			while($row3 = $result3->fetch_assoc()) {
				  $town=$row3['town_id']."-".$row3['town_name'];
			}
			  
			$select4="SELECT * FROM subjects WHERE subject_id='$row1[subjectID]'";
			$result4 = $conn->query($select4);
			while($row4 = $result4->fetch_assoc()) {
				  $subject=$row1['subjectID']."-".$row4['subject_name'];
			}
			
	}
	
	$selectmarkingperiod = "SELECT * FROM info WHERE name = 'markingperiod'";
	$resultmarkingperiod = $conn->query($selectmarkingperiod);	
	while($rows1 = $resultmarkingperiod->fetch_assoc()){
			$resultmarkingperiod_sdate = $rows1['sdate'];  
			$resultmarkingperiod_edate = $rows1['edate'];   
	}

$pdf = new AlphaPDF();
$pdf->AddPage();
$pdf->SetLineWidth(1.5);


// set alpha to semi-transparency
$pdf->SetAlpha(1);


// draw jpeg image
$pdf->Image('adexaminer1.jpg',10,20,200,250);

// restore full opacity
$pdf->SetAlpha(1);

// print name
$pdf->SetFont('Arial', '', 12);
$pdf->Text(135,72,''.$appoinmentletterdte.'');

$pdf->Text(35,130,''.$initialName.'');
$pdf->Text(35,140,''.$perAddress.'');
$pdf->Text(35,150,''.$mobilephone.'');

$pdf->Text(65,182,''.$subject.'');
$pdf->Text(65,197,''.$_GET['id'].'');
$pdf->Text(65,211,''.$panelNo.'');

$pdf->Text(65,228,''.$school.'');

$pdf->Text(143,243,''.$resultmarkingperiod_sdate.'');
$pdf->Text(143,248,''.$resultmarkingperiod_edate.'');


$pdf->AddPage();
$pdf->SetLineWidth(1.5);
$pdf->SetAlpha(1);


// draw jpeg image
$pdf->Image('adexaminer2.jpg',10,20,200,250);

$pdf->SetTitle('Additional Chief Examiner');
$pdf->Output('I','Additional_Chief_Examiner_'.$_GET['id'].'', true);

?>
