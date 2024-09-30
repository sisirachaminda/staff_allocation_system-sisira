<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Examiner History</title>

    
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
        <!-- Start Multiform HTML -->
        <section class="multi_step_form">  
			<?php
			$select1="SELECT * FROM basicdetails WHERE examiner_id='$_GET[id]'";
			$result1 = $conn->query($select1);
			while($row1 = $result1->fetch_assoc()) {
				 $name=$row1['initialName'];
				 $nic=$row1['nic'];
				 $address=$row1['perAddress'];
				 $gender=$row1['gender'];
				 $dob=$row1['dob'];
				 $mobileno=$row1['mobilephone'];
			}
			  
			if($gender==0){
				$sua4="Male";
			}
			if($gender==1){
				$sua4="Female";
			}
			?>
			<div class="row">
				<div class="col-md-8 mb-3">
					<label style="font-weight:bold;">Name : <?php echo $name; ?></label><br>
				</div>
				<div class="col-md-4 mb-3">
					<label style="font-weight:bold;">NIC No : <?php echo $nic; ?></label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 mb-3">
					<label style="font-weight:bold;">Address : <?php echo $address; ?></label><br>
				</div>
				<div class="col-md-4 mb-3">
					<label style="font-weight:bold;">Gender : <?php echo $sua4; ?></label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 mb-3">
					<label style="font-weight:bold;">Date of Birth : <?php echo $dob; ?></label><br>
				</div>
				<div class="col-md-4 mb-3">
					<label style="font-weight:bold;">Mobile No : <?php echo $mobileno; ?></label><br>
				</div>
			</div>
			
			<?php
			$select2="SELECT year1 FROM basicdetails WHERE examiner_id='$_GET[id]'";
			$result2 = $conn->query($select2);
			while($row2 = $result2->fetch_assoc()) {
				
				$select3="SELECT * FROM basicdetails WHERE examiner_id='$_GET[id]' AND year1='$row2[year1]'";
				$result3 = $conn->query($select3);
				while($row3 = $result3->fetch_assoc()) {
					$reject_reson=$row3['reject_reson'];
					$reject_panel=$row3['reject_panel'];
					$marks=$row3['marks'];
					$appointedAs=$row3['appointedAs'];
					$panelNo=$row3['panelNo'];
					$manualupdate=$row3['manualupdate'];
					
					if($appointedAs == 'adchief') {
						$appoint = 'Aditional Chief';
					} 
					if($appointedAs == 'examiner') {
						$appoint = 'Examiner';
					}
				
			?>
				<div class="card">
					<div class="card-body">
						<div class="row">
						  <div class="col-sm-12 col-lg-12">
								<h2 align="center" style="font-weight:bold;"><?php echo $row2['year1']; ?></h2>
						  </div>
						</div>
						
						<?php
						if($reject_reson!=null){
						?>
							<div class="row">
								
								<div class="col-sm-12 col-lg-12">
									<div align="center" style="font-size:16px;color:red;"><?php echo $reject_panel."  ".$reject_reson; ?></div>
								</div>
								
							</div>
						<?php
						}
						?>
						
						<?php
						if($manualupdate==1){
						?>
							<div class="row">
								
								<div class="col-sm-12 col-lg-12">
									<div align="center" style="font-size:16px;color:green;font-weight:bold;">Manual Selected</div>
								</div>
								
							</div>
						<?php
						}
						?>
						
						<?php
						if($appointedAs!=null){
						?>
							<div class="row">
								
								<div class="col-sm-12 col-lg-12">
									<div align="center" style="font-size:22px;color:green;font-weight:bold;"><?php echo $appoint; ?></div>
								</div>
								
							</div>
						<?php
						}
						?>
						<?php
						if($panelNo!=null){
							$select4="SELECT * FROM markingcenters WHERE panelNo='$panelNo'";
							$result4 = $conn->query($select4);
							while($row4 = $result4->fetch_assoc()) {
								$medmc = $row4['medium'];
								if($medmc == '2') {
									$mediummc = 'Sinhala';
								}else if($medmc == '3') {
									$mediummc = 'Tamil';
								}else if($medmc == '4') {
									$mediummc = 'English';
								}
								
								$select5="SELECT * FROM school WHERE sc_id='$row4[schoolID]'";
								$result5 = $conn->query($select5);
								while($row5 = $result5->fetch_assoc()) {
									  $schoolmc=$row5['sc_id']."-".$row5['schoolname'];
								}
								  
								$select6="SELECT * FROM town WHERE town_id='$row4[townNo]'";
								$result6 = $conn->query($select6);
								while($row6 = $result6->fetch_assoc()) {
									  $townmc=$row6['town_name'];
								}
								  
								$select4="SELECT * FROM subjects WHERE subject_id='$row4[subjectID]'";
								$result4 = $conn->query($select4);
								while($row4 = $result4->fetch_assoc()) {
									  $subjectmc=$row4['subject_name'];
								}
							}
						?>
							
							<div class="row">
								
								<div class="col-sm-6 col-lg-8">
									<div style="font-size:22px;color:green;font-weight:bold;">Marking Center : <?php echo $schoolmc." - ".$townmc; ?></div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div style="font-size:22px;color:green;font-weight:bold;">Panel No : <?php echo $panelNo; ?></div>
								</div>
							</div>
							<div class="row">
								
								<div class="col-sm-6 col-lg-8">
									<div style="font-size:22px;color:green;font-weight:bold;">Subject : <?php echo $subjectmc; ?></div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div style="font-size:22px;color:green;font-weight:bold;">Medium : <?php echo $mediummc; ?></div>
								</div>
							</div>
							<br>
							<?php
							$ttassignpaper1=0;
							$ttassignpaper2=0;
							$ttassignpaper3=0;
							$ttassignpaperall=0;
							
							$select12="SELECT SUM(paper1) AS assignpaper1,
											  SUM(paper2) AS assignpaper2,
											  SUM(paper3) AS assignpaper3 
											  FROM markingcenters WHERE panelNo='$panelNo'
											                         AND year1='$cdyear'";
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
																						   WHERE markingcenters.panelNo='$panelNo'
																							AND basicdetails.year1='$cdyear'
																							AND basicdetails.examiner_id='$_GET[id]'";
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
							?>
							
							<table class="table display" id="example" width="100%">
								<thead>
								  <tr>
									<th colspan="8" align="center" style="color:green;font-weight:bold;">Completed Papers</th>
								  </tr>
								  <tr>
									
									<th style="color:green;font-weight:bold;">PaperI</th>
									<th style="color:green;font-weight:bold;">PaperI %</th>
									<th style="color:green;font-weight:bold;">PaperII</th>
									<th style="color:green;font-weight:bold;">PaperII %</th>
									<th style="color:green;font-weight:bold;">PaperIII</th>
									<th style="color:green;font-weight:bold;">PaperIII %</th>
									
									<th style="font-size:22px;color:green;font-weight:bold;">All Progress</th>
									<th style="font-size:22px;color:green;font-weight:bold;">All Progress %</th>
								  </tr>
								</thead>
								<tbody>
									<tr>
										
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttcompletepaper1; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage1; ?>%&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttcompletepaper2; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage2; ?>%&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttcompletepaper3; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage3; ?>%&nbsp;&nbsp;</td>
										
										<td align="right" style="font-size:22px;color:green;font-weight:bold;"><?php echo $ttcompletepaperall; ?>&nbsp;&nbsp;</td>
										<td align="right" style="font-size:22px;color:green;font-weight:bold;"><?php echo $ttindipresentageall; ?>%&nbsp;&nbsp;</td>
									</tr>
								</tbody>
							</table>
						<?php
						}
						?>
						
						<br>
						<h5> Comment </h5>
						<table class="table display" id="example" width="100%">
							<?php
							$select7 = "SELECT * FROM chiefcomment WHERE year1='$cdyear' 
																	AND examiner_id='$_GET[id]'
																	ORDER BY date DESC";
							$result7 = $conn->query($select7);
							if ($result7->num_rows > 0) {
							?>
								<tr>
									<td align="center" style="color:#000000;font-size:14px;font-weight:bold"> No Comments</td>
								</tr>
							<?php
							}
							else{
								while($rows7 = $result7->fetch_assoc()){
							?>
								<tr>
									<td align="center" style="color:#000000;font-size:14px;font-weight:bold"> <?php echo $rows7['comments'];  ?></td>
								</tr>
							<?php
								}
							}
							?>
						</table>
					</div>
				</div>
				
			<?php
				}
			}
			?>
        </section> 
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
		
    </main>
  </div>
</div>

</body>

</html>

