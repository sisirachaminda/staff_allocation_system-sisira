<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
if(isset($_POST['btn_add'])){
	
	$nr1=$_POST['subject'];
	$nr2=$_POST['paper1'];
	$nr3=$_POST['paper2'];
	$nr4=$_POST['paper3'];
	
	
	$select = "SELECT * FROM markingfee WHERE year1='$cdyear' AND subjectNo='$nr1'";
	$result = $conn->query($select);	
	if ($result->num_rows == 0) {
		
		if ($stmt = $conn->prepare("INSERT INTO markingfee(year1,subjectNo,paper1,paper2,paper3) 
												VALUES ('$cdyear','$nr1','$nr2','$nr3','$nr4')")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'markingfees.php';
			</script>";
		}
		
	}
	else{
		echo "<script>
				alert('Sorry ! Duplicate Marking Fee !')
				window.location.href = 'markingfees.php';
		</script>";
	}
}


if(isset($_GET['del'])){
		if ($stmt = $conn->prepare("DELETE FROM markingfee WHERE id='$_GET[del]'")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Deleted!')
				window.location.href = 'markingfees.php';
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
    <title>Marking Fees</title>

    
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
            <div class="tittle">
              <h1>Marking Fees </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            
			<!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label for="validationTooltip01">Subject</label>
                  <select id="subject" name="subject" class="form-control" required>
					<?php
					  $sel11="";
					  $select11 = "SELECT * FROM subjects";
					  $result11 = $conn->query($select11);	
					  while($row11=$result11->fetch_assoc()) {
                        $sel11 = $sel11."<option value='" .$row11['subject_id']."'>" .$row11['subject_id']." - " . $row11['subject_name'] ."</option>";
                      }
					  
					  echo "<option value='' disabled selected hidden>Select Subject.............</option>";
					  echo $sel11;
				   ?>
                  </select>
                </div>
				
				<div class="col-md-4 mb-3">
                  <label for="validationTooltip01">Paper I Price</label>
                  <input type="text" class="form-control" name="paper1" placeholder="Paper I Price" required>
                </div>
				
				<div class="col-md-4 mb-3">
                  <label for="validationTooltip01">Paper II Price</label>
                  <input type="text" class="form-control" name="paper2" placeholder="Paper II Price" required>
                </div>
				
				<div class="col-md-4 mb-3">
                  <label for="validationTooltip01">Paper III Price</label>
                  <input type="text" class="form-control" name="paper3" placeholder="Paper III Price" required>
                </div>
              </div>
			  <div class="form-row">
				<div class="col-md-5 mb-3">
				
				</div>
				<div class="col-md-4 mb-3">
					<button type="submit" class="btn btn-success" name="btn_add">Add Price</button>  
				</div>
			   </div>
            </fieldset>
			</form>  
			<br>
			<br>
			<!-- .................................................................................................................................-->
			
			 <table class='table pending'>
                        <thead>
                          <tr>
                            <th scope='col'>Subject</th>
                            <th scope='col'>Paper I Price</th>
                            <th scope='col'>Paper II Price</th>
                            <th scope='col'>Paper III Price</th>
                            <th scope='col'>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            echo "";
                            $select2 = "SELECT *,markingfee.id AS mid FROM markingfee INNER JOIN subjects ON markingfee.subjectNo=subjects.subject_id WHERE markingfee.year1='$cdyear'";
                            $result2 = $conn->query($select2);
                            if ($result2->num_rows > 0) {
								
								while($row2 = $result2->fetch_assoc()) {
								  
                                  echo "<tr>
										  <td scope='row' align='left'>".$row2['subject_id']." - ".$row2['subject_name']."</td>
										  <td scope='row' align='left'>".$row2['paper1']."</td>
										  <td scope='row' align='left'>".$row2['paper2']."</td>
										  <td scope='row' align='left'>".$row2['paper3']."</td>
										  <td align='left'><a href='markingfees.php?del=".$row2['mid']."'><button class='btn btn-danger'>Delete</button> </a></td>
                                        </tr>";
                                }
                            } 
							else {
								echo "<tr><td colspan='6' align='center'>No Marking Fee</td></tr>";
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
	 
	

    </main>
  </div>
</div>
</body>

</html>

