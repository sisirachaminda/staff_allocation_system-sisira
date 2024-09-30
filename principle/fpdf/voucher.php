<?php
require('alphapdf.php');
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");

function numberTowords($num)
{
	$ones = array(
	0 =>"zero",
	1 => "one",
	2 => "two",
	3 => "three",
	4 => "four",
	5 => "five",
	6 => "six",
	7 => "seven",
	8 => "eight",
	9 => "nine",
	10 => "ten",
	11 => "eleven",
	12 => "twelve",
	13 => "thirteen",
	14 => "fourteen",
	15 => "fifteen",
	16 => "sixteen",
	17 => "seventeen",
	18 => "eighteen",
	19 => "nineteen",
	"014" => "fourteen"
	);
	$tens = array( 
	0 => "zero",
	1 => "ten",
	2 => "twenty",
	3 => "thirty", 
	4 => "forty", 
	5 => "fifty", 
	6 => "sixty", 
	7 => "seventy", 
	8 => "eighty", 
	9 => "ninety" 
	); 
	$hundreds = array( 
	"hundred", 
	"thousand", 
	"million", 
	"billion", 
	"trillion", 
	"quardrillion" 
	); /*limit t quadrillion */
	$num = number_format($num,2,".",","); 
	$num_arr = explode(".",$num); 
	$wholenum = $num_arr[0]; 
	$decnum = $num_arr[1]; 
	$whole_arr = array_reverse(explode(",",$wholenum)); 
	krsort($whole_arr,1); 
	$rettxt = ""; 
	foreach($whole_arr as $key => $i){
		
	while(substr($i,0,1)=="0")
			$i=substr($i,1,5);
	if($i < 20){ 
	/* echo "getting:".$i; */
	$rettxt .= $ones[$i]; 
	}elseif($i < 100){ 
	if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
	if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
	}else{ 
	if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
	if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
	if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
	} 
	if($key > 0){ 
	$rettxt .= " ".$hundreds[$key]." "; 
	}
	} 
	if($decnum > 0){
	$rettxt .= " and ";
	if($decnum < 20){
	$rettxt .= $ones[$decnum];
	}elseif($decnum < 100){
	$rettxt .= $tens[substr($decnum,0,1)];
	$rettxt .= " ".$ones[substr($decnum,1,1)];
	}
	}
	return $rettxt;
}

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
			
			$select7="SELECT * FROM markingfee WHERE subjectNo='$row1[subjectID]' AND year1='$cdyear'";
			$result7 = $conn->query($select7);
			while($row7 = $result7->fetch_assoc()) {
				  $paper1_price=$row7['paper1'];
				  $paper2_price=$row7['paper2'];
				  $paper3_price=$row7['paper3'];
			}
			
	}
	
	$select5="SELECT * FROM payvoucher WHERE year1='$cdyear' AND examiner_id='$_GET[id]'";
	$result5 = $conn->query($select5);
	while($row5 = $result5->fetch_assoc()) {
		  $paper1amount=$row5['paper1_amount'];
		  $paper2amount=$row5['paper2_amount'];
		  $paper3amount=$row5['paper3_amount'];
		  $date=$row5['date'];
		  $voucherno=$row5['id'];
	}
	
	$select6="SELECT SUM(HP1) AS paper1complete, 
						  SUM(HP2) AS paper2complete,
						  SUM(HP3) AS paper3complete
						 FROM markingprogress WHERE examinerid='$_GET[id]'";
	$result6 = $conn->query($select6);
	while($row6 = $result6->fetch_assoc()) {
		  $paper1completer=$row6['paper1complete'];
		  $paper2completer=$row6['paper1complete'];
		  $paper3completer=$row6['paper1complete'];
		  
	}
	
	$fullpay=$paper1amount+$paper2amount+$paper3amount;
	
	$amuword=numberTowords($fullpay);
	
$pdf = new AlphaPDF();
$pdf->AddPage();
$pdf->SetLineWidth(1.5);


// set alpha to semi-transparency
$pdf->SetAlpha(1);


// draw jpeg image
$pdf->Image('voucher.jpg',10,20,200,250);

// restore full opacity
$pdf->SetAlpha(1);

// print name
$pdf->SetFont('Arial', '', 12);
$pdf->Text(152,33,''.$voucherno.'');

$pdf->Text(62,55,''.$school.'');
$pdf->Text(98,63,'Charges of Paper Marking');
$pdf->Text(45,70,''.$initialName.'');

$pdf->Text(22,100,''.$date.'');
$pdf->Text(48,100,''.$subject.' Paper Marking');

$pdf->Text(48,106,'Paper I - '.number_format($paper1completer,0).' X '.number_format($paper1_price,2).'='.number_format($paper1amount,2).'');
$pdf->Text(48,111,'Paper II -'.number_format($paper2completer,0).' X '.number_format($paper2_price,2).'='.number_format($paper2amount,2).'');
$pdf->Text(48,116,'Paper III -'.number_format($paper3completer,0).' X '.number_format($paper3_price,2).'='.number_format($paper3amount,2).'');

$pdf->Text(170,100,''.number_format($fullpay,0).'');
$pdf->Text(190,100,'00');

$pdf->Text(170,154,''.number_format($fullpay,0).'');
$pdf->Text(190,154,'00');

$pdf->Text(25,213,''.$amuword.'');
$pdf->Text(86,218,'Zero');

$pdf->Text(50,239,''.$date.'');




$pdf->SetTitle('Voucher');
$pdf->Output('I','Voucher'.$_GET['id'].'', true);
?>
