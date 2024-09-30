<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
if(isset($_POST['add'])){
	
	if ($stmt = $conn->prepare("INSERT INTO panelmessage (year1,date,target,message,managerid)
												VALUES ('$cdyear','$cddate','$_POST[panel]','$_POST[comments]','$ses_ukey')")) {
				$stmt->execute();
	}
		
	echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'panelmessage.php';
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
    <title>All Panel Message</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/demo.css">
	<link rel="stylesheet" href="css/dashboard.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
				<h2>All Panel Message</h2>
			  </div>
			  <div class="col-sm-12 col-lg-3">
				<h4 id="date" style="color:red">Date : <?php echo $cddate; ?></h4>
			  </div>
			  <hr>
			</div>
			<!-- fieldsets -->
				
				<div class="form-row">
					<div class="col-md-4 mb-3">
					</div>
					
					<div class="col-md-4 mb-3">
					  <label for="validationTooltip01">Panel</label>
					  <select class='form-control' name="panel" id="panel">
						
					   <?php
						  $sel1="";
						  $select1 = "SELECT * FROM markingcenters INNER JOIN school ON markingcenters.schoolID=school.sc_id
																   INNER JOIN subjects ON markingcenters.subjectID=subjects.subject_id
																   ";
						  $result1 = $conn->query($select1);	
						  while($row1=$result1->fetch_assoc()) {
							$i=$row1['medium'];
																											
							if($i==2){
								$medium1="Sinhala";
							}
							if($i==3){
								$medium1="Tamil";
							}
							if($i==4){
								$medium1="English";
							}
							$sel1 = $sel1."<option value='" .$row1['panelNo']."'>" . $row1['panelNo'] ."-". $row1['schoolname'] ."- ". $row1['subject_name'] . "-". $medium1 . "</option>";
						  }
						  
							echo "<option value='All'>All</option>";
							echo $sel1;
						  
					   ?>
					  </select>
					</div>
				</div>
                
				<div class="row">
					<div class="col-sm-12 col-lg-4">
					
					</div>
					<div class="col-sm-12 col-lg-4">
					  <label>Message:</label>
					  <textarea name="comments" class="form-control" required></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12 col-lg-4">
							
					</div>
					<div class="col-sm-12 col-lg-4">
							<input class='btn btn-success btn-block' type='submit' value='Add' name='add'>
					</div>
				</div>	
			</form>
			<br>
			<br>
			<h3>All Panel Message</h3>
			<table class="table display" id="example" width="100%">
                        <thead>
                          <tr>
                            <th scope='col'>Date</th>
                            <th scope='col'>Panel</th>
							<th scope='col'>Message</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $n=0;
                            $selectExaminers = "SELECT * FROM panelmessage WHERE year1='$cdyear' ORDER BY date DESC";
                            $result = $conn->query($selectExaminers);
                            while($row = $result->fetch_assoc()) {
								 
                                  echo "<tr>
										  <td>".$row['date']."</td>
										  <td>".$row['target']."</td>
										  <td>".$row['message']."</td>
                                     </tr>";
                                
                            }
                          ?>
                        </tbody>
            </table>
        </section> 
      </article>
	
		
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
	  
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>   
	  
    </main>
  </div>
</div>



</body>

</html>

