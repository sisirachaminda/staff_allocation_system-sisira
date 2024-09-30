<?php
ob_start();
//error_reporting(0);
include 'db-connect.php';
require_once('tcpdf_includea4l.php');

$cddate=date("Y-m-d");
$cdyear=date("Y");

if($_GET['su']=="All"){
	$subjectr="All";
}
else{
	$select6="SELECT * FROM subjects WHERE subject_id='$_GET[su]'";
	$result6 = $conn->query($select6);
	while($row6 = $result6->fetch_assoc()) {
		  $subjectr=$row6['subject_name'];
	}
}

if($_GET['me']=="All"){
	$mediumr="All";
}
else{
	if($_GET['me'] == '2') {
		$mediumr = 'Sinhala';
	}else if($_GET['me'] == '3') {
		$mediumr = 'Tamil';
	}else if($_GET['me'] == '4') {
		$mediumr = 'English';
	}
}

	
	
	class MYPDF extends TCPDF {

		//Page header
		public function Header() {
			
			include 'db-connect.php';
			$cddate=date("Y-m-d");
			$cdyear=date("Y");
			
			if($_GET['su']=="All"){
				$subjectr="All";
			}
			else{
				$select6="SELECT * FROM subjects WHERE subject_id='$_GET[su]'";
				$result6 = $conn->query($select6);
				while($row6 = $result6->fetch_assoc()) {
					  $subjectr=$row6['subject_name'];
				}
			}
			
			if($_GET['me']=="All"){
				$mediumr="All";
			}
			else{
				if($_GET['me'] == '2') {
					$mediumr = 'Sinhala';
				}else if($_GET['me'] == '3') {
					$mediumr = 'Tamil';
				}else if($_GET['me'] == '4') {
					$mediumr = 'English';
				}
			}
			
			$this->SetFont('times', 'B', 20);
				
				$html ='<table border="0">
										<tr>
											<td width="100%"><h2 align="center" style="color:#001f4d;font-size:18px"> Department Of Exaination </h2> </td>
										</tr>';
								$html.= '<tr>
											<td width="100%" style="color:#001f4d;font-size:18px"><h5 align="center"> For G.C.E (A/L) Examinatin '.$cdyear.'  </h5> </td>
										</tr>';
								$html.='<tr>
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">Not Selected Examiner List</h5> </td>
										</tr>';
								$html.='<tr>
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">'.$subjectr.' - '.$mediumr.'</h5></td>
										</tr>';
					$html.='</table>
					<hr>
					';
				$this->writeHTML($html, true, false, true, false, '');
				// Title
		  
		}
			public function Footer() {
				
				
				$ftext='<hr>
					<table border="0" width="100%">
							<tr>
								<td width="20%"></td>
								<td width="80%" align="right">Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
							</tr>
							
					</table>';
			// Position at 15 mm from bottom
			$this->SetY(-8);
			// Set font
			$this->SetFont('times', 'I', 12);
			// Page number
			$this->writeHTML($ftext, true, false, true, false, '');
		}
	}
	
	
	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);

	$pdf->SetTitle('Not Selected Examiner List Report');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('times', '', 18);

	// add a page
	$pdf->AddPage();
		
	$html='<table border="1" width="100%">';
	$html.='<tbody>';
			$html.='
				<tr style="background-color:#3b4e87;color:#ffffff;font-size:16px">
					<td width="23%"> Name</td>
					<td width="10%"> NIC</td>
					<td width="10%"> Mobile No</td>
					<td width="10%"> Selected 1st Town</td>
					<td width="10%"> Selected 2nd Town</td>
					<td width="10%"> District</td>
					<td width="10%" align="center">Subject</td>
					<td width="10%" align="center">Medium</td>
					<td width="7%" align="center">Marks</td>
					
				</tr>';	

			if($_GET['su']=='All' && $_GET['me']=='All'){
				$select2 = "SELECT * FROM basicdetails WHERE marks IS NOT NULL
														 AND reject_reson='You Are Not Selected for marking on this time'
														 AND reject_panel='System'
														ORDER BY marks DESC";
			}
			else if($_GET['su']=='All' && $_GET['me']!='All'){
				$select2 = "SELECT * FROM basicdetails WHERE marks IS NOT NULL
														 AND medium='$_GET[me]'
														 AND reject_reson='You Are Not Selected for marking on this time'
														 AND reject_panel='System'
														ORDER BY marks DESC";
			}
			else if($_GET['su']!='All' && $_GET['me']=='All'){
				$select2 = "SELECT * FROM basicdetails WHERE marks IS NOT NULL
														 AND subject='$_GET[su]'
														 AND reject_reson='You Are Not Selected for marking on this time'
														 AND reject_panel='System'
														ORDER BY marks DESC";
			}
			else{
				$select2 = "SELECT * FROM basicdetails WHERE marks IS NOT NULL
														 AND subject='$_GET[su]'
														 AND medium='$_GET[me]'
														 AND reject_reson='You Are Not Selected for marking on this time'
														 AND reject_panel='System'
														ORDER BY marks DESC";
			}
            $result2 = $conn->query($select2);
            while($row2 = $result2->fetch_assoc()) {
				
				$med = $row2['medium'];
				if($med == '2') {
					$medium = 'Sinhala';
				}else if($med == '3') {
					$medium = 'Tamil';
				}else if($med == '4') {
					$medium = 'English';
				}
				
				  
				$select3="SELECT * FROM town WHERE town_id='$row2[firstTown]'";
				$result3 = $conn->query($select3);
				while($row3 = $result3->fetch_assoc()) {
					  $town1=$row3['town_id']."-".$row3['town_name'];
				}
				
				$select5="SELECT * FROM town WHERE town_id='$row2[secondTown]'";
				$result5 = $conn->query($select5);
				while($row5 = $result5->fetch_assoc()) {
					  $town2=$row5['town_id']."-".$row5['town_name'];
				}
				  
				$select4="SELECT * FROM subjects WHERE subject_id='$row2[subject]'";
				$result4 = $conn->query($select4);
				while($row4 = $result4->fetch_assoc()) {
					  $subject=$row4['subject_name'];
				}
				
				$select6="SELECT * FROM district WHERE district_id='$row2[workDistrict]'";
				$result6 = $conn->query($select6);
				while($row6 = $result6->fetch_assoc()) {
					  $district=$row6['district_id']."-".$row6['district_name'];
				}
				
				
				
                $html.='<tr style="font-size:16px">
					        <td width="23%"> '.$row2['initialName'].'</td>';
					$html.='<td width="10%"> '.$row2['nic'].'</td>';
					$html.='<td width="10%"> '.$row2['mobilephone'].'</td>';
					$html.='<td width="10%"> '.$town1.'</td>';
					$html.='<td width="10%"> '.$town2.'</td>';
					$html.='<td width="10%"> '.$district.'</td>';
					$html.='<td width="10%"> '.$subject.'</td>';
					$html.='<td width="10%"> '.$medium.'</td>';
					$html.='<td width="7%" align="right" style="background-color:#DCDCDC;"> '.number_format($row2['marks'],0).'</td>';
				$html.='</tr>';
				
				
				
            }

	$html.='</tbody>';
	$html.='</table>';
	
	
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('NotSelectedExaminer_List_'.$_GET['su'].'_'.$mediumr.'.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+