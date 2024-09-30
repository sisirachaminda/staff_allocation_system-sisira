<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
if(isset($_POST['btn_add'])){
	$nr1=$_POST['pddiplomaname'];
	
	
	$select = "SELECT * FROM pdeploma WHERE diploma_name='$nr1'";
	$result = $conn->query($select);	
	if ($result->num_rows == 0) {
		
		if ($stmt = $conn->prepare("INSERT INTO pdeploma(diploma_name) 
												VALUES ('$nr1')")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'postgraduatediploma.php';
			</script>";
		}
		
	}
	else{
		echo "<script>
				alert('Sorry ! Duplicate Postgraduate Diploma !')
				window.location.href = 'postgraduatediploma.php';
		</script>";
	}
}


if(isset($_GET['del'])){
		if ($stmt = $conn->prepare("DELETE FROM pdeploma WHERE diploma_id='$_GET[del]'")) {
			$stmt->execute();
			echo "<script>
				alert('Successfully Deleted!')
				window.location.href = 'postgraduatediploma.php';
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
    <title>Postgraduate Diploma</title>

    
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
              <h1>Postgraduate Diploma </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            
			<!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                
				<div class="col-md-12 mb-3">
                  <label for="validationTooltip01">Postgraduate Diploma</label>
                  <input type="text" class="form-control" name="pddiplomaname" placeholder="Postgraduate Diploma Name" required>
                </div>
				
              </div>
			  <div class="form-row">
				<div class="col-md-5 mb-3">
				
				</div>
				<div class="col-md-4 mb-3">
					<button type="submit" class="btn btn-success" name="btn_add">Add Postgraduate Diploma</button>  
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
                            <th scope='col'>Postgraduate Diploma</th>
                            <th scope='col'>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            echo "";
                            $select2 = "SELECT * FROM pdeploma";
                            $result2 = $conn->query($select2);
                            if ($result2->num_rows > 0) {
								
								while($row2 = $result2->fetch_assoc()) {
								  
                                  echo "<tr>
										  <td scope='row' align='left'>".$row2['diploma_name']."</td>
										  <td align='left'><a href='postgraduatediploma.php?del=".$row2['diploma_id']."'><button class='btn btn-danger'>Delete</button> </a></td>
                                        </tr>";
                                }
                            } 
							else {
								echo "<tr><td colspan='6' align='center'>No Postgraduate Diploma</td></tr>";
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

