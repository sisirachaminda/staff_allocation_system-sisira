<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
if(isset($_POST['btn_apppart4'])){
	$sit_exam = $_POST['sit_exam'];
	$sit_dist = $_POST['sit_dist'];
	$sit_sub1 = $_POST['sit_sub1'];
	$sit_sub2 = $_POST['sit_sub2'];
	$sit_sub3 = $_POST['sit_sub3'];
	$dis_action = $_POST['dis_action'];
	$dib_action = $_POST['dib_action'];
	$pvdDetails = $_POST['pvdDetails'];
	$agree = '1';
	
	$select1 = "SELECT * FROM declaration WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
	$result1 = $conn->query($select1);
	if ($result1->num_rows == 0) {
	
		if ($stmt = $conn->prepare("INSERT INTO declaration (examiner_id,
															  sit_exam, 
															  sit_dist, 
															  sit_sub1,
															  sit_sub2,
															  sit_sub3,
															  dis_action,
															  dib_action,
															  pvdDetails,
															  agree,
															  year1) 
															  VALUES (
															  '$ses_ukey',
															  '$sit_exam',
															  '$sit_dist',
															  '$sit_sub1',
															  '$sit_sub2',
															  '$sit_sub3',
															  '$dis_action',
															  '$dib_action',
															  '$pvdDetails',
															  '$agree',
															  '$cdyear')")) {
			$stmt->execute();
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET appStatus='Complete'
									WHERE examiner_id='$ses_ukey' AND
										  year1='$cdyear'")) {
				$stmt1->execute();
			
			}
			
			echo "<script>
				alert('Successfully Form Submitted!')
				window.location.href = 'home.php';
			</script>";
		} else {
			
			echo "<script>
				alert('Could not prepare statement!')
				window.location.href = 'registration4.php';
			</script>";
		}
	}
	else{
		if($sit_exam==1){
			$sdf1="UPDATE declaration SET sit_exam='$sit_exam', 
														   sit_dist='$sit_dist', 
														   sit_sub1='$sit_sub1',
														   sit_sub2='$sit_sub2',
														   sit_sub3='$sit_sub3',
														   dis_action='$dis_action',
														   dib_action='$dib_action',
														   pvdDetails='$pvdDetails',
														   agree='$agree'
														WHERE examiner_id='$ses_ukey' AND
															  year1='$cdyear'";
		}
		else{
			$sdf1="UPDATE declaration SET sit_exam='$sit_exam', 
										  sit_dist=Null, 
										  sit_sub1=Null,
										  sit_sub2=Null,
									      sit_sub3=Null,
									      dis_action='$dis_action',
									      dib_action='$dib_action',
									      pvdDetails='$pvdDetails',
									      agree='$agree'
									WHERE examiner_id='$ses_ukey' AND
										  year1='$cdyear'";
		}
		
		if ($stmt = $conn->prepare($sdf1)) {
			$stmt->execute();
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET appStatus='Complete'
									WHERE examiner_id='$ses_ukey' AND
										  year1='$cdyear'")) {
				$stmt1->execute();
			
			}
			echo "<script>
				alert('Successfully Form Edit!')
				window.location.href = 'home.php';
			</script>";
		} else {
			
			echo "<script>
				alert('Could not prepare statement!')
				window.location.href = 'registration4.php';
			</script>";
		}
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
	<?php
			$statusofupd=0;
			
			$select2 = "SELECT * FROM declaration WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
			$result2 = $conn->query($select2);
			if ($result2->num_rows > 0) {
				$statusofupd=1;
				
				while($rows2 = $result2->fetch_assoc()) {
						$bs1=$rows2['sit_exam'];
						$bs2=$rows2['sit_dist'];
						$bs3=$rows2['sit_sub1'];
						$bs4=$rows2['sit_sub2'];
						$bs5=$rows2['sit_sub3'];
						$bs6=$rows2['dis_action'];
						$bs7=$rows2['dib_action'];
						$bs8=$rows2['pvdDetails'];
						$bs9=$rows2['agree'];
				}
			}
			
	?>
	<script>
      $(document).ready(function(){
        $("#show").hide();
        $("#sit_exam").change(function(){
          var sit_exam = $("#sit_exam").val();

          if(sit_exam == "1") {
            $("#show").show();
          } else {
            $("#show").hide();
          }
        });

        <?php
		if($statusofupd==1){
		?>
			<?php
			if($bs1==1){
			?>
				$("#show").show();
			<?php
			}
			if($bs1==0){
			?>
				$("#show").hide();
			<?php
			}
			?>
		<?php
		}
		?>
      });
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
          <form method ="post" id="msform" enctype="multipart/form-data"> 
            <!-- Tittle -->
            <div class="tittle">
              <h1>Marking Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Basic Details</li>  
              <li class="active">Service Details</li> 
              <li class="active">Academic and pfofessional qualifications</li>
              <li class="active">Declaration</li>
            </ul>
			
			
			
            <!-- fieldsets -->
            <fieldset>
              <h3>Declaration</h3>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>13.Is a family member or a resident of your house expected to sit the above examination this year?</label> 
                  <select id="sit_exam" name="sit_exam" class="form-control" id="sit_exam">
                    <?php
					if($statusofupd==1){
						if($bs1==1){
					?>
						<option value="1" selected>Yes</option>
						<option value="0" >No</option>
					<?php
						}
						if($bs1==0){
					?>
							<option value="1" >Yes</option>
							<option value="0" selected>No</option>
					<?php
						}
					}
					else{
					?>
						<option value="1">yes</option>
						<option value="0" selected>No</option>
					<?php
					}
					?>
                  </select> 
                </div>   
              </div>
              <div id="show">
                
				<div class="form-row">
                  <h6> Provide following details:</h6>
                  <div class="col-md-12 mb-3" style="text-align:left;">
                    <label>(a).Ditrict</label>
                    <select class='form-control' name="sit_dist" id="sit_dist"> 
					  <?php
					  $sel16="";
					  $select16 = "SELECT * FROM district";
					  $result16 = $conn->query($select16);	
					  while($row16=$result16->fetch_assoc()) {
                        $sel16 = $sel16."<option value='" .$row16['district_id']."'>" . $row16['district_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						if($bs2!=null){
							$select17 = "SELECT * FROM district WHERE district_id='$bs2'";
							$result17 = $conn->query($select17);	
							while($row17=$result17->fetch_assoc()) {
								$sel17 = $sel17."<option value='" .$row17['district_id']."'>" . $row17['district_name'] ."</option>";
							}
							echo $sel17;
							echo $sel16;
						}
						else{
							echo "<option value='' disabled selected hidden>Select District.............</option>";
							echo $sel16;
							
						}
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select District.............</option>";
						echo $sel16;
					  }
					  ?>
                    </select>
                  </div>  
                </div>
                <div class="form-row">
                  <div class="col-md-12 mb-3" style="text-align:left;">
                    <label>(b).Subjects:</label>
                  </div>  
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub1" id="sit_sub1">
					  <?php
					  $sel18="";
					  $select18 = "SELECT * FROM subjects";
					  $result18 = $conn->query($select18);	
					  while($row18=$result18->fetch_assoc()) {
                        $sel18 = $sel18."<option value='" .$row18['subject_id']."'>" . $row18['subject_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						if($bs3!=null){
							$select19 = "SELECT * FROM subjects WHERE subject_id='$bs3'";
							$result19 = $conn->query($select19);	
							while($row19=$result19->fetch_assoc()) {
								$sel19 = $sel19."<option value='" .$row19['subject_id']."'>" . $row19['subject_name'] ."</option>";
							}
							echo $sel19;
							echo $sel18;
						}
						else{
							echo "<option value='' disabled selected hidden>Select First Subject.............</option>";
							echo $sel18;
						}
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select First Subject.............</option>";
						echo $sel18;
					  }
					  ?>
                    </select>
                  </div>   
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub2" id="sit_sub2">
                      <?php
					  $sel20="";
					  $select20 = "SELECT * FROM subjects";
					  $result20 = $conn->query($select20);	
					  while($row20=$result20->fetch_assoc()) {
                        $sel20 = $sel20."<option value='" .$row20['subject_id']."'>" . $row20['subject_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						
						if($bs4!=null){
							$select21 = "SELECT * FROM subjects WHERE subject_id='$bs4'";
							$result21 = $conn->query($select21);	
							while($row21=$result21->fetch_assoc()) {
								$sel21 = $sel21."<option value='" .$row21['subject_id']."'>" . $row21['subject_name'] ."</option>";
							}
							echo $sel21;
							echo $sel20;
						}
						else{
							echo "<option value='' disabled selected hidden>Select Second Subject............</option>";
							echo $sel20;
						}
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select Second Subject............</option>";
						echo $sel20;
					  }
					  ?>
                    </select>  
                  </div>   
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub3" id="sit_sub3">
                      <?php
					  $sel22="";
					  $select22 = "SELECT * FROM subjects";
					  $result22 = $conn->query($select22);	
					  while($row22=$result22->fetch_assoc()) {
                        $sel22 = $sel22."<option value='" .$row22['subject_id']."'>" . $row22['subject_name'] ."</option>";
                      }
					  
					  if($statusofupd==1){
						if($bs5!=null){
							$select23 = "SELECT * FROM subjects WHERE subject_id='$bs5'";
							$result23 = $conn->query($select23);	
							while($row23=$result23->fetch_assoc()) {
								$sel23 = $sel23."<option value='" .$row23['subject_id']."'>" . $row23['subject_name'] ."</option>";
							}
							echo $sel23;
							echo $sel22;
						}
						else{
							echo "<option value='' disabled selected hidden>Select Third Subject............</option>";
							echo $sel22;
						}
					  }
					  else{
						echo "<option value='' disabled selected hidden>Select Third Subject............</option>";
						echo $sel22;
					  }
					  ?>
                    </select>
                  </div>   
                </div>
				
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>14(i). Is any disciplinary inquiry against you in progress:</label> 
                  <select id="dis_action" name="dis_action" class="form-control" >
                   
					<?php
					if($statusofupd==1){
						if($bs6==1){
					?>
							<option value="1">Yes</option>
							<option value="0" >No</option>
					<?php
						}
						if($bs6==0){
					?>
							<option value="0">No</option>
							<option value="1" >Yes</option>
					<?php
						}
					}
					else{
					?>
						<option value="0" >No</option>
						<option value="1">Yes</option>
						
					<?php
					}
					?>
                  </select>   
                </div>  
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>(ii). Are you debarred from examination duties:</label> 
                  <select id="dib_action" name="dib_action" class="form-control" >
					
					<?php
					if($statusofupd==1){
						if($bs7==1){
					?>
							<option value="1">Yes</option>
							<option value="0" >No</option>
					<?php
						}
						if($bs7==0){
					?>
							<option value="0">No</option>
							<option value="1" >Yes</option>
					<?php
						}
					}
					else{
					?>
						<option value="0" >No</option>
						<option value="1">Yes</option>
						
					<?php
					}
					?>
                    
                  </select>    
                </div>  
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>(iii)If yes, Provide details:</label> 
                  <input type="text" class="form-control" name="pvdDetails"   value="<?php if($statusofupd==1){ echo $bs8;} ?>">
                </div>   
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>15.Declaration of the Applicant:</label> 
                </div>   
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <div class="form-check">    
                    <p>
                      <input class="form-check-input" type="checkbox" name="agree" value="1" required id="flexCheckIndeterminate" style="border-color:black;" <?php if($statusofupd==1){ if($bs9==1){?> checked <?php } } ?>>
                      I hereby declare that the information given above is true and accurate and  that I am not debarred from marking at present and I am aware that I will be subjected to disciplinary actions if found to have submitted false information and mislead the department.
                    </p> 
                  </div>
                </div>
              </div>
              <a href="registration3.php"><button type="button" class="btn btn-danger">Back</button></a>
              <button type="submit" name="btn_apppart4" class="btn btn-success">Submit</button>  
              <!-- <a href="#" class="action-button">Finish</a>  -->
            </fieldset>  
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

