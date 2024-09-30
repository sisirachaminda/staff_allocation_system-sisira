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
        
            // Validate selected file is a CSV file or not
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {
        
                // Detele if datas already exists in Schools table 
                $query = "SELECT * FROM school";
                $check = mysqli_query($conn, $query);
                if ($check->num_rows > 0) {
                   
				    $delChief = "DELETE FROM school";
                    mysqli_query($conn, $delChief);
					
					if ($stmt = $conn->prepare("UPDATE markingcenters SET isChief='0' WHERE isChief='1' AND year1='$cdyear'")) {
						$stmt->execute();
					}
					
					if ($stmt2 = $conn->prepare("DELETE FROM principles WHERE year1='$cdyear'")) {
						$stmt2->execute();
					}
                }

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                // Parse data from CSV file line by line        
                while ($getData = fgetcsv($csvFile)) {
                    // Get row data
                    $sc_id = $getData[0];
                    $zone_id = $getData[1];
                    $schoolname = $getData[2];
                    $schoolAddress = $getData[3]; 
                    $schoolPostal = $getData[4];           
                    $nic = $getData[5];
                    $pass = $getData[6];
                    $password = MD5($pass);
					
					$select = "SELECT * FROM school WHERE sc_id='".$sc_id."' AND schoolname='".$schoolname."'";
					$result = $conn->query($select);	
					if ($result->num_rows == 0) {
						$select2 = "SELECT * FROM principles WHERE year1='".$cdyear."' AND nic='".$nic."'";
						$result2 = $conn->query($select2);	
						if ($result2->num_rows == 0) {
							if ($stmt = $conn->prepare("INSERT INTO school (sc_id, zone_id, schoolname, schoolAddress, schoolPostal) VALUES ('".$sc_id."', '".$zone_id."', '".$schoolname."', '".$schoolAddress."', '".$schoolPostal."')")) {
								$stmt->execute();
							}
						
							if ($stmt1 = $conn->prepare("INSERT INTO principles (year1, school, nic, password) VALUES ('".$cdyear."', '".$sc_id."', '".$nic."', '".$password."')")) {
								$stmt1->execute();
							}
						}
					}
					else{
						$select1 = "SELECT * FROM principles WHERE year1='".$cdyear."' AND school='".$sc_id."' AND nic='".$nic."'";
						$result1 = $conn->query($select1);	
						if ($result1->num_rows == 0) {
							$select2 = "SELECT * FROM principles WHERE year1='".$cdyear."' AND nic='".$nic."'";
							$result2 = $conn->query($select2);	
							if ($result2->num_rows == 0) {
								if ($stmt = $conn->prepare("INSERT INTO principles (year1, school, nic, password) VALUES ('".$cdyear."', '".$sc_id."', '".$nic."', '".$password."')")) {
									$stmt->execute();
								}
							}
						}
						else{
							if ($stmt = $conn->prepare("UPDATE principles SET password='".$password."'  WHERE year1='".$cdyear."' AND school='".$sc_id."' AND nic='".$nic."'")) {
								$stmt->execute();
							}
						}
						
					}
                }

                // Close opened CSV file
                fclose($csvFile);
                echo "<script>
					alert('Update Successful!')
					window.location.href = 'uploadSchools.php'     
				</script>";
                  
            }
            else {
              
				 echo "<script>
					alert('Select Valid File!')
					window.location.href = 'uploadSchools.php'     
				</script>";
            }
        }
        
        // Clear Data
        if(isset($_POST['clrdata'])) {
            if ($stmt = $conn->prepare("UPDATE markingcenters SET isChief='0' WHERE isChief='1' AND year1='$cdyear'")) {
				$stmt->execute();
			}
			
			if ($stmt1 = $conn->prepare("DELETE FROM school")) {
				$stmt1->execute();
			}
			
			if ($stmt2 = $conn->prepare("DELETE FROM principles WHERE year1='$cdyear'")) {
				$stmt2->execute();
			}
			
			echo "<script>
				alert('Successfully Cleard!')
				window.location.href = 'uploadschools.php';
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
    <title>Upload Schools</title>

    
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
                            <h2>Upload School</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <form method="post" enctype="multipart/form-data">
                        <div class='row mt-4'>
                            <?php 
                                $checkData = "SELECT * FROM school";
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
                                        </div>";
                                }
                            ?>
                            
                        </div>
                    </form>
                    <div class="details mt-4">
                        <h4>Allocated Schools Details<hr></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Zone Code</th>
                                        <th>School Code</th>
                                        <th>School Name</th>
                                        <th>School Address</th>
                                        <th>School Postal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * FROM school ORDER BY sc_id ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                        $sc_id = $row['sc_id'];
                                        $zone_id = $row['zone_id'];
                                        $schoolname = $row['schoolname'];
                                        $schoolAddress = $row['schoolAddress'];
                                        $schoolPostal = $row['schoolPostal'];
                                   echo "
                                    <tr>
                                        <td>".$zone_id."</td>
                                        <td>".$sc_id."</td>
                                        <td>".$schoolname."</td>
                                        <td>".$schoolAddress."</td>
                                        <td>".$schoolPostal."</td>
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

    </main>
  </div>
</div>
</body>

</html>

