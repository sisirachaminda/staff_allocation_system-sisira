<?php
include 'session_handler.php';
include 'db-connect.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
		if (isset($_POST['upload'])) {
            $fileMimes = array (
                'text/x-comma-separated-values',
                'text/comma-separated-values',
                'application/octet-stream',
                'application/vnd.ms-excel',
                'application/x-csv',
                'text/x-csv',
                'text/csv',
                'application/csv',
                'application/excel',
                'application/vnd.msexcel',
                'text/plain'
            );
        
            
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {

                $query = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
                $check = mysqli_query($conn, $query);
                if ($check->num_rows > 0) {
					
					$select1 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
					$result1 = $conn->query($select1);
					while($row1 = $result1->fetch_assoc()) {
						 $delbasic = "DELETE FROM examiner WHERE id='$row1[examiner_id]'";
						 mysqli_query($conn, $delbasic);
					}
					
                    $delexaminer = "DELETE FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
                    mysqli_query($conn, $delexaminer);
					
                }

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                // Parse data from CSV file line by line        
                while ($getData = fgetcsv($csvFile)) {
                    // Get row data
                    $panelNo = $getData[0];
                    $nic = $getData[1];
                    $name = $getData[2];
                    $perAddress = $getData[3]; 
                    $gender = $getData[4]; 
                    $mobile = $getData[5];
                    $email = $getData[6];
					$pass = $getData[7];	
					$password = MD5($pass);
					
					$select3 = "SELECT * FROM markingcenters WHERE panelNo='$panelNo'";
					$result3 = $conn->query($select3);
					while($row3 = $result3->fetch_assoc()) {
						$schoolID=$row3['schoolID'];
						$townNo=$row3['townNo'];
						$subjectID=$row3['subjectID'];
						$medium=$row3['medium'];
						$isExaminer=$row3['isExaminer'];
					}

                    $select = "SELECT * FROM examiner WHERE nic='$nic'";
					$result = $conn->query($select);	
					if ($result->num_rows == 0) {
						
						if ($stmt1 = $conn->prepare("INSERT INTO examiner (nic,password,email)
																VALUES ('$nic','$password','$email')")) {
							$stmt1->execute();
							
							$select2 = "SELECT * FROM examiner WHERE nic='$nic' AND email='$email'";
							$result2 = $conn->query($select2);
							while($row2 = $result2->fetch_assoc()) {
								$examinerid=$row2['id'];
							}
							
									if ($stmt3 = $conn->prepare("INSERT INTO basicdetails (examiner_id,
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
																  ageAsClose, 
																  appStatus, 
																  enterDate, 
																  updateDate, 
																  year1,
																  principleApproveStatus,
																  manualupdate,
																  appointedAs,
																  panelNo,
																  selectmethod) 
																  VALUES (
																  '$examinerid',
																  '$subjectID',
																  '$medium',
																  '$townNo',
																  'NA',
																  '$name',
																  '$name',
																  '$perAddress',
																  '$email',
																  '$gender',
																  '$nic',
																  'NA',
																  'NA',
																  'NA',
																  'NA',
																  'NA',
																  'NA',
																  'NA',
																  '$mobile',
																  'NA',
																  'Complete',
																  '$cddate',
																  '$cddate',
																  '$cdyear',
																   1,
																   1,
																  'examiner',
																  '$panelNo',
																  'Manual' )")) {
										$stmt3->execute();
									}
						}
						
						$isExaminer++;
						
						if ($stmt4 = $conn->prepare("UPDATE markingcenters SET isExaminer='$isExaminer' WHERE panelNo = '$panelNo'")) {
							$stmt4->execute();
						}
					}
					else{
							while($row = $result->fetch_assoc()) {
									$examinerid=$row['id'];
							}
							$select7 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND examiner_id='$examinerid'";
							$result7 = $conn->query($select7);	
							if ($result7->num_rows == 0) {
								if ($stmt3 = $conn->prepare("INSERT INTO basicdetails (examiner_id,
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
																	  ageAsClose, 
																	  appStatus, 
																	  enterDate, 
																	  updateDate, 
																	  year1,
																	  principleApproveStatus,
																	  manualupdate,
																	  appointedAs,
																	  panelNo,
																	  selectmethod,
																	  appStatus) 
																	  VALUES (
																	  '$examinerid',
																	  '$subjectID',
																	  '$medium',
																	  '$townNo',
																	  'NA',
																	  '$name',
																	  '$name',
																	  '$perAddress',
																	  '$email',
																	  '$gender',
																	  '$nic',
																	  'NA',
																	  'NA',
																	  'NA',
																	  'NA',
																	  'NA',
																	  'NA',
																	  'NA',
																	  '$mobile',
																	  'NA',
																	  'Complete',
																	  '$cddate',
																	  '$cddate',
																	  '$cdyear',
																	   1,
																	   1,
																	  'examiner',
																	  '$panelNo',
																	  'Manual'
																	  )")) {
											$stmt3->execute();
										}
										
										$isExaminer++;
						
										if ($stmt4 = $conn->prepare("UPDATE markingcenters SET isExaminer='$isExaminer' WHERE panelNo = '$panelNo'")) {
											$stmt4->execute();
										}
							}
							else{
								
								if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson=null,
																					reject_panel=null,
																					manualupdate=1,
																					appointedAs='examiner', 
																					panelNo='$panelNo'
																					WHERE examiner_id = '$examinerid'
																					  AND year1='$cdyear'")) {
									$stmt1->execute();
								}
								
								$isExaminer++;
						
								if ($stmt4 = $conn->prepare("UPDATE markingcenters SET isExaminer='$isExaminer' WHERE panelNo = '$panelNo'")) {
									$stmt4->execute();
								}
								
							}
					}
                    
                }
				
                fclose($csvFile);
                echo "<script>
						alert('Records Inserted!');
						window.location.href = 'manualaddtion.php';
					</script>";       
            }
            
        }
        
        // Clear Data
        if(isset($_POST['clrdata'])) {
            $select1 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
			$result1 = $conn->query($select1);
			while($row1 = $result1->fetch_assoc()) {
				 $delbasic = "DELETE FROM examiner WHERE id='$row1[examiner_id]'";
				 mysqli_query($conn, $delbasic);
			}
			
			$delexaminer = "DELETE FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
			mysqli_query($conn, $delexaminer);
			
			$select6="SELECT * FROM markingcenters";
			$result6 = $conn->query($select6);
			while($row6 = $result6->fetch_assoc()) {
				$select4 = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND appointedAs='examiner' AND panelNo='$row6[panelNo]'";
				$result4 = $conn->query($select4);
				$isdexaminer=$result4->num_rows;
					 
				$select5 = "UPDATE markingcenters SET isExaminer='$isdexaminer' WHERE panelNo = '$row6[panelNo]'";
				mysqli_query($conn, $select5);
			}
			
			echo "<script>
				alert('Successfully Cleard!')
				window.location.href = 'manualaddtion.php';
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
    <title>Examiner - Manual Addition</title>

    
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                            <h2>Examiner - Manual Addition</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <div class='row mt-4'>
                            <?php 
                                $checkData = "SELECT * FROM basicdetails WHERE year1='$cdyear' AND manualupdate=1";
                                $resultData = $conn->query($checkData);
                                if ($resultData->num_rows > 0) {
                                    echo "
                                        <div class='col col-sm-12 col-lg-2'>
                                            <input type='submit' name='clrdata' value='Clear Data' class='btn btn-danger'>
                                        </div>
                                        ";
                                } else {
                                    echo "
                                        <div class='col col-sm-12 col-lg-5'>
                                            <input type='file' class='form-control' name='file' style='width:350px';>
                                        </div>
                                        <div class='col col-sm-12 col-lg-2'>
                                            <input type='submit' name='upload' value='Upload' id='upload' class='btn btn-primary' style='width:150px'>
                                        </div>
                                        ";
                                }
                            ?>
                            <div class='col col-sm-12 col-lg-4' id="spinner">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Processing...
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <hr style="border-color: black;">
                    <div class="row mt-2">
                        <div class="table-responsive">
									<table id="example" class="display table table-striped table-hover" style="width:100%">
										<thead>
											<tr>
												<th>Panel No</th>
												<th>Center No</th>
												<th>Town</th>
												<th>Subject Name</th>
												<th>Subject Code</th>
												<th>Medium</th>
												<th>Examiner Name</th>
												<th>NIC</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON  basicdetails.panelNo=markingcenters.panelNo
																					WHERE basicdetails.year1='$cdyear' 
																					  AND basicdetails.manualupdate=1 
																					  AND basicdetails.appointedAs='examiner'";
											$result1 = $conn->query($select1);
											while($row1 = $result1->fetch_assoc()) {
													$med = $row1['medium'];
													if($med == '2') {
														$medium = 'Sinhala';
													}else if($med == '3') {
														$medium = 'Tamil';
													}else if($med == '4') {
														$medium = 'English';
													}
													$select2="SELECT * FROM school WHERE sc_id='$row1[schoolID]'";
													$result2 = $conn->query($select2);
													while($row2 = $result2->fetch_assoc()) {
														  $school=$row2['sc_id']."-".$row2['schoolname'];
													}
													  
													$select3="SELECT * FROM town WHERE town_id='$row1[townNo]'";
													$result3 = $conn->query($select3);
													while($row3 = $result3->fetch_assoc()) {
														  $town=$row3['town_id']."-".$row3['town_name'];
													}
													  
													$select4="SELECT * FROM subjects WHERE subject_id='$row1[subjectID]'";
													$result4 = $conn->query($select4);
													while($row4 = $result4->fetch_assoc()) {
														  $subject=$row4['subject_name'];
													}
													
													echo "
													<tr>
														<td width='10%'>".$row1['panelNo']."</td>
														<td width='15%'>".$school."</td>
														<td width='10%'>".$town."</td>
														<td width='10%'>".$row1['subjectID']."</td>
														<td width='10%'>".$subject."</td>
														<td width='10%'>".$medium."</td>
														<td width='20%'>".$row1['initialName']."</td>
														<td width='10%'>".$row1['nic']."</td>
													</tr>";
													
											}
											?>
										</tbody>
									</table>
						</div>
                    </div>
                </div>
            </div>
        </div>
     
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
	   <link rel="stylesheet" href="plugins/dataTables.dataTables.css" />
	  <script src="plugins/dataTables.js"></script>
	  <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
	
				var table = $('#example').DataTable({
					order: [[0, 'acs']],
				});
			});
		</script>
    </main>
  </div>
</div>
</body>

</html>

