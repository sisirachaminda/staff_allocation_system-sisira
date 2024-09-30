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
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">Marking Progress</h5> </td>
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

	$pdf->SetTitle('Marking Progress Report');
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
					<td width="5%" rowspan="2"> #</td>
					<td width="11%" rowspan="2"> Designation</td>
					<td width="16%" rowspan="2" align="center">Initial Name</td>
					<td width="12%" rowspan="2" align="center">NIC No</td>
					
					<td width="56%" colspan="8" align="center">Complete Paper</td>
				</tr>
				<tr style="background-color:#3b4e87;color:#ffffff;font-size:16px">

					<td width="7%" align="center">Paper I</td>
					<td width="7%" align="center">Paper I %</td>
					<td width="7%" align="center">Paper II</td>
					<td width="7%" align="center">Paper II %</td>
					<td width="7%" align="center">Paper III</td>
					<td width="7%" align="center">Paper III %</td>
					<td width="7%" align="center">Total</td>
					<td width="7%" align="center">Total %</td>
				</tr>';	

            
            
            
			$all_ttcompletepaper1=0;
			$all_ttcompletepaper2=0;
			$all_ttcompletepaper3=0;
			$all_ttcompletepaperall=0;
			
			
			
			$ttassignpaper1=0;
			$ttassignpaper2=0;
			$ttassignpaper3=0;
			$ttassignpaperall=0;
			
			$select12="SELECT SUM(paper1) AS assignpaper1,
							  SUM(paper2) AS assignpaper2,
							  SUM(paper3) AS assignpaper3 
							  FROM markingcenters WHERE panelNo='$ses_panelno'";
			$result12 = $conn->query($select12);
			while($rows12 = $result12->fetch_assoc()){
				$ttassignpaper1=$rows12['assignpaper1'];
				$ttassignpaper2=$rows12['assignpaper2'];;
				$ttassignpaper3=$rows12['assignpaper3'];;
			}
				
			$ttassignpaperall=$ttassignpaper1+$ttassignpaper2+$ttassignpaper3;
			
			$ds=0;
			$select2 = "SELECT * FROM markingcenters INNER JOIN basicdetails ON markingcenters.panelNo=basicdetails.panelNo 
															WHERE markingcenters.panelNo='$ses_panelno' 
															ORDER BY basicdetails.marks DESC";
            $result2 = $conn->query($select2);
            while($row2 = $result2->fetch_assoc()) {
				
				$ds++;
				
				if($row2['appointedAs'] == 'adchief') {
					$appoint = 'Aditional Chief';
				} 
				if($row2['appointedAs'] == 'examiner') {
					$appoint = 'Examiner';
				}
				
				$ttindipresentage1=0;
				$ttindipresentage2=0;
				$ttindipresentage3=0;
				$ttindipresentageall=0;
				
				
				
				
				$ttcompletepaper1=0;
				$ttcompletepaper2=0;
				$ttcompletepaper3=0;
				$ttcompletepaperall=0;
				
				$select13="SELECT SUM(markingprogress.HP1) AS completepaper1,
								  SUM(markingprogress.HP2) AS completepaper2,
								  SUM(markingprogress.HP3) AS completepaper3
													  FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																		INNER JOIN markingprogress ON basicdetails.examiner_id=markingprogress.examinerid 
																			   WHERE markingcenters.panelNo='$ses_panelno'
																			    AND basicdetails.examiner_id='$row2[examiner_id]'";
				$result13 = $conn->query($select13);
				while($rows13 = $result13->fetch_assoc()){
					$ttcompletepaper1=$rows13['completepaper1'];
					$ttcompletepaper2=$rows13['completepaper2'];
					$ttcompletepaper3=$rows13['completepaper3'];
				}
				
				$ttcompletepaperall=$ttcompletepaper1+$ttcompletepaper2+$ttcompletepaper3;
				
				$ttindipresentage1=($ttcompletepaper1/$ttassignpaper1)*100;
				$ttindipresentage2=($ttcompletepaper2/$ttassignpaper2)*100;
				$ttindipresentage3=($ttcompletepaper3/$ttassignpaper3)*100;
				$ttindipresentageall=($ttcompletepaperall/$ttassignpaperall)*100;
               
                $html.='<tr style="font-size:16px">
					        <td width="5%"> '.$ds.'&nbsp;&nbsp;</td>';
					$html.='<td width="11%"> '.$appoint.'</td>';
					$html.='<td width="16%"> '.$row2['initialName'].'</td>';
					$html.='<td width="12%"> '.$row2['nic'].'</td>';
					
					$html.='<td width="7%" align="right"> '.number_format($ttcompletepaper1,0).'&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right"> '.number_format($ttindipresentage1,0).'%&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right"> '.number_format($ttcompletepaper2,0).'&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right"> '.number_format($ttindipresentage2,0).'%&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right"> '.number_format($ttcompletepaper3,0).'&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right"> '.number_format($ttindipresentage3,0).'%&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right" style="background-color:#DCDCDC;"> '.number_format($ttcompletepaperall,0).'&nbsp;&nbsp;</td>';
					$html.='<td width="7%" align="right" style="background-color:#DCDCDC;"> '.number_format($ttindipresentageall,0).'%&nbsp;&nbsp;</td>';
				
				$html.='</tr>';
				
				$all_ttcompletepaper1+=$ttcompletepaper1;
				$all_ttcompletepaper2+=$ttcompletepaper2;
				$all_ttcompletepaper3+=$ttcompletepaper3;
				$all_ttcompletepaperall+=$ttcompletepaperall;
				
				
            }
			
			$all_ttindipresentage1=($all_ttcompletepaper1/$ttassignpaper1)*100;
			$all_ttindipresentage2=($all_ttcompletepaper2/$ttassignpaper2)*100;
			$all_ttindipresentage3=($all_ttcompletepaper3/$ttassignpaper3)*100;
			$all_ttindipresentageall=($all_ttcompletepaperall/$ttassignpaperall)*100;
            
            $html.='<tr style="background-color:#DCDCDC;font-size:18px;font-weight:bold;">
					<td align="center" width="44%" colspan="4"> Total Progress</td>
					
					<td align="right" width="7%">'.number_format($all_ttcompletepaper1,0).'&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttindipresentage1,2).'%&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttcompletepaper2,0).'&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttindipresentage2,2).'%&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttcompletepaper3,0).'&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttindipresentage3,2).'%&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttcompletepaperall,0).'&nbsp;&nbsp;</td>
					<td align="right" width="7%">'.number_format($all_ttindipresentageall,2).'%&nbsp;&nbsp;</td>';
			$html.='</tr>';
			
	$html.='</tbody>';
	$html.='</table>';
	
	
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Marking Progress_Report_'.$ses_panelno.'.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+