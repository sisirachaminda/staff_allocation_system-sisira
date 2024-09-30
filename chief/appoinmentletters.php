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
    <title>Appoinment Letter Generate</title>

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
        <div class="col col-12">
           <?php
			$select11 = "SELECT * FROM chiefdetails WHERE year1='$cdyear' 
													AND id='$ses_ukey'
													AND appoinmentletterdte IS NOT NULL";
			$result11 = $conn->query($select11);
			if ($result11->num_rows > 0) {
		   ?>
				<div class='row mt-4'>
					
					<div class='col col-sm-12 col-lg-5'>
						<a href="fpdf/chiefexaminer_appoinment_letter.php?id=<?php echo $ses_ukey; ?>"><button class='btn btn-success'>Your Appoinment Letter</button></a>
					</div>
				   
					<div class='col col-sm-12 col-lg-4' id="spinner">
						
					</div>
				</div>
			<?php
			}
			?>
			
			<br>
			<div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                            <h2>Examiner and Additional Chief Examiner</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <div class="row mt-2">
								<div class="table-responsive">
									<table id="example" class="display table table-striped table-hover" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Designation</th>
												<th>Examiner Name</th>
												<th>NIC</th>
												<th>Appoinment Date</th>
												<th>Letter</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$n=0;
											$select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON  basicdetails.panelNo=markingcenters.panelNo
																					WHERE basicdetails.panelNo ='$ses_panelno'
																					  AND basicdetails.year1='$cdyear' 
																					  AND basicdetails.principleApproveStatus=1 
																					  AND basicdetails.appoinmentletterdte IS NOT NULL
																					  ORDER BY basicdetails.appointedAs ASC,basicdetails.marks DESC";
											$result1 = $conn->query($select1);
											while($row1 = $result1->fetch_assoc()) {
												
												$n++;
												
													
												if($row1['appointedAs'] == 'adchief') {
													$appoint = 'Aditional Chief';
													
													$letterlink="fpdf/adexaminer_appoinment_letter.php?id=".$row1['examiner_id']."";
												} 
												if($row1['appointedAs'] == 'examiner') {
													$appoint = 'Examiner';
													
													$letterlink="fpdf/examiner_appoinment_letter.php?id=".$row1['examiner_id']."";
												}
													
													echo "
													<tr>
														<td width='5%'>".$n."</td>
														<td width='15%'>".$appoint."</td>
														<td width='40%'>".$row1['initialName']."</td>
														<td width='15%'>".$row1['nic']."</td>
														<td width='15%'>".$row1['appoinmentletterdte']."</td>
														<td width='10%'><a href='".$letterlink."'><button class='btn btn-primary' type='button'>Letter</button></a></td>
													</tr>";
													
											}
											?>
										</tbody>
									</table>
								</div>
					</div>
					<!------ examiner and Additional Examiner Appoinment letters end -->
					
				</div>
			</div>
     
		<!-- END Multiform HTML -->
		
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

