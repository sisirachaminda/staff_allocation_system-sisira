<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
$select4 = "SELECT * FROM subjects INNER JOIN markingcenters ON subjects.subject_id=markingcenters.subjectID WHERE markingcenters.panelNo='$ses_panelno'";
$result4 = $conn->query($select4);
while ($row4 = $result4->fetch_assoc()) {
	$subject_id = $row4['subject_id'];
	$subject_name = $row4['subject_name'];
	$medium = $row4['medium'];
	if($medium = '2') {
		$med = 'Sinhala';
	} else if($medium = '3') {
		$med = 'Tamil';
	} else {
		$med = 'English';
	}
}

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
		
		$paperI = $_POST['PI'.$examiner_ids];
        $paperII = $_POST['PII'.$examiner_ids];
        $paperIII = $_POST['PIII'.$examiner_ids];
		
		$select2= "SELECT * FROM markingprogress WHERE examinerid = '$examiner_ids' AND date = '$cddate'";
		$results2 = $conn->query($select2);
		if ($results2->num_rows > 0) {
		  
			if ($stmt = $conn->prepare("UPDATE markingprogress SET HP1='$paperI',HP2='$paperII',HP3='$paperIII'
															WHERE examinerid='$examiner_ids' 
															  AND date='$cddate'")) {
				$stmt->execute();
			}
		  
		} else {
			if ($stmt = $conn->prepare("INSERT INTO markingprogress (panelNo,examinerid,date,HP1,HP2,HP3)
														  VALUES ('$ses_panelno','$examiner_ids','$cddate','$paperI','$paperII','$paperIII')")) {
				$stmt->execute();
			}
		}
	}
	
	echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'markingprogress.php';
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
    <title>Marking Progress</title>

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
				<h2>Marking Progress</h2>
			  </div>
			  <div class="col-sm-12 col-lg-3">
				<h4 id="date" style="color:red">Date : <?php echo $cddate; ?></h4>
			  </div>
			  <hr>
			</div>
			<div class="row">
			  <div class="col-sm-12 col-lg-4">
				<h5>Subject Name : <?php echo $subject_name; ?></h5>
			  </div>
			  <div class="col-sm-12 col-lg-4">
				<h5>Subject No. : <?php echo $subject_id; ?></h5>
			  </div>
			  <div class="col-sm-12 col-lg-4">
				<h5>Medium : <?php echo $med; ?></h5>
			  </div>
			</div>
			<br>
			<!-- fieldsets -->
           
				<table class="display"  width="100%">
                        <thead>
                          <tr>
                            <th rowspan="2" width="2%">#</th>
                            <th rowspan="2" width="10%">Designation</th>
                            <th rowspan="2" width="18%">Name</th>
							<th rowspan="2" width="10%">NIC</th>
                            <th colspan="3" width="15%" style="color:red;font-weight:bold;">Assinged Papers</th>
                            <th colspan="3" width="15%" style="color:orange;font-weight:bold;">Balance Papers</th>
                            <th colspan="3" width="30%" style="color:green;font-weight:bold;">Completed Papers</th>
                          </tr>
						  <tr>
                            <th width="5%" style="color:red;font-weight:bold;">PaperI</th>
                            <th width="5%" style="color:red;font-weight:bold;">PaperII</th>
                            <th width="5%" style="color:red;font-weight:bold;">PaperIII</th>
							
							<th width="5%" style="color:orange;font-weight:bold;">PaperI</th>
                            <th width="5%"style="color:orange;font-weight:bold;">PaperII</th>
                            <th width="5%"style="color:orange;font-weight:bold;">PaperIII</th>
							
							<th width="10%" style="color:green;font-weight:bold;">PaperI</th>
                            <th width="10%"style="color:green;font-weight:bold;">PaperII</th>
                            <th width="10%"style="color:green;font-weight:bold;">PaperIII</th>
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
								  
								  $select3 = "SELECT * FROM markingprogress WHERE examinerid = '$examinerid' AND date = '$cddate'";
								  $result3 = $conn->query($select3);
								  if ($result3->num_rows > 0) {
									while($row3 = $result3->fetch_assoc()) {
									  $p1 = $row3['IP1'];
									  $p2 = $row3['IP2'];
									  $p3 = $row3['IP3'];
									  $p4 = $row3['HP1'];
									  $p5 = $row3['HP2'];
									  $p6 = $row3['HP3'];
									}
								  } else {
									$p1 = 0;
									$p2 = 0;
									$p3 = 0;
									$p4 = 0;
									$p5 = 0;
									$p6 = 0;
								  }
								  
								  $allip1=0;
								  $allip2=0;
								  $allip3=0;
								  $comip1=0;
								  $comip1=0;
								  $comip1=0;
								  $balpaper1=0;
								  $balpaper2=0;
								  $balpaper3=0;
								  
								  $select5 = "SELECT SUM(IP1) AS allip1, 
													 SUM(IP2) AS allip2,
													 SUM(IP3) AS allip3,
													 SUM(HP1) AS comip1,
													 SUM(HP2) AS comip2,
													 SUM(HP3) AS comip3
													FROM markingprogress WHERE examinerid = '$examinerid'";
								  $result5 = $conn->query($select5);
								  while($row5 = $result5->fetch_assoc()) {
									  $allip1=$row5['allip1'];
									  $allip2=$row5['allip2'];
									  $allip3=$row5['allip3'];
									  $comip1=$row5['comip1'];
									  $comip2=$row5['comip2'];
									  $comip3=$row5['comip3'];
								  }
								  
								  $balpaper1=$allip1-$comip1;
								  $balpaper2=$allip2-$comip2;
								  $balpaper3=$allip3-$comip3;
								  
								  
								  $n++;
                                  echo "<tr>
										  <td>".$n."</td>
										  <td>".$appoint."</td>
										  <td>".$row['initialName']."</td>
										  <td>".$row['nic']."</td>
										  
										  <td>".$p1."</td>
										  <td>".$p2."</td>
										  <td>".$p3."</td>
										  
										  <td>".$balpaper1."</td>
										  <td>".$balpaper2."</td>
										  <td>".$balpaper3."</td>
										  
										  <td>
											  <input class='form-control' id='paper' type='number' name='PI$examinerid' value='$p4' min='0' max='$balpaper1'>
										  </td>
										  <td>
											  <input class='form-control' id='paper' type='number' name='PII$examinerid' value='$p5' min='0' max='$balpaper2'>
										  </td>
										  <td>
											  <input class='form-control' id='paper' type='number' name='PIII$examinerid' value='$p6' min='0' max='$balpaper3'>
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

