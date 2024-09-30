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
    <title>View Examiner Application</title>

    
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
          <form method ="post" enctype="multipart/form-data" > 
            <!-- Tittle -->
            <div class="tittle">
              <h1>View Examiner Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            
			<!-- fieldsets -->
           
				<table class="table display" id="example" width="100%">
                        <thead>
                          <tr>
                            <th scope='col'>District</th>
                            <th scope='col'>Selecte 1st Town</th>
                            <th scope='col'>Selecte 2nd Town</th>
							<th scope='col'>Name</th>
                            <th scope='col'>NIC</th>
                            <th scope='col'>Subject</th>
                            <th scope='col'>Medium</th>
                            <th scope='col'>Mobile Phone</th>
                            <th scope='col'>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            echo "";
                            $selectExaminers = "SELECT * FROM basicdetails WHERE year1='$cdyear' 
																			AND principleApproveStatus=1";
                            $result = $conn->query($selectExaminers);
                            if ($result->num_rows > 0) {
								
								while($row = $result->fetch_assoc()) {
								  $select1="SELECT * FROM subjects WHERE subject_id='$row[subject]'";
								  $result1 = $conn->query($select1);
								  while($row1 = $result1->fetch_assoc()) {
									 $subject_name=$row1['subject_name'];
								  }
								  
								  $select2="SELECT * FROM district WHERE district_id='$row[workDistrict]'";
								  $result2 = $conn->query($select2);
								  while($row2 = $result2->fetch_assoc()) {
									 $district_name=$row2['district_id']."-".$row2['district_name'];
								  }
								  
								  $select3="SELECT * FROM town WHERE town_id='$row[firstTown]'";
								  $result3 = $conn->query($select3);
								  while($row3 = $result3->fetch_assoc()) {
									  $town1=$row3['town_id']."-".$row3['town_name'];
								  }
								  
								  $select4="SELECT * FROM town WHERE town_id='$row[secondTown]'";
								  $result4 = $conn->query($select4);
								  while($row4 = $result4->fetch_assoc()) {
									  $town2=$row4['town_id']."-".$row4['town_name'];
								  }
								  
								  if($row['medium']==2){
									 $med="Sinhala"; 
								  }
								  if($row['medium']==3){
									 $med="Tamil"; 
								  }
								  if($row['medium']==4){
									 $med="English"; 
								  }
                                  echo "<tr>
										  <td>".$district_name."</td>
										  <td>".$town1."</td>
										  <td>".$town2."</td>
										  <td>".$row['initialName']."</td>
										  <td>".$row['nic']."</td>
										  <td>".$row['subject']." - ".$subject_name."</td>
										  <td>".$row['medium']." - ".$med."</td>
										  <td>".$row['mobilephone']."</td>
										  <td>
											  <a href='preview_app.php?id=".$row['examiner_id']."'><button class='btn btn-primary' type='button'>View</button></a>
										  </td>
                                        </tr>";
                                }
                            } 
							else {
								echo "<tr><td colspan='6' align='center'>No Examiner application</td></tr>";
                            }
                          ?>
                        </tbody>
                </table>
           
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

<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
	
				var table = $('#example').DataTable({
					order: [[1, 'desc']],
				});
			});
</script>

</body>

</html>

