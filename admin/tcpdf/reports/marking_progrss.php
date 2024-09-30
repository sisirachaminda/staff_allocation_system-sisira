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
											<td width="100%"><h5 align="center" style="color:#001f4d;font-size:18px">Marking Progress '.$cddate.'</h5> </td>
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
		
	$html='<table border="1" width="100%">';
	$html.='<tbody>';
			$html.='
				<tr style="background-color:#3b4e87;color:#ffffff;font-size:16px">
					<td width="6%" rowspan="2"> Panel No</td>
					<td width="13%" rowspan="2"> Center No</td>
					<td width="9%" rowspan="2" align="center">Town</td>
					<td width="9%" rowspan="2" align="center">Subject Name</td>
					<td width="7%" rowspan="2" align="center">Medium</td>
					
					<td width="16%" colspan="4" align="center">Assign Paper</td>
					<td width="40%" colspan="8" align="center">Complete Paper</td>
				</tr>
				<tr style="background-color:#3b4e87;color:#ffffff;font-size:16px">

					<td width="4%" align="center">Paper I</td>
					<td width="4%" align="center">Paper II</td>
					<td width="4%" align="center">Paper III</td>
					<td width="4%" align="center">Total</td>
					
					<td width="5%" align="center">Paper I</td>
					<td width="5%" align="center">Paper I %</td>
					<td width="5%" align="center">Paper II</td>
					<td width="5%" align="center">Paper II %</td>
					<td width="5%" align="center">Paper III</td>
					<td width="5%" align="center">Paper III %</td>
					<td width="5%" align="center">Total</td>
					<td width="5%" align="center">Total %</td>
				</tr>';	

            
            
            $all_ttassignpaper1=0;
			$all_ttassignpaper2=0;
			$all_ttassignpaper3=0;
			$all_ttassignpaperall=0;
			
			$all_ttcompletepaper1=0;
			$all_ttcompletepaper2=0;
			$all_ttcompletepaper3=0;
			$all_ttcompletepaperall=0;
			
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
				
				$ttindipresentage1=0;
				$ttindipresentage2=0;
				$ttindipresentage3=0;
				$ttindipresentageall=0;
				
				$ttassignpaper1=0;
				$ttassignpaper2=0;
				$ttassignpaper3=0;
				$ttassignpaperall=0;
				
				$select12="SELECT SUM(paper1) AS assignpaper1,
								  SUM(paper2) AS assignpaper2,
								  SUM(paper3) AS assignpaper3 
								  FROM markingcenters WHERE panelNo='$row2[panelNo]'";
				$result12 = $conn->query($select12);
				while($rows12 = $result12->fetch_assoc()){
					$ttassignpaper1=$rows12['assignpaper1'];
					$ttassignpaper2=$rows12['assignpaper2'];;
					$ttassignpaper3=$rows12['assignpaper3'];;
				}
				
				$ttassignpaperall=$ttassignpaper1+$ttassignpaper2+$ttassignpaper3;
				
				
				$ttcompletepaper1=0;
				$ttcompletepaper2=0;
				$ttcompletepaper3=0;
				$ttcompletepaperall=0;
				
				$select13="SELECT SUM(markingprogress.HP1) AS completepaper1,
								  SUM(markingprogress.HP2) AS completepaper2,
								  SUM(markingprogress.HP3) AS completepaper3
													  FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																		INNER JOIN markingprogress ON basicdetails.examiner_id=markingprogress.examinerid 
																			   WHERE markingcenters.panelNo='$row2[panelNo]'";
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
					        <td width="6%"> '.$row2['panelNo'].'</td>';
					$html.='<td width="13%"> '.$school.'</td>';
					$html.='<td width="9%"> '.$town.'</td>';
					$html.='<td width="9%"> '.$subject.'</td>';
					$html.='<td width="7%"> '.$medium.'</td>';
					
					
					$html.='<td width="4%" align="right"> '.number_format($ttassignpaper1,0).'</td>';
					$html.='<td width="4%" align="right"> '.number_format($ttassignpaper2,0).'</td>';
					$html.='<td width="4%" align="right"> '.number_format($ttassignpaper3,0).'</td>';
					$html.='<td width="4%" align="right" style="background-color:#DCDCDC;"> '.number_format($ttassignpaperall,0).'</td>';
					
					$html.='<td width="5%" align="right"> '.number_format($ttcompletepaper1,0).'</td>';
					$html.='<td width="5%" align="right"> '.number_format($ttindipresentage1,0).'%</td>';
					$html.='<td width="5%" align="right"> '.number_format($ttcompletepaper2,0).'</td>';
					$html.='<td width="5%" align="right"> '.number_format($ttindipresentage2,0).'%</td>';
					$html.='<td width="5%" align="right"> '.number_format($ttcompletepaper3,0).'</td>';
					$html.='<td width="5%" align="right"> '.number_format($ttindipresentage3,0).'%</td>';
					$html.='<td width="5%" align="right" style="background-color:#DCDCDC;"> '.number_format($ttcompletepaperall,0).'</td>';
					$html.='<td width="5%" align="right" style="background-color:#DCDCDC;"> '.number_format($ttindipresentageall,0).'%</td>';
				
				$html.='</tr>';
				
				$all_ttassignpaper1+=$ttassignpaper1;
				$all_ttassignpaper2+=$ttassignpaper2;
				$all_ttassignpaper3+=$ttassignpaper3;
				$all_ttassignpaperall+=$ttassignpaperall;
				
				$all_ttcompletepaper1+=$ttcompletepaper1;
				$all_ttcompletepaper2+=$ttcompletepaper2;
				$all_ttcompletepaper3+=$ttcompletepaper3;
				$all_ttcompletepaperall+=$ttcompletepaperall;
				
				
            }
			
			$all_ttindipresentage1=($all_ttcompletepaper1/$all_ttassignpaper1)*100;
			$all_ttindipresentage2=($all_ttcompletepaper2/$all_ttassignpaper2)*100;
			$all_ttindipresentage3=($all_ttcompletepaper3/$all_ttassignpaper3)*100;
			$all_ttindipresentageall=($all_ttcompletepaperall/$all_ttassignpaperall)*100;
            
            $html.='<tr style="background-color:#DCDCDC;font-size:18px;font-weight:bold;">
					<td align="center" width="44%" colspan="5"> Total Progress</td>
					<td align="right" width="4%">'.number_format($all_ttassignpaper1,0).'</td>
					<td align="right" width="4%">'.number_format($all_ttassignpaper1,0).'</td>
					<td align="right" width="4%">'.number_format($all_ttassignpaper3,0).'</td>
					<td align="right" width="4%">'.number_format($all_ttassignpaperall,0).'</td>
					
					<td align="right" width="5%">'.number_format($all_ttcompletepaper1,0).'</td>
					<td align="right" width="5%">'.number_format($all_ttindipresentage1,2).'%</td>
					<td align="right" width="5%">'.number_format($all_ttcompletepaper2,0).'</td>
					<td align="right" width="5%">'.number_format($all_ttindipresentage2,2).'%</td>
					<td align="right" width="5%">'.number_format($all_ttcompletepaper3,0).'</td>
					<td align="right" width="5%">'.number_format($all_ttindipresentage3,2).'%</td>
					<td align="right" width="5%">'.number_format($all_ttcompletepaperall,0).'</td>
					<td align="right" width="5%">'.number_format($all_ttindipresentageall,2).'%</td>';
			$html.='</tr>';
			
	$html.='</tbody>';
	$html.='</table>';
	
	
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Marking Progress_Report_'.$_GET['su'].'_'.$mediumr.'_'.$cddate.'.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+