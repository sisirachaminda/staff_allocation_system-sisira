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

if(isset($_POST['runProcess'])) {
	
	$select3= "SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo
											WHERE basicdetails.year1='$cdyear'";
	$result3 = $conn->query($select3);
	while($row3 = $result3->fetch_assoc()) {
		
		$paper1_price=0;
		$paper2_price=0;
		$paper3_price=0;
		
		$select5="SELECT * FROM markingfee WHERE subjectNo='$row3[subjectID]' AND year1='$cdyear'";
		$result5 = $conn->query($select5);
		while($row5 = $result5->fetch_assoc()) {
			  $paper1_price=$row5['paper1'];
			  $paper2_price=$row5['paper2'];
			  $paper3_price=$row5['paper3'];
		}
		
		$paper1completer=0;
		$paper2completer=0;
		$paper3completer=0;
		
		$select6="SELECT SUM(HP1) AS paper1complete, 
						  SUM(HP2) AS paper2complete,
						  SUM(HP3) AS paper3complete
						 FROM markingprogress WHERE examinerid='$row3[examiner_id]'";
		$result6 = $conn->query($select6);
		while($row6 = $result6->fetch_assoc()) {
			  $paper1completer=$row6['paper1complete'];
			  $paper2completer=$row6['paper2complete'];
			  $paper3completer=$row6['paper3complete'];
		}
		
		$paper1ttprice=$paper1completer*$paper1_price;
		$paper2ttprice=$paper2completer*$paper2_price;
		$paper3ttprice=$paper3completer*$paper3_price;
		
		if ($stmt1 = $conn->prepare("INSERT INTO payvoucher (year1,examiner_id,date,paper1_amount,paper2_amount,paper3_amount)
													VALUES ('$cdyear','$row3[examiner_id]','$cddate','$paper1ttprice','$paper2ttprice','$paper3ttprice')")) {
			$stmt1->execute();
			
		}
	}
	
	echo "<script>
				alert('Successfully Proceed!')
				window.location.href = 'vouchergenerate.php';
	</script>";
}

if(isset($_POST['clrdata'])){
	
	if ($stmt = $conn->prepare("DELETE FROM payvoucher WHERE year1='$cdyear'")) {
		$stmt->execute();
		
	}

	echo "<script>
				alert('Successfully Clear!')
				window.location.href = 'vouchergenerate.php';
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
    <title>Voucher Generator</title>

    
    <link rel="stylesheet" href="plugins/css@3.css">
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
                            <h2>Voucher Generate</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <?php
						if($evaluationperiod_edate>=$cddate){
						?>
						<div class='row mt-4'>
                            <?php 
                                $checkData = "SELECT * FROM basicdetails INNER JOIN payvoucher ON basicdetails.examiner_id=payvoucher.examiner_id 
																									WHERE payvoucher.year1='$cdyear'";
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
						$checkData = "SELECT * FROM basicdetails INNER JOIN payvoucher ON basicdetails.examiner_id=payvoucher.examiner_id 
																									WHERE payvoucher.year1='$cdyear'";
                        $resultData = $conn->query($checkData);
                        if ($resultData->num_rows > 0) {
						?>
						<div class="table-responsive">
                            <div class="table-responsive">
								<table id="example" class="display table table-striped table-hover" style="width:100%">
									<thead>
										<tr>
											<th width="10%">Panel No</th>
											<th width="16%">Name</th>
											<th width="8%">NIC</th>
											<th width="10%">Subject Code</th>
											<th width="8%">Medium</th>
											<th width="11%">Paper I</th>
											<th width="11%">Paper II</th>
											<th width="11%">Paper III</th>
											<th width="11%">Total </th>
											<th width="4%">Voucher </th>
										</tr>
									</thead>
									<tbody>
										<?php
										$x=1;
										$select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo
																		       INNER JOIN payvoucher ON basicdetails.examiner_id=payvoucher.examiner_id 
																									WHERE payvoucher.year1='$cdyear'";
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
														  $subject=$row4['subject_name'];
													}
													
													$paper1complete=0;
													$paper2complete=0;
													$paper3complete=0;
													$paperallcomplete=0;
													
													$select20="SELECT SUM(HP1) AS paper1complete, 
																	  SUM(HP2) AS paper2complete,
																	  SUM(HP3) AS paper3complete
																	 FROM markingprogress WHERE examinerid='$row1[examiner_id]'";
													$result20 = $conn->query($select20);
													while($row20 = $result20->fetch_assoc()) {
														  $paper1complete=$row20['paper1complete'];
														  $paper2complete=$row20['paper2complete'];
														  $paper3complete=$row20['paper3complete'];
													}
													
													$paperallcomplete=$paper1complete+$paper2complete+$paper3complete;
													
													$paper1amount=0;
													$paper2amount=0;
													$paper3amount=0;
													$paperallamount=0;
													
													$select21="SELECT SUM(paper1_amount) AS paper1amount, 
																	  SUM(paper2_amount) AS paper2amount,
																	  SUM(paper3_amount) AS paper3amount
																	 FROM payvoucher WHERE examiner_id='$row1[examiner_id]'";
													$result21 = $conn->query($select21);
													while($row21 = $result21->fetch_assoc()) {
														  $paper1amount=$row21['paper1amount'];
														  $paper2amount=$row21['paper2amount'];
														  $paper3amount=$row21['paper3amount'];
													}
													
													$paperallamount=$paper1amount+$paper2amount+$paper3amount;
												
												$voucherlink='fpdf/voucher.php?id='.$row1['examiner_id'].'';
												
												echo "
												<tr>
													<td width='10%'>".$row1['panelNo']."</td>
													<td width='16%'>".$row1['initialName']."</td>
													<td width='8%'>".$row1['nic']."</td>
													<td width='10%'>".$subject."</td>
													<td width='8%'>".$medium."</td>
													<td width='11%'>".$paper1complete." - ".number_format($paper1amount,2)."</td>
													<td width='11%'>".$paper2complete." - ".number_format($paper2amount,2)."</td>
													<td width='11%'>".$paper3complete." - ".number_format($paper3amount,2)."</td>
													<td width='11%'>".number_format($paperallamount,2)."</td>
													<td width='4%'><a href='".$voucherlink."'><button class='btn btn-primary' type='button'>View</button></a></td>
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

