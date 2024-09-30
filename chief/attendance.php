<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
if(isset($_POST['update'])){
	$select1 = "SELECT * FROM basicdetails WHERE year1='$cdyear' 
											AND panelNo='$ses_panelno'
											AND principleApproveStatus=1
											ORDER BY appointedAs ASC,marks DESC";
	$results1 = $conn->query($select1);
	while($rows1 = $results1->fetch_assoc()) {
		
		$examiner_ids = $rows1['examiner_id'];
		
		$check = $_POST["check".$examiner_ids];
		
		if ($check != 1) {
		  $check = 0;
		}
		
		$select2= "SELECT * FROM exattendance WHERE examinerid = '$examiner_ids' AND date = '$cddate'";
		$results2 = $conn->query($select2);
		if ($results2->num_rows > 0) {
		  
			if ($stmt = $conn->prepare("UPDATE exattendance SET  attendance='$check'
															WHERE examinerid='$examiner_ids' 
															  AND date='$cddate'")) {
				$stmt->execute();
			}
		  
		} else {
			if ($stmt = $conn->prepare("INSERT INTO exattendance (panelNo,examinerid,date,attendance)
														  VALUES ('$ses_panelno','$examiner_ids','$cddate','$check')")) {
				$stmt->execute();
			}
		}
	}
	
	echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'attendance.php';
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
    <title>Attendance</title>

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
             <div class="row">
			  <div class="col-sm-12 col-lg-9">
				<h2>Enter Examiner Attendance</h2>
			  </div>
			  <div class="col-sm-12 col-lg-3">
				<h4 id="date" style="color:red">Date : <?php echo $cddate; ?></h4>
			  </div>
			  <hr>
			</div>
			<!-- fieldsets -->
           
				<table class="table display" id="example" width="100%">
                        <thead>
                          <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Designation</th>
                            <th scope='col'>Name</th>
							<th scope='col'>NIC</th>
                            <th scope='col'>Attendance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $n=0;
                            $selectExaminers = "SELECT * FROM basicdetails WHERE year1='$cdyear' 
																			AND panelNo='$ses_panelno'
																			AND principleApproveStatus=1
																			ORDER BY appointedAs ASC,marks DESC";
                            $result = $conn->query($selectExaminers);
                            while($row = $result->fetch_assoc()) {
								  if($row['appointedAs'] == 'adchief') {
									$appoint = 'Aditional Chief';
								  } 
								  if($row['appointedAs'] == 'examiner') {
									$appoint = 'Examiner';
								  }
								  $examinerid=$row['examiner_id'];
								  
								  $select3 = "SELECT * FROM exattendance WHERE examinerid = '$examinerid' AND date = '$cddate'";
								  $result3 = $conn->query($select3);
								  if ($result3->num_rows > 0) {
									while($row3 = $result3->fetch_assoc()) {
									  $value = $row3['attendance'];
									  if($value == 1) {
										$checked = 'checked';
									  } else {
										$checked = '';
									  }
									}
								  } else {
									$checked = '';
								  }
								  
								  $n++;
                                  echo "<tr>
										  <td>".$n."</td>
										  <td>".$appoint."</td>
										  <td>".$row['initialName']."</td>
										  <td>".$row['nic']."</td>
										  <td>
											  <input class='form-check-input' id='check' type='checkbox' value=1 name='check$examinerid'  $checked>
										  </td>
                                        </tr>";
                                
                            }
                          ?>
                        </tbody>
                </table>
				<div class="row">
					<div class="col-sm-12 col-lg-4">
							
					</div>
					<div class="col-sm-12 col-lg-4">
							<input class='btn btn-primary btn-block' type='submit' value='Update' name='update'>
					</div>
				</div>	
			</form>
			<br>
			<br>
        </section> 
      </article>
	
		
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
	  
      <script src='plugins/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='plugins/bootstrap.bundle.min.js'></script>
      <script src='plugins/intlTelInput.js'></script>
      <script src='plugins/popper.min.js'></script>
      <script src='plugins/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>   
	  
    </main>
  </div>
</div>



</body>

</html>

