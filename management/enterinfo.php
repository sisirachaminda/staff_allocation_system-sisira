<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
if(isset($_POST['btn_period'])){
	
	$nr1=$_POST['appcallstart'];
	$nr2=$_POST['appcallend'];
	$nr3=$_POST['principleapprovestart'];
	$nr4=$_POST['principleapproveend'];
	$nr5=$_POST['evaluationstart'];
	$nr6=$_POST['evaluationend'];
	$nr7=$_POST['markingstart'];
	$nr8=$_POST['markingend'];
	$nr9=$_POST['totalprocessstart'];
	$nr10=$_POST['totalprocessend'];
	
	$select = "SELECT * FROM info WHERE year1='$cdyear' AND name='appCall'";
	$result = $conn->query($select);	
	if ($result->num_rows == 0) {
		
		if ($stmt = $conn->prepare("INSERT INTO info (year1,
													  name, 
													  sdate, 
													  edate) 
												VALUES ('$cdyear',
														'appCall',
														'$nr1',
														'$nr2')")) {
			$stmt->execute();
			
		}
		
	}
	else{
		if ($stmt = $conn->prepare("UPDATE info SET sdate='$nr1',edate='$nr2' WHERE year1='$cdyear' AND name='appCall'")) {
			$stmt->execute();
			
		}
	}
	
	
	$select1 = "SELECT * FROM info WHERE year1='$cdyear' AND name='principleapprove'";
	$result1 = $conn->query($select1);	
	if ($result1->num_rows == 0) {
		
		if ($stmt1 = $conn->prepare("INSERT INTO info (year1,
													  name, 
													  sdate, 
													  edate) 
												VALUES ('$cdyear',
														'principleapprove',
														'$nr3',
														'$nr4')")) {
			$stmt1->execute();
			
		}
		
	}
	else{
		if ($stmt1 = $conn->prepare("UPDATE info SET sdate='$nr3',edate='$nr4' WHERE year1='$cdyear' AND name='principleapprove'")) {
			$stmt1->execute();
			
		}
	}
	
	$select3 = "SELECT * FROM info WHERE year1='$cdyear' AND name='evaluationperiod'";
	$result3 = $conn->query($select3);	
	if ($result3->num_rows == 0) {
		
		if ($stmt2 = $conn->prepare("INSERT INTO info (year1,
													  name, 
													  sdate, 
													  edate) 
												VALUES ('$cdyear',
														'evaluationperiod',
														'$nr5',
														'$nr6')")) {
			$stmt2->execute();
			
		}
		
	}
	else{
		if ($stmt2 = $conn->prepare("UPDATE info SET sdate='$nr5',edate='$nr6' WHERE year1='$cdyear' AND name='evaluationperiod'")) {
			$stmt2->execute();
			
		}
	}
	
	
	$select4 = "SELECT * FROM info WHERE year1='$cdyear' AND name='markingperiod'";
	$result4 = $conn->query($select4);	
	if ($result4->num_rows == 0) {
		
		if ($stmt3 = $conn->prepare("INSERT INTO info (year1,
													  name, 
													  sdate, 
													  edate) 
												VALUES ('$cdyear',
														'markingperiod',
														'$nr7',
														'$nr8')")) {
			$stmt3->execute();
			
		}
		
	}
	else{
		if ($stmt3 = $conn->prepare("UPDATE info SET sdate='$nr7',edate='$nr8' WHERE year1='$cdyear' AND name='markingperiod'")) {
			$stmt3->execute();
			
		}
	}
	
	$select5 = "SELECT * FROM info WHERE year1='$cdyear' AND name='markingend'";
	$result5 = $conn->query($select5);	
	if ($result5->num_rows == 0) {
		
		if ($stmt4 = $conn->prepare("INSERT INTO info (year1,
													  name, 
													  sdate, 
													  edate) 
												VALUES ('$cdyear',
														'markingend',
														'$nr9',
														'$nr10')")) {
			$stmt4->execute();
			
		}
		
	}
	else{
		if ($stmt4 = $conn->prepare("UPDATE info SET sdate='$nr9',edate='$nr10' WHERE year1='$cdyear' AND name='markingend'")) {
			$stmt4->execute();
			
		}
	}
	
	echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'enterinfo.php';
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
    <title>Shedule Period</title>

    
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
          <form method ="post" id="msform" enctype="multipart/form-data" > 
            <!-- Tittle -->
            <div class="tittle">
              <h1>Shedule Period </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <?php
			$statusofupd=0;
			
			$select6 = "SELECT * FROM info WHERE year1='$cdyear' AND name='appCall'";
			$result6 = $conn->query($select6);
			if ($result6->num_rows > 0) {
				$statusofupd=1;
				
				while($rows6 = $result6->fetch_assoc()) {
					$bs1=$rows6['sdate']; 
					$bs2=$rows6['edate']; 
				}
			}
			
			$select7 = "SELECT * FROM info WHERE year1='$cdyear' AND name='principleapprove'";
			$result7 = $conn->query($select7);
			if ($result7->num_rows > 0) {
				$statusofupd=1;
				
				while($rows7 = $result7->fetch_assoc()) {
					$bs3=$rows7['sdate']; 
					$bs4=$rows7['edate']; 
				}
			}
			
			$select8 = "SELECT * FROM info WHERE year1='$cdyear' AND name='evaluationperiod'";
			$result8 = $conn->query($select8);
			if ($result8->num_rows > 0) {
				$statusofupd=1;
				
				while($rows8 = $result8->fetch_assoc()) {
					$bs5=$rows8['sdate']; 
					$bs6=$rows8['edate']; 
				}
			}
			
			$select9 = "SELECT * FROM info WHERE year1='$cdyear' AND name='markingperiod'";
			$result9 = $conn->query($select9);
			if ($result9->num_rows > 0) {
				$statusofupd=1;
				
				while($rows9 = $result9->fetch_assoc()) {
					$bs7=$rows9['sdate']; 
					$bs8=$rows9['edate']; 
				}
			}
			
			$select10 = "SELECT * FROM info WHERE year1='$cdyear' AND name='markingend'";
			$result10 = $conn->query($select10);
			if ($result10->num_rows > 0) {
				$statusofupd=1;
				
				while($rows10 = $result10->fetch_assoc()) {
					$bs9=$rows10['sdate']; 
					$bs10=$rows10['edate']; 
				}
			}
			?>
			<!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Application Calling - Start Date</label>
                  <input type="date" class="form-control" name="appcallstart" placeholder="Application Calling - Start Date" required value="<?php if($statusofupd==1){ echo $bs1;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Application Calling - End Date</label>
                  <input type="date" class="form-control" name="appcallend" placeholder="Application Calling - End Date" required value="<?php if($statusofupd==1){ echo $bs2;} ?>">
                </div>
				
              </div>
			  
			  <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Principle Approve - Start Date</label>
                  <input type="date" class="form-control" name="principleapprovestart" placeholder="Principle Approve - Start Date" required value="<?php if($statusofupd==1){ echo $bs3;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Principle Approve - End Date</label>
                  <input type="date" class="form-control" name="principleapproveend" placeholder="Principle Approve - End Date" required value="<?php if($statusofupd==1){ echo $bs4;} ?>">
                </div>
				
              </div>
			  
			  <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Evaluation Period - Start Date</label>
                  <input type="date" class="form-control" name="evaluationstart" placeholder="Evaluation Period - Start Date" required value="<?php if($statusofupd==1){ echo $bs5;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Evaluation Period - End Date</label>
                  <input type="date" class="form-control" name="evaluationend" placeholder="Evaluation Period - End Date" required value="<?php if($statusofupd==1){ echo $bs6;} ?>">
                </div>
				
             </div>
			 
			  <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Marking Period - Start Date</label>
                  <input type="date" class="form-control" name="markingstart" placeholder="Marking Period - Start Date" required value="<?php if($statusofupd==1){ echo $bs7;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Marking Period - End Date</label>
                  <input type="date" class="form-control" name="markingend" placeholder="Marking Period - End Date" required value="<?php if($statusofupd==1){ echo $bs8;} ?>">
                </div>
				
             </div>
			 
			  <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Total Process Period - Start Date</label>
                  <input type="date" class="form-control" name="totalprocessstart" placeholder="Total Process Period - Start Date" required value="<?php if($statusofupd==1){ echo $bs9;} ?>">
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="validationTooltip01">Total Process Period - End Date</label>
                  <input type="date" class="form-control" name="totalprocessend" placeholder="Total Process Period - End Date" required value="<?php if($statusofupd==1){ echo $bs10;} ?>">
                </div>
				
             </div>
			 
              <button type="submit" class="btn btn-success" name="btn_period">Confirm</button>  
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

