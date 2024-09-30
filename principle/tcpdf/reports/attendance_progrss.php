<?php
ob_start();
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
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">Attendance Progress '.$cddate.'</h5> </td>
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

	$pdf->SetTitle('Attendance Progress Report');
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
					<td width="10%"> Panel No</td>
					<td width="23%"> Center No</td>
					<td width="15%" align="center">Town</td>
					<td width="15%" align="center">Subject Name</td>
					<td width="10%" align="center">Medium</td>
					
					<td width="9%" align="center">All Examiner</td>
					<td width="9%" align="center">Today Attendance</td>
					<td width="9%" align="center">Presentage %</td>
				</tr>';	

            
            
            $allnf_attendance=0;
			$allnf_allexaminer=0;
			
			if($_GET['su']=='All' && $_GET['me']=='All'){
				$select2 = "SELECT * FROM markingcenters";
			}
			else if($_GET['su']=='All' && $_GET['me']!='All'){
				$select2 = "SELECT * FROM markingcenters WHERE medium='$_GET[me]'";
			}
			else if($_GET['su']!='All' && $_GET['me']=='All'){
				$select2 = "SELECT * FROM markingcenters WHERE subjectID='$_GET[su]'";
			}
			else{
				$select2 = "SELECT * FROM markingcenters WHERE subjectID='$_GET[su]' AND medium='$_GET[me]'";
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
				$select5="SELECT * FROM school WHERE sc_id='$row2[schoolID]'";
				$result5 = $conn->query($select5);
				while($row5 = $result5->fetch_assoc()) {
					  $school=$row5['sc_id']."-".$row5['schoolname'];
				}
				  
				$select3="SELECT * FROM town WHERE town_id='$row2[townNo]'";
				$result3 = $conn->query($select3);
				while($row3 = $result3->fetch_assoc()) {
					  $town=$row3['town_id']."-".$row3['town_name'];
				}
				  
				$select4="SELECT * FROM subjects WHERE subject_id='$row2[subjectID]'";
				$result4 = $conn->query($select4);
				while($row4 = $result4->fetch_assoc()) {
					  $subject=$row4['subject_name'];
				}
				
				$nf_attendance=0;
				$nf_allexaminer=0;
				
				$select9="SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
														   WHERE markingcenters.panelNo='$row2[panelNo]'
															AND basicdetails.panelNo IS NOT NULL";
				$result9 = $conn->query($select9);
				$nf_allexaminer=$result9->num_rows;
				
				$select8="SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
													 INNER JOIN exattendance ON basicdetails.examiner_id=exattendance.examinerid 
														   WHERE markingcenters.panelNo='$row2[panelNo]'
															AND exattendance.date='$cddate'
															AND exattendance.attendance=1";
				$result8 = $conn->query($select8);
				$nf_attendance=$result8->num_rows;
				
				if($nf_attendance>0){
					$presentage=($nf_allexaminer/$nf_attendance)*100;
				}
				else{
					$presentage=0;
				}
               
                $html.='<tr style="font-size:16px">
					        <td width="10%"> '.$row2['panelNo'].'</td>';
					$html.='<td width="23%"> '.$school.'</td>';
					$html.='<td width="15%"> '.$town.'</td>';
					$html.='<td width="15%"> '.$subject.'</td>';
					$html.='<td width="10%"> '.$medium.'</td>';
					
					
					$html.='<td width="9%" align="right"> '.number_format($nf_allexaminer,0).'</td>';
					$html.='<td width="9%" align="right"> '.number_format($nf_attendance,0).'</td>';
					$html.='<td width="9%" align="right"> '.number_format($presentage,2).'%</td>';
				
				$html.='</tr>';
				
				$allnf_attendance+=$nf_attendance;
				$allnf_allexaminer+=$nf_allexaminer;
            }
			
			if($allnf_attendance>0){
				$allnf_attpresentage=($allnf_attendance/$allnf_allexaminer)*100;
				
			}
			else{
				$allnf_attpresentage=0;
			}
            
            $html.='<tr style="background-color:#DCDCDC;font-size:18px;font-weight:bold;">
					<td align="center" width="73%" colspan="5"> Total Progress</td>
					<td align="right" width="9%">'.number_format($allnf_allexaminer,0).'</td>
					<td align="right" width="9%">'.number_format($allnf_attendance,0).'</td>
					<td align="right" width="9%">'.number_format($allnf_attpresentage,0).'%</td>';
			$html.='</tr>';
			
	$html.='</tbody>';
	$html.='</table>';
	
	
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('AttendanceProgress_Report_'.$_GET['su'].'_'.$mediumr.'_'.$cddate.'.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+