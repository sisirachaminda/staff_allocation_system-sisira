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
    <title>Application for Marking</title>

    <link rel="stylesheet" href="plugin/font-awesome.min.css">
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
          <form method ="post" id="msform" enctype="multipart/form-data" > 
            <!-- Tittle -->
            <div class="tittle">
              <h1>Edit Marking Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Basic Details</li>  
              <li class="active">Service Details</li> 
              <li>Academic and professional qualifications</li>
              <li>Declaration</li>
            </ul>
            
			<?php
			$statusofupd=0;
			$select2 = "SELECT * FROM servicedetails WHERE examiner_id='$ses_ukey'";
			$result2 = $conn->query($select2);
			if ($result2->num_rows > 0) {
				$statusofupd=1;
				
				while($rows2 = $result2->fetch_assoc()) {
					
					$bs1=$rows2['apoAsTeacher']; 
					$bs2=$rows2['designation']; 
					$bs3=$rows2['apoAbovePost']; 
					$bs4=$rows2['apoAsGraduate']; 
					$bs5=$rows2['serviceAsGraduate']; 
					$bs6=$rows2['serviceAsDiploma']; 
				}
			}
			
			?>
			
			
			<!-- fieldsets -->
            <fieldset>
              <h3>Service Details</h3>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label for="validationTooltip01" >06.Date of Appointment as a teacher:</label>
                  <input type="date" class="form-control" name="apoAsTeacher" id="apoAsTeacher" placeholder="app"  readonly value="<?php if($statusofupd==1){ echo $bs1;} ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">7(a).Present Designation(service & grade):</label>
                  <select id="designation" name="designation" class="form-control" readonly>
                    
                    <?php
					 
					  if($statusofupd==1){
						$select6 = "SELECT * FROM designation WHERE designation_id='$bs2'";
						$result6 = $conn->query($select6);	
						while($row6=$result6->fetch_assoc()) {
							$sel6 = $sel6."<option value='" .$row6['designation_id']."'>" . $row6['designation_name'] ."</option>";
						}
						echo $sel6;
						
					  }
					  
					?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Date of Appointment to the above post:</label>
                  <input type="date" class="form-control" name="apoAbovePost" id="apoAbovePost" readonly value="<?php if($statusofupd==1){ echo $bs3;} ?>">
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;">
                <label for="validationTooltip02">8(a).Date of Appointment as a graduate/higher deploma teacher:</label>
                  <input type="date" class="form-control" name="apoAsGraduate" id="apoAsGraduate" readonly value="<?php if($statusofupd==1){ echo $bs4;} ?>">
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;">
                  <label for="validationTooltip02">(b).Period of service as a graduate/higher deploma teacher(years):</label>
                  <input type="number" class="form-control" name="serviceAsGraduate" id="serviceAsGraduate" readonly value="<?php if($statusofupd==1){ echo $bs5;} ?>">
                  <label id="serviceAsGraduateerror"></label>
                </div>
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label for="validationTooltip02">09.Period of service as a holder of Diploma/post graduate Diploma in education or similar(years):</label>
                  <input type="number" class="form-control" name="serviceAsDiploma" id="serviceAsDiploma" readonly value="<?php if($statusofupd==1){ echo $bs6;} ?>">
                  <label id="serviceAsDiplomaerror"></label>
                </div>
              </div>
              <a href="viewapp1.php"><button type="button" class="btn btn-danger">Back</button></a>
              <a href="viewapp3.php"><button type="button" class="btn btn-success">Continue</button></a>  
            </fieldset>  
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
    </main>
  </div>
</div>
</body>

</html>

