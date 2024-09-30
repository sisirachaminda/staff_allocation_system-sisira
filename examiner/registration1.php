<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");

$selectDuration = "SELECT sdate, edate FROM info WHERE name = 'appCall'";
$resultDuration = $conn->query($selectDuration);	
while($rows = $resultDuration->fetch_assoc()){
        $sdate = $rows['sdate'];  
        $edate = $rows['edate'];   
}

?>

<?php
if(isset($_POST['btn_apppart1'])){
	
	$subject = $_POST['subject'];
	$medium = $_POST['medium'];
	$firstTown = $_POST['firstTown'];
	$secondTown = $_POST['secondTown'];
	$initialName = $_POST['initialName'];
	$denotedName = $_POST['denotedName'];
	$perAddress = $_POST['perAddress'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$workDistrict = $_POST['district'];
	$eduZone = $_POST['zone'];
	$school =  $_POST['school'];
	$ResiDistrict = $_POST['ResiDistrict'];
	$officeAddress = $_POST['officeAddress'];
	$officephone = $_POST['officephone'];
	$homephone = $_POST['homephone'];
	$mobilephone = $_POST['mobilephone'];
	$dob = $_POST['dob'];
	//$ageAsClose = $_POST['ageAsClose'];
	
	$d1 = new DateTime($dob);
	$d2 = new DateTime($edate);

	$diff = $d2->diff($d1);

	$ageAsClose=$diff->y;
	
	
	if($firstTown!=$secondTown){
		$select1 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
		$result1 = $conn->query($select1);
		if ($result1->num_rows == 0) {
		
			if ($stmt = $conn->prepare("INSERT INTO basicdetails (examiner_id,
																  subject, 
																  medium, 
																  firstTown, 
																  secondTown, 
																  initialName, 
																  denotedName, 
																  perAddress, 
																  email, 
																  gender, 
																  nic, 
																  workDistrict, 
																  eduZone, 
																  school, 
																  ResiDistrict, 
																  officeAddress, 
																  officephone, 
																  homephone, 
																  mobilephone, 
																  dob, 
																  ageAsClose, 
																  appStatus, 
																  enterDate, 
																  updateDate, 
																  year1) 
																  VALUES (
																  '$ses_ukey',
																  '$subject',
																  '$medium',
																  '$firstTown',
																  '$secondTown',
																  '$initialName',
																  '$denotedName',
																  '$perAddress',
																  '$email',
																  '$gender',
																  '$ses_user',
																  '$workDistrict',
																  '$eduZone',
																  '$school',
																  '$ResiDistrict',
																  '$officeAddress',
																  '$officephone',
																  '$homephone',
																  '$mobilephone',
																  '$dob',
																  '$ageAsClose',
																  'Incompelte',
																  '$cddate',
																  '$cddate',
																  '$cdyear'
																  )")) {
				$stmt->execute();
				echo "<script>
					alert('Successfully Saved!')
					window.location.href = 'registration2.php';
				</script>";
			} else {
				
				echo "<script>
					alert('Could not prepare statement!')
					window.location.href = 'registration1.php';
				</script>";
			}
		}
		else{
			if ($stmt = $conn->prepare("UPDATE basicdetails SET  subject='$subject', 
																  medium='$medium', 
																  firstTown='$firstTown', 
																  secondTown='$secondTown', 
																  initialName='$initialName', 
																  denotedName='$denotedName', 
																  perAddress='$perAddress', 
																  email='$email', 
																  gender='$gender',  
																  nic='$ses_user',  
																  workDistrict='$workDistrict', 
																  eduZone='$eduZone', 
																  school='$school', 
																  ResiDistrict='$ResiDistrict', 
																  officeAddress='$officeAddress',  
																  officephone='$officephone',   
																  homephone='$homephone',  
																  mobilephone='$mobilephone',   
																  dob='$dob',    
																  ageAsClose='$ageAsClose', 
																  updateDate='$cddate'
																  WHERE examiner_id='$ses_ukey' AND
																  year1='$cdyear'")) {
				$stmt->execute();
				echo "<script>
					alert('Successfully Saved!')
					window.location.href = 'registration2.php';
				</script>";
			} else {
				
				echo "<script>
					alert('Could not prepare statement!')
					window.location.href = 'registration1.php';
				</script>";
			}
		}
	}
	else{
		echo "<script>
					alert('Sorry ! You are Same Choices Town')
					window.location.href = 'registration1.php';
			</script>";
	}
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

    <script>
      $(document).ready(function(){
        // Zone
        $("#district").change(function () {
            var district = $("#district").val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: 'district=' + district,
                success: function (data) {
                    $("#zone").html(data);
                }
            });
        });

        //School
        $("#zone").change(function () {
            var zone = $("#zone").val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: 'zone=' + zone,
                success: function (data) {
                    $("#school").html(data);
                }
            });
        });
		
		
		$("#medium").change(function () {
            var medium = $("#medium").val();
            var subjectr = $("#subjectr").val();
			
			var sd=medium+"_"+subjectr;
			
            $.ajax({
                url: 'data_town.php',
                method: 'POST',
                data: 'submedium=' + sd,
                success: function (data) {
                    $("#firstTown").html(data);
					$("#secondTown").html(data);
                }
            });
        });
      });
    </script>
	<script>
	function closePopup() {
        // Close the popup when the close button is clicked
        $('#myModal2').modal('hide');
        
    }
	function closePopup1() {
        // Close the popup when the close button is clicked
         $('#myModal1').modal('hide');
        
    }
    </script>
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
                  <select class='form-control' name="subject" id="subjectr">
					
				   <?php
					  $sel1="";
					  $select1 = "SELECT * FROM subjects";
					  $result1 = $conn->query($select1);	
					  while($row1=$result1->fetch_assoc()) {
						$sel1 = $sel1."<option value='" .$row1['subject_id']."'>" . $row1['subject_id'] ."-". $row1['subject_name'] . "</option>";
					  }
					  
					  if($statusofupd==1){
						$select6 = "SELECT * FROM subjects WHERE subject_id='$bs1'";
						$result6 = $conn->query($select6);	
						while($row6=$result6->fetch_assoc()) {
							$sel6 = $sel6."<option value='" .$row6['subject_id']."'>" . $row6['subject_id'] ."-". $row6['subject_name'] . "</option>";
						}
						echo $sel6;
						echo $sel1;
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select Subject.............</option>";
						echo $sel1;
					  }
				   ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Medium:</label>
                  
                  <select id="medium" name="medium" class="form-control" >
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
					?>
						<option value="2">Sinhala</option>
						<option value="3">Tamil</option>
						<option value="4">English</option>
					<?php
					}
					else{
					?>
						<option value="" disabled selected hidden>Select Medium.............</option>";
						<option value="2">Sinhala</option>
						<option value="3">Tamil</option>
						<option value="4">English</option>
					<?php
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
                  <select id="firstTown" name="firstTown" required class="form-control" >
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
                  <select id="secondTown" name="secondTown" class="form-control" >
                    
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
                  <input type="text" class="form-control" name="initialName" id="initialName"placeholder="Name with initials" required value="<?php if($statusofupd==1){ echo $bs5;} ?>">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(b).Name denoted by initials</label>
                  <input type="text" class="form-control" name="denotedName" id="denotedName" placeholder="Name denoted by initials"  required value="<?php if($statusofupd==1){ echo $bs6;} ?>">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="address">(c).Permenent Address</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="perAddress" id="perAddress" placeholder="Address" required value="<?php if($statusofupd==1){ echo $bs7;} ?>">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip03">(d).Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required value="<?php if($statusofupd==1){ echo $bs8;} ?>">
                  <label id="emailerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip04">(e).Gender</label>
                  <select id="gender" name="gender" class="form-control" >
					  <?php
						if($statusofupd==1){
							if($bs9==0){
								echo "<option value='0'>Male</option>";
								echo "<option value='1'>Female</option>";
							}
							if($bs9==1){
								echo "<option value='1'>Female</option>";
								echo "<option value='0'>Male</option>";
							}
						}
						else{
					  ?>
						  <option value="" disabled selected hidden>Select Gender.............</option>";
						  <option value="0">Male</option>
						  <option value="1">Female</option>
					  <?php
						}
					  ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(f).NIC Number</label>
                  <input type="text" class="form-control" name="nic" id="nic" placeholder="NIC Number" required value="<?php echo $ses_user; ?>" readonly>
                  <label id="nicerror"></label>
                </div>
              </div>

              <div class="form-row">
                <label>04.Present working </label>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(a).District:</label>
                  <select id="district" name="district" class="form-control" >
					<?php
					  $sel11="";
					  $select11 = "SELECT * FROM district";
					  $result11 = $conn->query($select11);	
					  while($row11=$result11->fetch_assoc()) {
                        $sel11 = $sel11."<option value='" .$row11['district_id']."'>" . $row11['district_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						$select12 = "SELECT * FROM district WHERE district_id='$bs11'";
						$result12 = $conn->query($select12);	
						while($row12=$result12->fetch_assoc()) {
							$sel12 = $sel12."<option value='" .$row12['district_id']."'>" . $row12['district_name'] ."</option>";
						}
						echo $sel12;
						echo $sel11;
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select District.............</option>";
						echo $sel11;
					  }
					  
				   ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip05">(b).Education Zone:</label>
                  <select id="zone" name="zone" class="form-control" >
                    <?php
					if($statusofupd==1){
						$select13 = "SELECT * FROM zonal WHERE zonal_id='$bs12'";
						$result13 = $conn->query($select13);	
						while($row13=$result13->fetch_assoc()) {
							$sel13 = $sel13."<option value='" .$row13['zonal_id']."'>" . $row13['zonal_name'] ."</option>";
						}
						echo $sel13;
					}
					else{
						echo "<option value='' disabled selected hidden>Select Education Zone.............</option>";
					}
					?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(c).School:</label>
                  <select id="school" name="school" class="form-control" >
                    
                    <?php
					if($statusofupd==1){
						$select14 = "SELECT * FROM school WHERE sc_id='$bs13'";
						$result14 = $conn->query($select14);	
						while($row14=$result14->fetch_assoc()) {
							$sel14 = $sel14."<option value='" .$row14['sc_id']."'>" . $row14['schoolname'] ."</option>";
						}
						echo $sel14;
					}
					else{
						echo "<option value='' disabled selected hidden>Select School.............</option>";
					}
					?>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(d).Official Address:</label>
                  <input type="text" class="form-control" name="officeAddress" id="officeAddress" placeholder="Official-address"  required value="<?php if($statusofupd==1){ echo $bs15;} ?>">
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(e).Residential District:</label>  
                  <select id="ResiDistrict" name="ResiDistrict" class="form-control" >
                    <?php
					  $sel15="";
					  $select15 = "SELECT * FROM district";
					  $result15 = $conn->query($select15);	
					  while($row15=$result15->fetch_assoc()) {
                        $sel15 = $sel15."<option value='" .$row15['district_id']."'>" . $row15['district_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						$select16 = "SELECT * FROM district WHERE district_id='$bs14'";
						$result16 = $conn->query($select16);	
						while($row16=$result16->fetch_assoc()) {
							$sel16 = $sel16."<option value='" .$row16['district_id']."'>" . $row16['district_name'] ."</option>";
						}
						echo $sel16;
						echo $sel15;
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select Residential District.............</option>";
						echo $sel15;
					  }
					  
				   ?>
                  </select>            
                </div>
              </div>

              <div class="form-row" style="text-align:left;" >
                <label >(f).Telephone:</label>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">Office Telephone No</label>
                  <input type="text" class="form-control" name="officephone" id="officephone" placeholder="Office" maxlength="10" minlength="10" required value="<?php if($statusofupd==1){ echo $bs16;} ?>">
                  <label id="officephoneerror"></label>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">Home Telephone No    </label>
                  <input type="text" class="form-control" name="homephone" id="homephone" placeholder="Home" maxlength="10" minlength="10"  required value="<?php if($statusofupd==1){ echo $bs17;} ?>">
                  <label id="homephoneerror"></label>
                </div>
                
              </div>

              <div class="form-row">
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip02">Mobile No </label>
                  <input type="text" class="form-control" name="mobilephone" id="mobilephone" placeholder="Mobile" maxlength="10" minlength="10"   required value="<?php if($statusofupd==1){ echo $bs18;} ?>">
                  <label id="mobilephoneerror"></label>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">05(a).Date of Birth:</label>   
                  <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth"  required value="<?php if($statusofupd==1){ echo $bs19;} ?>">
                </div>
                
              </div>  
              <!-- <button type="button" class="action-button previous_button">Back</button> -->
              <button type="submit" class="btn btn-success" name="btn_apppart1">Continue</button>  
            </fieldset>
			<!-- .................................................................................................................................-->
			
          </form>  
        </section> 
      <!-- END Multiform HTML -->
		
      </article>
		
		<div class="modal fade hide" id="myModal1">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Attention..!</h4>
						<button type="button" class="close" onclick="closePopup1()" data-dismiss="modal">&times;</button></a>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<p>You have registered in previous years. You will see previous years information. Verify that the information is correct and register for this year.</p>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button type="button" onclick="closePopup1()" class="btn btn-secondary" data-dismiss="modal">Edit your Details</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade hide" id="myModal2">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Attention..!</h4>
						<button type="button" class="close" onclick="closePopup()" data-dismiss="modal">&times;</button></a>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<p>You have already filled out your form. Make and confirm changes or additions.</p>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button type="button" onclick="closePopup()" class="btn btn-secondary" data-dismiss="modal">Edit your Details</button>
					</div>
				</div>
			</div>
		</div>
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
	  
      <script src='plugins/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='plugins/jquery.easing.min.js'></script>
      <script src='plugins/intlTelInput.js'></script>
      <script src='plugins/popper.min.js'></script>
      <script src='plugins/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>   
	 
	<script type="text/javascript">
			<?php
			$select20 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey'";
			$result20 = $conn->query($select20);
			if ($result20->num_rows > 0) {
			?>
				<?php
				$select21 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
				$result21 = $conn->query($select21);
				if ($result21->num_rows > 0) {
				?>
					$(window).on('load', function() {
						$('#myModal2').modal('show');
					});
				<?php
				}
				else{
				?>
					$(window).on('load', function() {
						$('#myModal1').modal('show');
					});
				<?php
				}
				?>
			<?php
			}
			?>
			
			
	</script>

    </main>
  </div>
</div>
</body>

</html>

