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
    <title>Rejected Examiner Details</title>

    
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
                            <h2>Rejected Examiner Details</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    
                    <div class="row mt-2">
							<?php
							$checkData = "SELECT * FROM basicdetails WHERE year1='$cdyear' 
																			AND reject_reson IS NOT NULL";
							$resultData = $conn->query($checkData);
							if ($resultData->num_rows > 0) {
							?>
							<div class="table-responsive">
								<div class="table-responsive">
									<table id="example" class="display table table-striped table-hover" style="width:100%">
										<thead>
											<tr>
												<th width="10%">District</th>
												<th width="10%">Selected 1st Town</th>
												<th width="10%">Selected 2nd Town</th>
												<th width="10%">Name</th>
												<th width="10%">NIC</th>
												<th width="10%">Subject</th>
												<th width="10%">Medium</th>
												<th width="15%">Reject Reason</th>
												<th width="5%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$select1 = "SELECT * FROM basicdetails WHERE year1='$cdyear' 
																					  AND reject_reson IS NOT NULL";
											$result1 = $conn->query($select1);
											while($row1 = $result1->fetch_assoc()) {
													  $select5="SELECT * FROM subjects WHERE subject_id='$row1[subject]'";
													  $result5 = $conn->query($select5);
													  while($row5 = $result5->fetch_assoc()) {
														 $subject_name=$row5['subject_name'];
													  }
													  
													  $select2="SELECT * FROM district WHERE district_id='$row1[workDistrict]'";
													  $result2 = $conn->query($select2);
													  while($row2 = $result2->fetch_assoc()) {
														 $district_name=$row2['district_id']."-".$row2['district_name'];
													  }
													  
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
													  
													  if($row1['medium']==2){
														 $med="Sinhala"; 
													  }
													  if($row1['medium']==3){
														 $med="Tamil"; 
													  }
													  if($row1['medium']==4){
														 $med="English"; 
													  }
													
													echo "
													<tr>
														<td width='10%'>".$district_name."</td>
													    <td width='10%'>".$town1."</td>
													    <td width='10%'>".$town2."</td>
													    <td width='10%'>".$row1['initialName']."</td>
													    <td width='10%'>".$row1['nic']."</td>
													    <td width='10%'>".$row1['subject']." - ".$subject_name."</td>
													    <td width='10%'>".$row1['medium']." - ".$med."</td>
														<td width='15%'>".$row1['reject_reson']."</td>
														<td width='5%'>
														  <a href='preview_app.php?id=".$row1['examiner_id']."'><button class='btn btn-primary' type='button'>View</button></a>
													  </td>
													</tr>";
													
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
					order: [[0, 'acs']],
				});
			});
		</script>
    </main>
  </div>
</div>
</body>

</html>

