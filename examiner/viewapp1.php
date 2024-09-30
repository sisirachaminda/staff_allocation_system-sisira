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
              <h1>Marking Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Basic Details</li>  
              <li>Service Details</li> 
              <li>Academic and professional qualifications</li>
              <li>Declaration</li>
            </ul>
            
			<?php
			$statusofupd=0;
			$select2 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey'";
			$result2 = $conn->query($select2);
			if ($result2->num_rows > 0) {
				$statusofupd=1;
				
				while($rows2 = $result2->fetch_assoc()) {
					
					$bs1=$rows2['subject']; 
					$bs2=$rows2['medium']; 
					$bs3=$rows2['firstTown']; 
					$bs4=$rows2['secondTown']; 
					$bs5=$rows2['initialName']; 
					$bs6=$rows2['denotedName']; 
					$bs7=$rows2['perAddress']; 
					$bs8=$rows2['email']; 
					$bs9=$rows2['gender'];
					$bs10=$rows2['nic']; 
					$bs11=$rows2['workDistrict'];
					$bs12=$rows2['eduZone']; 
					$bs13=$rows2['school']; 
					$bs14=$rows2['ResiDistrict']; 
					$bs15=$rows2['officeAddress']; 
					$bs16=$rows2['officephone']; 
					$bs17=$rows2['homephone']; 
					$bs18=$rows2['mobilephone']; 
					$bs19=$rows2['dob'];
					$bs20=$rows2['ageAsClose'];
				}
			}
			
			?>
			
			
			<!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">01(a).Subject No & Subject:</label>
                  <select class='form-control' name="subject" id="subject" readonly>
					
				   <?php
					  
					  if($statusofupd==1){
						$select6 = "SELECT * FROM subjects WHERE subject_id='$bs1'";
						$result6 = $conn->query($select6);	
						while($row6=$result6->fetch_assoc()) {
							$sel6 = $sel6."<option value='" .$row6['subject_id']."'>" . $row6['subject_id'] ."-". $row6['subject_name'] . "</option>";
						}
						echo $sel6;
					  }
					  
				   ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Medium:</label>
                  
                  <select id="medium" name="medium" class="form-control" readonly>
                    <?php
					if($statusofupd==1){
						if($bs2==2){
							echo "<option value='2'>Sinhala</option>";
						}
						if($bs2==3){
							echo "<option value='3'>Tamil</option>";
						}
						if($bs2==4){
							echo "<option value='4'>English</option>";
						}
					}
					?>
                  </select>
                </div>
  
              </div>

              <div class="form-row" style="text-align:left;">
                <label>02.Area No and area you wish to do marking (Town closest either your place of work or perment residence. Please see the list of areas on last page.) </label>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(a).First Choice:</label>
                  <select id="firstTown" name="firstTown" class="form-control" readonly>
                   
					<?php
					  if($statusofupd==1){
						$select8 = "SELECT * FROM town WHERE town_id='$bs3'";
						$result8 = $conn->query($select8);	
						while($row8=$result8->fetch_assoc()) {
							$sel8 = $sel8."<option value='" .$row8['town_id']."'>" . $row8['town_id'] ."-". $row8['town_name'] . "</option>";
						}
						echo $sel8;
						
					  }
				   ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b)Second Choice:</label>
                  <select id="secondTown" name="secondTown" class="form-control" readonly>
                    
                    <?php
					  if($statusofupd==1){
						$select9 = "SELECT * FROM town WHERE town_id='$bs4'";
						$result9 = $conn->query($select9);	
						while($row9=$result9->fetch_assoc()) {
							$sel9 = $sel9."<option value='" .$row9['town_id']."'>" . $row9['town_id'] ."-". $row9['town_name'] . "</option>";
						}
						echo $sel9;
						
					  }
				   ?>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip01">03(a).Name with initials:</label>
                  <input type="text" class="form-control" name="initialName" id="initialName"placeholder="Name with initials" readonly value="<?php if($statusofupd==1){ echo $bs5;} ?>">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(b).Name denoted by initials</label>
                  <input type="text" class="form-control" name="denotedName" id="denotedName" placeholder="Name denoted by initials"  readonly value="<?php if($statusofupd==1){ echo $bs6;} ?>">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="address">(c).Permenent Address</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="perAddress" id="perAddress" placeholder="Address" readonly value="<?php if($statusofupd==1){ echo $bs7;} ?>">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip03">(d).Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" readonly value="<?php if($statusofupd==1){ echo $bs8;} ?>">
                  <label id="emailerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip04">(e).Gender</label>
                  <select id="gender" name="gender" class="form-control" readonly>
					  <?php
						if($statusofupd==1){
							if($bs9==0){
								echo "<option value='0'>Male</option>";
								
							}
							if($bs9==1){
								echo "<option value='1'>Female</option>";
								
							}
						}
					  ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(f).NIC Number</label>
                  <input type="text" class="form-control" name="nic" id="nic" placeholder="NIC Number" readonly value="<?php if($statusofupd==1){ echo $bs10;} ?>">
                  <label id="nicerror"></label>
                </div>
              </div>

              <div class="form-row">
                <label>04.Present working </label>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(a).District:</label>
                  <select id="district" name="district" class="form-control" readonly>
					<?php
					  
					  if($statusofupd==1){
						$select12 = "SELECT * FROM district WHERE district_id='$bs11'";
						$result12 = $conn->query($select12);	
						while($row12=$result12->fetch_assoc()) {
							$sel12 = $sel12."<option value='" .$row12['district_id']."'>" . $row12['district_name'] ."</option>";
						}
						echo $sel12;
					  }
					 
				   ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip05">(b).Education Zone:</label>
                  <select id="zone" name="zone" class="form-control" readonly>
                    <?php
					if($statusofupd==1){
						$select13 = "SELECT * FROM zonal WHERE zonal_id='$bs12'";
						$result13 = $conn->query($select13);	
						while($row13=$result13->fetch_assoc()) {
							$sel13 = $sel13."<option value='" .$row13['zonal_id']."'>" . $row13['zonal_name'] ."</option>";
						}
						echo $sel13;
					}
					
					?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(c).School:</label>
                  <select id="school" name="school" class="form-control" readonly>
                    
                    <?php
					if($statusofupd==1){
						$select14 = "SELECT * FROM school WHERE sc_id='$bs13'";
						$result14 = $conn->query($select14);	
						while($row14=$result14->fetch_assoc()) {
							$sel14 = $sel14."<option value='" .$row14['sc_id']."'>" . $row14['schoolname'] ."</option>";
						}
						echo $sel14;
					}
					?>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(d).Official Address:</label>
                  <input type="text" class="form-control" name="officeAddress" id="officeAddress" placeholder="Official-address"  readonly value="<?php if($statusofupd==1){ echo $bs15;} ?>">
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(e).Residential District:</label>  
                  <select id="ResiDistrict" name="ResiDistrict" class="form-control" readonly>
                    <?php
					 
					  if($statusofupd==1){
						$select16 = "SELECT * FROM district WHERE district_id='$bs14'";
						$result16 = $conn->query($select16);	
						while($row16=$result16->fetch_assoc()) {
							$sel16 = $sel16."<option value='" .$row16['district_id']."'>" . $row16['district_name'] ."</option>";
						}
						echo $sel16;
					  }
					  
				   ?>
                  </select>            
                </div>
              </div>

              <div class="form-row" style="text-align:left;" >
                <label >(f).Telephone:</label>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Office Telephone No</label>
                  <input type="text" class="form-control" name="officephone" id="officephone" placeholder="Office"  readonly value="<?php if($statusofupd==1){ echo $bs16;} ?>">
                  <label id="officephoneerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Home Telephone No    </label>
                  <input type="text" class="form-control" name="homephone" id="homephone" placeholder="Home"  readonly value="<?php if($statusofupd==1){ echo $bs17;} ?>">
                  <label id="homephoneerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Mobile No </label>
                  <input type="text" class="form-control" name="mobilephone" id="mobilephone" placeholder="Mobile"  readonly value="<?php if($statusofupd==1){ echo $bs18;} ?>">
                  <label id="mobilephoneerror"></label>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">05(a).Date of Birth:</label>   
                  <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth"  readonly value="<?php if($statusofupd==1){ echo $bs19;} ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Age as at closing date</label>
                  <input type="text" class="form-control" name="ageAsClose" id="ageAsClose" placeholder="Age"  readonly value="<?php if($statusofupd==1){ echo $bs20;} ?>">
                  <label id="ageAsCloseerror"></label>
                </div>
              </div>  
              <!-- <button type="button" class="action-button previous_button">Back</button> -->
              <a href="viewapp2.php"><button type="button" class="btn btn-success">Continue</button></a>  
            </fieldset>
			<!-- .................................................................................................................................-->
			
          </form>  
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

