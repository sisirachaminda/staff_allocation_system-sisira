<?php
ob_start();
include 'db-connect.php';
include 'session_handler.php';
require_once('tcpdf_includea4l.php');

$cddate=date("Y-m-d");
$cdyear=date("Y");

$select1 = "SELECT * FROM markingcenters WHERE panelNo='$ses_panelno'";
$result1 = $conn->query($select1);
while($row1 = $result1->fetch_assoc()) {
	$med = $row1['medium'];
	if($med == '2') {
		$medium = 'Sinhala';
	}else if($med == '3') {
		$medium = 'Tamil';
	}else if($med == '4') {
		$medium = 'English';
	}
	$select5="SELECT * FROM school WHERE sc_id='$row1[schoolID]'";
	$result5 = $conn->query($select5);
	while($row5 = $result5->fetch_assoc()) {
		  $school=$row5['sc_id']."-".$row5['schoolname'];
	}
	  
	$select3="SELECT * FROM town WHERE town_id='$row1[townNo]'";
	$result3 = $conn->query($select3);
	while($row3 = $result3->fetch_assoc()) {
		  $town=$row3['town_id']."-".$row3['town_name'];
	}
	  
	$select4="SELECT * FROM subjects WHERE subject_id='$row1[subjectID]'";
	$result4 = $conn->query($select4);
	while($row4 = $result4->fetch_assoc()) {
		  $subject=$row4['subject_name'];
	}
}

	
	
	class MYPDF extends TCPDF {

		//Page header
		public function Header() {
			
			include 'db-connect.php';
			$cddate=date("Y-m-d");
			$cdyear=date("Y");
			
			
			
			$this->SetFont('times', 'B', 20);
				
				$html ='<table border="0">
										<tr>
											<td width="100%"><h2 align="center" style="color:#001f4d;font-size:18px"> Department Of Exaination </h2> </td>
										</tr>';
								$html.= '<tr>
											<td width="100%" style="color:#001f4d;font-size:18px"><h5 align="center"> For G.C.E (A/L) Examinatin '.$cdyear.'  </h5> </td>
										</tr>';
								$html.='<tr>
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">Examiner List</h5> </td>
										</tr>';
								$html.='<tr>
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px"></h5></td>
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

	$pdf->SetTitle('Examiner List Report');
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
	$html='<table border="0" width="100%">';
		$html.='<tbody>';
			$html.='<tr style="font-size:22px;font-weight:bold">';
				$html.='<td width="50%">Center No : '.$school.'</td>';
				$html.='<td width="50%">Town : '.$town.'</td>';
			$html.='</tr>';
			$html.='<tr style="font-size:22px;font-weight:bold">';
				$html.='<td width="50%">Subject : '.$subject.'</td>';
				$html.='<td width="50%">Medium : '.$medium.'</td>';
			$html.='</tr>';
		$html.='</tbody>';
	$html.='</table>
	<br><br>';
	
	$html.='<table border="1" width="100%">';
	$html.='<tbody>';
			$html.='
				<tr style="background-color:#3b4e87;color:#ffffff;font-size:16px">
					<td width="5%"> #</td>
					<td width="15%" align="center">Designation</td>
					<td width="25%" align="center">Initial Name</td>
					<td width="10%" align="center">NIC No</td>
					<td width="30%" align="center">Permanent Address</td>
					<td width="10%" align="center">Mobile No</td>
					<td width="5%" align="center">Marks</td>
				</tr>';	

			$r=0;
			$select2 = "SELECT * FROM markingcenters INNER JOIN basicdetails ON markingcenters.panelNo=basicdetails.panelNo 
															WHERE markingcenters.panelNo='$ses_panelno' 
															ORDER BY basicdetails.marks DESC";
			
            $result2 = $conn->query($select2);
            while($row2 = $result2->fetch_assoc()) {
				
				$r++;
				
				if($row2['appointedAs'] == 'adchief') {
					$appoint = 'Aditional Chief';
				} 
				if($row2['appointedAs'] == 'examiner') {
					$appoint = 'Examiner';
				}
				
                $html.='<tr style="font-size:16px">
					        <td width="5%" align="right"> '.$r.'&nbsp;&nbsp;</td>';
					$html.='<td width="15%"> '.$appoint.'</td>';
					$html.='<td width="25%"> '.$row2['initialName'].'</td>';
					$html.='<td width="10%"> '.$row2['nic'].'</td>';
					$html.='<td width="30%"> '.$row2['perAddress'].'</td>';
					$html.='<td width="10%"> '.$row2['mobilephone'].'</td>';
					$html.='<td width="5%" align="right" style="background-color:#DCDCDC;"> '.number_format($row2['marks'],0).'</td>';
					
				
				$html.='</tr>';
				
				
				
            }

	$html.='</tbody>';
	$html.='</table>';
	
	
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Examiner_List_'.$ses_panelno.'.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+