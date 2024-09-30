<?php
require('alphapdf.php');
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");

$select7 = "SELECT * FROM chiefdetails INNER JOIN markingcenters ON  chiefdetails.panelNo=markingcenters.panelNo
																					WHERE chiefdetails.year1='$cdyear' 
																					  AND chiefdetails.id='$_GET[id]'";
$result7 = $conn->query($select7);
while($row7 = $result7->fetch_assoc()) {
		
		$appoinmentletterdte=$row7['appoinmentletterdte'];
		$initialName=$row7['initialName'];
		$perAddress=$row7['perAddress'];
		$mobilephone=$row7['mobilephone'];
		$panelNo=$row7['panelNo'];
		
		
		$med1 = $row7['medium'];
		if($med1 == '2') {
			$medium1 = 'Sinhala';
		}else if($med1 == '3') {
			$medium1 = 'Tamil';
		}else if($med1 == '4') {
			$medium1 = 'English';
		}
		$select8="SELECT * FROM school WHERE sc_id='$row7[schoolID]'";
		$result8 = $conn->query($select8);
		while($row8 = $result8->fetch_assoc()) {
			  $school1=$row8['sc_id']."-".$row8['schoolname'];
		}
		  
		$select9="SELECT * FROM town WHERE town_id='$row7[townNo]'";
		$result9 = $conn->query($select9);
		while($row9 = $result9->fetch_assoc()) {
			  $town1=$row9['town_id']."-".$row9['town_name'];
		}
		  
		$select10="SELECT * FROM subjects WHERE subject_id='$row7[subjectID]'";
		$result10 = $conn->query($select10);
		while($row10 = $result10->fetch_assoc()) {
			  $subject1=$row7['subjectID']." - ".$row10['subject_name'];
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
$pdf->Image('cheif1.jpg',10,20,200,250);

// restore full opacity
$pdf->SetAlpha(1);

// print name
$pdf->SetFont('Arial', '', 12);
$pdf->Text(137,73,''.$appoinmentletterdte.'');

$pdf->Text(25,134,''.$initialName.'');
$pdf->Text(25,144,''.$perAddress.'');
$pdf->Text(25,154,''.$mobilephone.'');

$pdf->Text(65,188,''.$subject1.'');
$pdf->Text(65,204,''.$_GET['id'].'');
$pdf->Text(65,216,''.$panelNo.'');

$pdf->Text(65,231,''.$school1.'');

$pdf->Text(146,244,''.$resultmarkingperiod_sdate.'');
$pdf->Text(146,249,''.$resultmarkingperiod_edate.'');


$pdf->AddPage();
$pdf->SetLineWidth(1.5);
$pdf->SetAlpha(1);


// draw jpeg image
$pdf->Image('cheif2.jpg',10,20,200,250);
$pdf->SetTitle('Chief Examiner');
$pdf->Output('I','Chief_Examiner_'.$_GET['id'].'', true);

?>
