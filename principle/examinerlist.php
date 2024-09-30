<?php
include 'db-connect.php';
include 'session_handler.php';
include 'cdn.html';

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
    <title>Application for Marking</title>
     <link rel="stylesheet" href="plugin/font-awesome.min.css">

    <script src="plugins/jquery.min37.js"></script>

    <link rel="stylesheet" href="plugins/css@3.css">

	<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      #date {
        color:red;
      }
      #check {
        margin-left: 30px;
      }
      .pending th {
        background-color:#17a2b8 !important;
        color:#fff !important;
      }
      .approved th {
        background-color:#17b85d !important;
        color:#fff !important;
      }
      #submited {
        background-color:#b417b8 !important;
        color:#fff !important;
        padding: 5px;
      }
      .btn {
        height: 40px;
        width:200px;
      }
    </style>
     <link href="plugins/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
  <?php include ('header.php'); ?>
    <div class="container-fluid">
      <div class="row">
		
		<?php include ('sidebar.php'); ?>
		
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col col-12">
            <div class="row">
              <div class="col-sm-12 col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-9">
                        <h2>Request Application for Marking Examiner</h2>
                      </div>
                      <hr>
                    </div>
                    <h5>Approved Applications</h5>
                    
                      <table class='table approved'>
                        <thead>
                          <tr>
                            <th scope='col'>Name</th>
                            <th scope='col'>NIC</th>
                            <th scope='col'>Subject</th>
                            <th scope='col'>Medium</th>
                            <th scope='col'>Mobile Phone</th>
                            <th scope='col'>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            echo "";
                            $selectExaminers = "SELECT * FROM basicdetails WHERE school='$ses_school' 
																			AND year1='$cdyear' 
																			AND principleApproveStatus=1";
                            $result = $conn->query($selectExaminers);
                            if ($result->num_rows > 0) {
								
								while($row = $result->fetch_assoc()) {
								  $select1="SELECT * FROM subjects WHERE subject_id='$row[subject]'";
								  $result1 = $conn->query($select1);
								  while($row1 = $result1->fetch_assoc()) {
									 $subject_name=$row1['subject_name'];
								  }
								  
								  if($row['medium']==2){
									 $med="Sinhala"; 
								  }
								  if($row['medium']==3){
									 $med="Tamil"; 
								  }
								  if($row['medium']==4){
									 $med="English"; 
								  }
                                  echo "<tr>
										  <td scope='row'>".$row['initialName']."</td>
										  <td>".$row['nic']."</td>
										  <td>".$row['subject']." - ".$subject_name."</td>
										  <td>".$row['medium']." - ".$med."</td>
										  <td>".$row['mobilephone']."</td>
										  <td>
											  <a href='preview_app.php?id=".$row['examiner_id']."'><button class='btn btn-primary' type='button'>View</button></a>
										  </td>
                                        </tr>";
                                }
                            } 
							else {
								echo "<tr><td colspan='6' align='center'>No Approved application</td></tr>";
                            }
                          ?>
                        </tbody>
                      </table>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
		</main>
      </div>
    </div>
  </body>
</html>