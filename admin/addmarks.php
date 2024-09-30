<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
$selectevaluationperiod = "SELECT * FROM info WHERE name = 'evaluationperiod'";
$resultevaluationperiod = $conn->query($selectevaluationperiod);	
while($rows = $resultevaluationperiod->fetch_assoc()){
        $evaluationperiod_sdate = $rows['sdate'];  
        $evaluationperiod_edate = $rows['edate'];   
}

$selectmarkingend = "SELECT * FROM info WHERE name = 'markingend'";
$resultmarkingend = $conn->query($selectmarkingend);	
while($rows1 = $resultmarkingend->fetch_assoc()){
        $resultmarkingend_sdate = $rows1['sdate'];  
        $resultmarkingend_edate = $rows1['edate'];   
}
?>
<?php
$select10 = "SELECT * FROM markingscheam WHERE year1='$cdyear'";
$result10 = $conn->query($select10);
while($row10 = $result10->fetch_assoc()) {
	
	$mrksch1=$row10['degree_1stclass'];
	$mrksch2=$row10['degree_2ndclass'];
	$mrksch3=$row10['degree_1stgrade'];
	$mrksch4=$row10['degree_2ndgrade'];
	
	$mrksch5=$row10['diploma_followed'];
	
	$mrksch6=$row10['higheredudip'];
	$mrksch7=$row10['teacher_training'];
	
	$mrksch8=$row10['postgraduate_degree'];
	
	$mrksch9=$row10['spactivity'];
	
	
	$mrksch11=$row10['servicegraduate_benchmark_overmark'];
	
	$mrksch13=$row10['period_count1_mark'];
	$mrksch15=$row10['period_count2_mark'];
	$mrksch17=$row10['period_count3_mark'];
	
	
	$mrksch19=$row10['passpresenatage_mark1'];
	$mrksch21=$row10['passpresenatage_mark2'];
	$mrksch23=$row10['passpresenatage_mark3'];
}

if(isset($_POST['runProcess'])) {
	
	//...................................................... Given Marks Process Start ......................................................................
	
	$select2 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND principleApproveStatus=1";
	$result2 = $conn->query($select2);
	while($row2 = $result2->fetch_assoc()) {
		
		$examinerid = $row2["examiner_id"];
		$subject = $row2["subject"];
		$medium = $row2["medium"];
		$firstTown = $row2["firstTown"];
		$secondTown = $row2["secondTown"];
		
		
		$select3 = "SELECT * FROM eduqualifications WHERE year1='$cdyear' AND examiner_id='$examinerid'";
		$result3 = $conn->query($select3);
		while($row3 = $result3->fetch_assoc()) {
			
			$degree_type = $row3["degree_type"];
			$degree_follow = $row3["degree_follow"];
			$grade_degree = $row3["grade_degree"];
			
			$pdegree_follow = $row3["pdegree_follow"];
		}
		
		$select4 = "SELECT * FROM proqualifications WHERE year1='$cdyear' AND examiner_id='$examinerid'";
		$result4 = $conn->query($select4);
		while($row4 = $result4->fetch_assoc()) {
			
			$diplom_follow = $row4["deploma_follow"];
			
			$courseType = $row4["coursetype"];
			$courseFollow = $row4["coursefollow1"];
		}
		
		$select5 = "SELECT * FROM spactivity_schoolsubjectperiod WHERE year1='$cdyear' AND examiner_id='$examinerid'";
		$result5 = $conn->query($select5);
		while($row5 = $result5->fetch_assoc()) {
			
			$spactivity = $row5["spactivity"];
			
			$Grade12 = $row5["periods_g12"];
			$Grade13 = $row5["periods_g13"];
			
			$student_pass = $row5["student_pass"];
			$student_sat = $row5["student_sat"];
		}
		
		$select6 = "SELECT * FROM servicedetails WHERE year1='$cdyear' AND examiner_id='$examinerid'";
		$result6 = $conn->query($select6);
		while($row6 = $result6->fetch_assoc()) {
			
			$serviceAsGraduate = $row6["serviceAsGraduate"];
		}
		
		$select7 = "SELECT * FROM experience_selectsubject WHERE year1='$cdyear' AND examiner_id='$examinerid'";
		$result7 = $conn->query($select7);
		while($row7 = $result7->fetch_assoc()) {
			
			$assi_experince = $row7["assi_experince"];
			$yearAdCheief = $row7["yearAdCheief"];
			$accept_adex = $row7["accept_adex"];
			
		}
		
		$finalMark=0;
		$mark1=0;
		$mark2=0;
		$mark3=0;
		$mark4=0;
		$mark5=0;
		$mark6=0;
		$mark7=0;
		$mark8=0;
		$mark9=0;
		
		//1.1.1 / 1.1.2 check
		if($degree_follow!="NULL") {
			if($degree_type=="1") {
				$mark1 = $mrksch1;
			} else if($degree_type=="2") {
				$mark1 = $mrksch2;
			} else {
				$mark1 = 0;
			}
			if($grade_degree=="1") {
				$mark2 = $mrksch3;
			} else if($grade_degree=="2"){
				$mark2 = $mrksch4;
			} else {
				$mark2 = 0;
			}
		}
		
		//1.1.3 check
		if($diplom_follow!="NULL") {
			if($pdegree_follow=="NULL") {
				$mark3 = $mrksch5;
			} else {
				$mark3 = 0;
			}
		} else {
			$mark3 = 0;
		}
		
		//1.1.4 check
		if($degree_follow=="NULL") {
			if($courseType=="1") {
				$mark4=$mrksch6;
			} else if($courseType=="2") {
				$mark4=$mrksch7;
			} else {
				$mark4=0;
			}
		} else {
			$mark4=0;
		}
		
		// 1.1.5. check
		if($pdegree_follow!="NULL") {
			$mark5 = $mrksch8;
		} else {
			$mark5 = 0;
		}
		
		//1.2 check
		if($spactivity>0) {
			$mark6 = $mrksch9;
		} else {
			$mark6 = 0;
		}
		
		// 2.1 check
		if($serviceAsGraduate < 25) {
			$mark7 = $serviceAsGraduate;
		} else {
			$mark7 = $mrksch11;
		}
		
		// 3.1 check
		$subCount = $Grade12 + $Grade13;
		if($subCount>= 1 && $subCount<= 10) {
			$mark8 = $mrksch13;
		} else if($subCount > 11 && $subCount <= 25) {
			$mark8 = $mrksch15;
		} else if($subCount > 25) {
			$mark8 = $mrksch17;
		} else {
			$mark8 = 0;
		}
		
		// 4.1 check
		$passPercentage = ($student_pass / $student_sat) * 100;
		if($passPercentage >= 1 && $passPercentage <= 25) {
			$mark9 = $mrksch19;
		} else if($passPercentage > 25 && $passPercentage <= 50) {
			$mark9 = $mrksch21;
		} else if($passPercentage > 50) {
			$mark9 = $mrksch23;
		} else {
			$mark9 = 0;
		}
		
		$finalMark = $mark1 + $mark2 + $mark3 + $mark4 + $mark5 + $mark6 + $mark7 + $mark8 + $mark9;
		$descript = " A ".$mark1." B ".$mark2." C ".$mark3." D ".$mark4." E ".$mark5." F ".$mark6." G ".$mark7." H ".$mark8." I ".$mark9;
		
		if ($stmt = $conn->prepare("UPDATE basicdetails SET marks='$finalMark', 
															marksdescription='$descript'
															WHERE examiner_id='$examinerid' 
															  AND year1='$cdyear'")) {
			$stmt->execute();
			
		}
	}
	
	//...................................................... Given Marks Process End ......................................................................
	
	//...................................................... Additional Cheif Select Process Start ......................................................................
	$selectcenter = "SELECT * FROM markingcenters WHERE year1='$cdyear'";
	$resultcenter = $conn->query($selectcenter);
	while($rowcenter = $resultcenter->fetch_assoc()) {
			
			$townNo = $rowcenter['townNo'];
			$subjectIDd = $rowcenter['subjectID'];
			$mediumD = $rowcenter['medium'];
			$panelNo = $rowcenter['panelNo'];
			$isAstChief = $rowcenter['isAstChief'];

			if($isAstChief == '0') {
				$select8= "SELECT * FROM basicdetails INNER JOIN experience_selectsubject ON basicdetails.examiner_id=experience_selectsubject.examiner_id 
																							WHERE basicdetails.firstTown='$townNo' 
																							AND basicdetails.subject='$subjectIDd' 
																							AND basicdetails.medium='$mediumD' 
																							AND	basicdetails.year1='$cdyear' 
																							AND basicdetails.principleApproveStatus=1
																							AND basicdetails.appointedAs IS NULL
																							AND experience_selectsubject.accept_adex=1																				
																							ORDER BY experience_selectsubject.yearAdCheief DESC, 
																									 basicdetails.marks DESC LIMIT 1";
				$result8 = $conn->query($select8);
				while($row8 = $result8->fetch_assoc()) {
					$examinerid = $row8['examiner_id'];
					
					if ($stmt1 = $conn->prepare("UPDATE basicdetails SET appointedAs='adchief', 
																		panelNo='$panelNo',
																		selectmethod='System'
																	WHERE examiner_id='$examinerid' AND
																				year1='$cdyear'")) {
						$stmt1->execute();
						
					}
					
					if ($stmt2 = $conn->prepare("UPDATE markingcenters SET isAstChief='1'
																	WHERE panelNo='$panelNo'")) {
						$stmt2->execute();
						
					}
					
				}            
			}
	}
	//...................................................... Additional Cheif Select Process End ......................................................................
	
	//...................................................... Examiner Select Process Start ......................................................................
	
		//...................................................... First Center Select Process Start ......................................................................
		$selectcenter1 = "SELECT * FROM markingCenters WHERE isAstChief='1' AND year1='$cdyear'";
		$resultcenter1 = $conn->query($selectcenter1);
		while($rowcenter1 = $resultcenter1->fetch_assoc()) {
				$townNo1 = $rowcenter1['townNo'];
				$panelNo1 = $rowcenter1['panelNo'];
				$subjectIDd1 = $rowcenter1['subjectID'];
				$mediumD1 = $rowcenter1['medium'];
				$isExaminer1 = $rowcenter1['isExaminer'];
				$numofCand1 = $rowcenter1['numofCand'];
				
				if($numofCand1 >= $isExaminer1) {
					$xr = 0;
					$select11 = "SELECT * FROM basicdetails INNER JOIN experience_selectsubject ON basicdetails.examiner_id=experience_selectsubject.examiner_id 
																								WHERE basicdetails.firstTown='$townNo1' 
																								AND basicdetails.subject='$subjectIDd1' 
																								AND basicdetails.medium='$mediumD1' 
																								AND	basicdetails.year1='$cdyear' 
																								AND basicdetails.principleApproveStatus=1
																								AND basicdetails.appointedAs IS NULL														
																								ORDER BY experience_selectsubject.assi_experince DESC, 
																								       basicdetails.marks DESC LIMIT $numofCand1";
					$result11 = $conn->query($select11);
					while($row11 = $result11->fetch_assoc()) {
						$examiner_id1 = $row11['examiner_id'];
						$xr++;
						
						if ($stmt3 = $conn->prepare("UPDATE basicdetails SET appointedAs='examiner', 
																			panelNo='$panelNo1',
																			selectmethod='System'
																		WHERE examiner_id='$examiner_id1' AND
																					year1='$cdyear'")) {
							$stmt3->execute();
							
						}
						
						if ($stmt4 = $conn->prepare("UPDATE markingcenters SET isExaminer='$xr'
																		WHERE panelNo='$panelNo1'")) {
							$stmt4->execute();
							
						}
						
						
					}                      
				}
		}
		//...................................................... First Center Select Process End ......................................................................

		//...................................................... Second Center Select Process Start ......................................................................
		$selectcenter2 = "SELECT * FROM markingcenters WHERE isAstChief='1' AND year1='$cdyear' AND numofCand>isExaminer";
		$resultcenter2 = $conn->query($selectcenter2);
		if ($resultcenter2->num_rows > 0) {
			while($rowcenter2 = $resultcenter2->fetch_assoc()) {
				$townNo2 = $rowcenter2['townNo'];
				$panelNo2 = $rowcenter2['panelNo'];
				$subjectIDd2 = $rowcenter2['subjectID'];
				$mediumD2 = $rowcenter2['medium'];
				$isExaminer2 = $rowcenter2['isExaminer'];
				$numofCand2 = $rowcenter2['numofCand'];
				
				$balanccand=$numofCand2-$isExaminer2;
				
				if($numofCand2 >= $isExaminer2) {
					$xi = $isExaminer2;
					$select12 ="SELECT * FROM basicdetails INNER JOIN experience_selectsubject ON basicdetails.examiner_id=experience_selectsubject.examiner_id 
																								WHERE basicdetails.secondTown='$townNo2'
																								AND basicdetails.subject='$subjectIDd2' 
																								AND basicdetails.medium='$mediumD2' 
																								AND	basicdetails.year1='$cdyear' 
																								AND basicdetails.principleApproveStatus=1
																								AND basicdetails.appointedAs IS NULL														
																								ORDER BY experience_selectsubject.assi_experince DESC, 
																										 basicdetails.marks DESC LIMIT $balanccand";
					$result12 = $conn->query($select12);
					while($row12 = $result12->fetch_assoc()) {
						$examiner_id2 = $row12['examiner_id'];
						
						$xi++;
						
						if ($stmt5 = $conn->prepare("UPDATE basicdetails SET appointedAs='examiner', 
																			panelNo='$panelNo2',
																			selectmethod='System'
																		WHERE examiner_id='$examiner_id2' AND
																					year1='$cdyear'")) {
							$stmt5->execute();
							
						}
						
						if ($stmt6 = $conn->prepare("UPDATE markingcenters SET isExaminer='$xi'
																		WHERE panelNo='$panelNo2'")) {
							$stmt6->execute();
							
						}
						
					}                      
				}
			}
		}
		//...................................................... Second Center Select Process End ......................................................................
	//...................................................... Examiner Select Process End ......................................................................
	
	//...................................................... Not Select Examiner Start ......................................................................
		$select13 ="SELECT * FROM basicdetails WHERE appointedAs IS NULL";
		$result13 = $conn->query($select13);
		if($result13->num_rows > 0) {
			if ($stmt7 = $conn->prepare("UPDATE basicdetails SET reject_reson='You Are Not Selected for marking on this time', 
																reject_panel='System'
															WHERE year1='$cdyear' 
															AND principleApproveStatus=1 
															AND appointedAs IS NULL")) {
				$stmt7->execute();
				
			}
			
		}
	
	//...................................................... Not Select Examiner End ......................................................................
	
	echo "<script>
				alert('Successfully Proceed!')
				window.location.href = 'addmarks.php';
	</script>";
}

if(isset($_POST['clrdata'])){
	
	if ($stmt = $conn->prepare("UPDATE basicdetails SET marks=NULL, 
														marksdescription=NULL,
														appointedAs=NULL,
														panelNo=NULL,
														selectmethod=NULL,
														reject_reson=NULL,
														appoinmentletterdte=NULL,
														reject_panel=NULL
														WHERE year1='$cdyear'
														AND principleApproveStatus=1")) {
		$stmt->execute();
		
	}
	
	if ($stmt1 = $conn->prepare("UPDATE markingcenters SET isExaminer='0' WHERE year1='$cdyear' AND isExaminer IS NOT NULL")) {
		$stmt1->execute();
							
	}
	
	if ($stmt2 = $conn->prepare("UPDATE markingcenters SET isAstChief='0' WHERE year1='$cdyear' AND isAstChief IS NOT NULL")) {
		$stmt2->execute();
							
	}
	
	echo "<script>
				alert('Successfully Clear!')
				window.location.href = 'addmarks.php';
	</script>";
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Given Marks</title>

    
    <link rel="stylesheet" href="plugins/css@3.css"><link rel="stylesheet" href="plugin/font-awesome.min.css">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bootstrap-icons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="plugins/normalize.min.css">
    <link rel='stylesheet' href='plugins/bootstrap.css'>
    <link rel='stylesheet' href='plugins/intlTelInput.css'>
    <link rel='stylesheet' href='plugins/ionicons.min.css'>
    <link rel='stylesheet' href='plugins/nice-select.min.css'>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/demo.css">
	<link rel="stylesheet" href="css/dashboard.css">
	
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/jquery.min37.js"></script>
	
	<link href="plugins/bootstrap.min52.css" rel="stylesheet">
	<script src="plugins/bootstrap.bundle.min.js"></script>
    <!--<script src="js/validation.js"></script>-->

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
      .multi_step_form #msform #progressbar li {
        width: calc(100%/4) !important;
      }
      .multi_step_form #msform {
        max-width: 95% !important;
      }
	  
	  .pending th {
        background-color:#17b85d !important;
        color:#fff !important;
      }
    </style>

  </head>
  <body>
  <?php include ('header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <?php include ('sidebar.php'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- start -->
      <article>
        <div class="col col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                            <h2>Given Marks</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <?php
						if($evaluationperiod_edate>=$cddate){
						?>
						<div class='row mt-4'>
                            <?php 
                                $checkData = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND principleApproveStatus=1 AND marks>0";
                                $resultData = $conn->query($checkData);
                                if ($resultData->num_rows > 0) {
                                    echo "
                                        <div class='col col-sm-12 col-lg-2'>
                                            <input type='submit' name='clrdata' value='Clear Data' class='btn btn-danger'>
                                        </div>
                                        ";
                                } else {
                                    echo "
                                        <div class='col col-sm-12 col-lg-5'>
                                            <input type='submit' name='runProcess' value='Run Process' class='btn btn-success'>
                                        </div>";
                                }
                            ?>
                            
                        </div>
						<?php
						}
						?>
                    </form>
					<hr style="border-color: black;">
                    <div class="row mt-2">
                        <?php
						$checkData = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND principleApproveStatus=1 AND marks>0";
                        $resultData = $conn->query($checkData);
                        if ($resultData->num_rows > 0) {
						?>
						<div class="table-responsive">
                            <div class="table-responsive">
								<table id="example" class="display table table-striped table-hover" style="width:100%">
									<thead>
										<tr>
											<th width="4%">#</th>
											<th width="20%">Name</th>
											<th width="8%">NIC</th>
											<th width="6%">Subject Code</th>
											<th width="10%">Medium</th>
											<th width="20%">1st Choice</th>
											<th width="20%">2nd Choice</th>
											<th width="10%">Mark</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$x=1;
										$select1 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND principleApproveStatus=1 AND marks>0 ORDER BY marks DESC";
										$result1 = $conn->query($select1);
										while($row1 = $result1->fetch_assoc()) {
												
												$select3="SELECT * FROM town WHERE town_id='$row1[firstTown]'";
												$result3 = $conn->query($select3);
												while($row3 = $result3->fetch_assoc()) {
													  $town1=$row3['town_id']."-".$row3['town_name'];
												}
												  
												$select4="SELECT * FROM town WHERE town_id='$row1[secondTown]'";
												$result4 = $conn->query($select4);
												while($row4 = $result4->fetch_assoc()) {
													  $town2=$row4['town_id']."-".$row4['town_name'];
												}
												
												echo "
												<tr>
													<td width='4%'>".$x."</td>
													<td width='20%'>".$row1['initialName']."</td>
													<td width='8%'>".$row1['nic']."</td>
													<td width='6%'>".$row1['subject']."</td>
													<td width='10%'>".$row1['medium']."</td>
													<td width='20%'>".$town1."</td>
													<td width='20%'>".$town2."</td>
													<td width='10%'>".$row1['marks']."</td>
												</tr>";
												$x++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php
						}
					?>
                </div>
            </div>
        </div>
     
		<!-- END Multiform HTML -->
		
      </article>
		
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
	  
      <script src='plugins/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='plugins/jquery.easing.min.js'></script>
      <script src='plugins/intlTelInput.js'></script>
      <script src='plugins/popper.min.js'></script>
      <script src='plugins/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>   
	  <link rel="stylesheet" href="plugins/dataTables.dataTables.css" />
	  <script src="plugins/dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
	
				var table = $('#example').DataTable({
					order: [[7, 'desc']],
				});
			});
		</script>
    </main>
  </div>
</div>
</body>

</html>

