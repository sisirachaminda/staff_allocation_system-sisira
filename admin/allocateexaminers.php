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
    <title>Allocate Examiner Details</title>

    
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
                            <h2>Allocate Examiner Details</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <div class="row mt-2">
							
							
								<div class="table-responsive">
									<table id="example" class="display table table-striped table-hover" style="width:100%">
										<thead>
											<tr>
												<th>Panel No</th>
												<th>Center No</th>
												<th>Town</th>
												<th>Subject Name</th>
												<th>Subject Code</th>
												<th>Medium</th>
												<th>Examiner Name</th>
												<th>NIC</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$all_ttassignpaper1=0;
											$all_ttassignpaper2=0;
											$all_ttassignpaper3=0;
											$all_ttassignpaperall=0;
											
											$all_ttcompletepaper1=0;
											$all_ttcompletepaper2=0;
											$all_ttcompletepaper3=0;
											$all_ttcompletepaperall=0;
											
											$select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON  basicdetails.panelNo=markingcenters.panelNo
																					WHERE basicdetails.year1='$cdyear' 
																					  AND basicdetails.principleApproveStatus=1 
																					  AND basicdetails.appointedAs='examiner'";
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
													
													echo "
													<tr>
														<td width='10%'>".$row1['panelNo']."</td>
														<td width='15%'>".$school."</td>
														<td width='10%'>".$town."</td>
														<td width='10%'>".$row1['subjectID']."</td>
														<td width='10%'>".$subject."</td>
														<td width='10%'>".$medium."</td>
														<td width='20%'>".$row1['initialName']."</td>
														<td width='10%'>".$row1['nic']."</td>
													</tr>";
													
											}
											?>
										</tbody>
									</table>
								</div>
							
					
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
					order: [[0, 'acs']],
				});
			});
		</script>
    </main>
  </div>
</div>
</body>

</html>

