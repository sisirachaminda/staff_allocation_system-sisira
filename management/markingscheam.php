<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
if(isset($_POST['btn_markingscheam'])){
	
	$nr1=$_POST['degreefirstclassmark'];
	$nr2=$_POST['degreesecondclassmark'];
	$nr3=$_POST['degreefirstgrademark'];
	$nr4=$_POST['degreesecondgrademark'];
	
	$nr5=$_POST['diplomafollowedmark'];
	$nr6=$_POST['highedudipmark'];
	$nr7=$_POST['teachertrainingmark'];
	$nr8=$_POST['postgraduatedeegreemark'];
	$nr9=$_POST['activitymark'];
	
	
	$nr11=$_POST['servicegraduateyearmark'];
	
	
	$nr13=$_POST['noofperiodbelowbenchmark1'];
	$nr15=$_POST['noofperiodbelowbenchmark2'];
	$nr17=$_POST['noofperiodbelowbenchmark3'];
	
	
	$nr19=$_POST['stupassedbelowbenchmark1'];
	$nr21=$_POST['stupassedbelowbenchmark2'];
	$nr23=$_POST['stupassedbelowbenchmark3'];
	
	
	$select = "SELECT * FROM markingscheam WHERE year1='$cdyear'";
	$result = $conn->query($select);	
	if ($result->num_rows == 0) {

		if ($stmt = $conn->prepare("INSERT INTO markingscheam (year1,
													    degree_1stclass, 
														degree_2ndclass, 
														degree_1stgrade,
														degree_2ndgrade,
														diploma_followed,
														higheredudip,
														teacher_training,
														postgraduate_degree,
														spactivity,
														servicegraduate_benchmark_overmark,
														period_count1_mark,
														period_count2_mark,
														period_count3_mark,
														passpresenatage_mark1,
														passpresenatage_mark2,
														passpresenatage_mark3,
														user) 
												VALUES ('$cdyear',
														'$nr1',
														'$nr2',
														'$nr3',
														'$nr4',
														'$nr5',
														'$nr6',
														'$nr7',
														'$nr8',
														'$nr9',
														'$nr11',
														'$nr13',
														'$nr15',
														'$nr17',
														'$nr19',
														'$nr21',
														'$nr23',
														'$ses_ukey')")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'home.php';
			</script>";
		}
		else{
			echo "<script>
				alert('Error!')
				window.location.href = 'home.php';
			</script>";
		}
		
	}
	else{
		if ($stmt = $conn->prepare("UPDATE markingscheam SET
													    degree_1stclass='$nr1', 
														degree_2ndclass='$nr2', 
														degree_1stgrade='$nr3',
														degree_2ndgrade='$nr4',
														diploma_followed='$nr5',
														higheredudip='$nr6',
														teacher_training='$nr7',
														postgraduate_degree='$nr8',
														spactivity='$nr9',
														servicegraduate_benchmark_overmark='$nr11',
														period_count1_mark='$nr13',
														period_count2_mark='$nr15',
														period_count3_mark='$nr17',
														passpresenatage_mark1='$nr19',
														passpresenatage_mark2='$nr21',
														passpresenatage_mark3='$nr23',
														user='$ses_ukey'
														WHERE year1='$cdyear'")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'home.php';
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
    <title>Marking Scheam</title>

    
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
	  
	  label{
		 font-weight:bold;
		 
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
              <h1>Marking Scheam </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
           
			<?php
			$statusofupd=0;
			$select2 = "SELECT * FROM markingscheam WHERE year1='$cdyear'";
			$result2 = $conn->query($select2);
			if ($result2->num_rows > 0) {
				$statusofupd=1;
				
				while($rows2 = $result2->fetch_assoc()) {
					
					$bs1=$rows2['degree_1stclass']; 
					$bs2=$rows2['degree_2ndclass']; 
					$bs3=$rows2['degree_1stgrade']; 
					$bs4=$rows2['degree_2ndgrade']; 
					$bs5=$rows2['diploma_followed']; 
					$bs6=$rows2['higheredudip']; 
					$bs7=$rows2['teacher_training']; 
					$bs8=$rows2['postgraduate_degree']; 
					$bs9=$rows2['spactivity']; 
					
					$bs11=$rows2['servicegraduate_benchmark_overmark']; 
					
					$bs13=$rows2['period_count1_mark']; 
					$bs15=$rows2['period_count2_mark']; 
					$bs17=$rows2['period_count3_mark']; 
					
					$bs19=$rows2['passpresenatage_mark1']; 
					$bs21=$rows2['passpresenatage_mark2']; 
					$bs23=$rows2['passpresenatage_mark3'];
				}
			}
			
			?>
			
			<!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label style="text-align:left;">Special Degree Mark</label>
                  <input type="text" class="form-control" name="degreefirstclassmark" placeholder="Degree 1st Class Mark" required value="<?php if($statusofupd==1){ echo $bs1;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label style="text-align:left;">General Degree Mark</label>
                  <input type="text" class="form-control" name="degreesecondclassmark" placeholder="Degree 2nd Class Mark" required value="<?php if($statusofupd==1){ echo $bs2;} ?>">
                </div>
				
              </div>
			 
			  <div class="form-row">
                
				<div class="col-md-6 mb-3">
                  <label align="left">Degree 1st Class Mark</label>
                  <input type="text" class="form-control" name="degreefirstgrademark" placeholder="Degree 1st Grade Mark" required value="<?php if($statusofupd==1){ echo $bs3;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label align="left">Degree 2nd Class Mark</label>
                  <input type="text" class="form-control" name="degreesecondgrademark" placeholder="Degree 2nd Grade Mark" required value="<?php if($statusofupd==1){ echo $bs4 ;} ?>">
                </div>
				
              </div>
			  
			  <br>
			  
              <div class="form-row">
				<div class="col-md-12 mb-3">
                  <label>Diploma Follwed Mark</label>
                  <input type="text" class="form-control" name="diplomafollowedmark" placeholder="Diploma Follwed Mark" required value="<?php if($statusofupd==1){ echo $bs5;} ?>">
                </div>
              </div>
			  
			  <br>
			  
			  <div class="form-row">
                
				<div class="col-md-6 mb-3">
                  <label align="left">Higher Edu. Diploma Marks</label>
                  <input type="text" class="form-control" name="highedudipmark" placeholder="Higher Edu. Diploma Marks" required value="<?php if($statusofupd==1){ echo $bs6;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label align="left">Teachers Training Marks</label>
                  <input type="text" class="form-control" name="teachertrainingmark" placeholder="Teachers Training Marks" required value="<?php if($statusofupd==1){ echo $bs7;} ?>">
                </div>
				
              </div>
			  
			   <br>
			  
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">Postgraduate Degree Marks</label>
                  <input type="text" class="form-control" name="postgraduatedeegreemark" placeholder="Postgraduate Degree Marks" required value="<?php if($statusofupd==1){ echo $bs8;} ?>">
                </div>
				
              </div>
			  
			  <br>
			  
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">Activity Marks</label>
                  <input type="text" class="form-control" name="activitymark" placeholder="Activity Marks" required value="<?php if($statusofupd==1){ echo $bs9;} ?>">
                </div>
				
              </div>
			  
			  <br>
			  
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">Period of service as a graduate/higher deploma teacher (25 OR ABOVE 25)</label>
                  <input type="number" class="form-control" name="servicegraduateyearmark" min="25" placeholder="Period of service as a graduate/higher deploma teacher(years) - Marks" required value="<?php if($statusofupd==1){ echo $bs11;} ?>">
				  <div style="color:red;font-weight:bold;"> (if the period of service below 25 years, 1 Mark for one year)</div>
                </div>
				
              </div>
			  <br>
			  
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">No of Periods (BETWEEN 1-10)</label>
                  <input type="text" class="form-control" name="noofperiodbelowbenchmark1" placeholder="No of Periods - (BETWEEN 0-10) Marks" required value="<?php if($statusofupd==1){ echo $bs13;} ?>">
                </div>
				
              </div>
			  <br>
			  
			  <div class="form-row">
               
				<div class="col-md-12 mb-3">
                  <label align="left">No of Periods (BETWEEN 11-20)</label>
                  <input type="text" class="form-control" name="noofperiodbelowbenchmark2" placeholder="No of Periods -  (BETWEEN 11-20) Marks" required value="<?php if($statusofupd==1){ echo $bs15;} ?>">
                </div>
				
              </div>
			  <br>
			  
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">No of Periods (ABOVE 20)</label>
                  <input type="text" class="form-control" name="noofperiodbelowbenchmark3" placeholder="No of Periods - (ABOVE 20) Marks" required value="<?php if($statusofupd==1){ echo $bs17;} ?>">
                </div>
				
              </div>
			  <br>
			  <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label align="left">Studends Passed Presentage -  (BETWEEN 1-25)</label>
                  <input type="text" class="form-control" name="stupassedbelowbenchmark1" placeholder="Studends Passed Presentage - (BETWEEN 1-25) Marks" required value="<?php if($statusofupd==1){ echo $bs19;} ?>">
                </div>
				
              </div>
			  <br>
			  
			  <div class="form-row">
               
				<div class="col-md-12 mb-3">
                  <label align="left">Studends Passed Presentage - (BETWEEN 26-50)</label>
                  <input type="text" class="form-control" name="stupassedbelowbenchmark2" placeholder="Studends Passed Presentage - (BETWEEN 26-50) Marks" required value="<?php if($statusofupd==1){ echo $bs21;} ?>">
                </div>
				
              </div>
			  <br>
			  
			  <div class="form-row">
               
				<div class="col-md-12 mb-3">
                  <label align="left">Studends Passed Presentage - (ABOVE 51)</label>
                  <input type="text" class="form-control" name="stupassedbelowbenchmark3" placeholder="Studends Passed Presentage - (ABOVE 51) Marks" required value="<?php if($statusofupd==1){ echo $bs23;} ?>">
                </div>
				
              </div>
              <button type="submit" class="btn btn-success" name="btn_markingscheam">Confirm</button>  
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

