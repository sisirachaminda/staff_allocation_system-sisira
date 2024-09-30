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
                        <h2>Appoinment Letters</h2>
                      </div>
                      <hr>
                    </div>
                    
                    
                      <table class='table approved'>
                        <thead>
                          <tr>
                            <th>Panel No</th>
							<th>Center No</th>
							<th>Town</th>
							<th>Subject</th>
							<th>Medium</th>
							<th>Appoinment Date</th>
							<th>Designation</th>
							<th>Examiner Name</th>
							<th>NIC No</th>
							<th>Letter</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $select1 = "SELECT * FROM basicdetails INNER JOIN markingcenters ON  basicdetails.panelNo=markingcenters.panelNo
																					WHERE basicdetails.year1='$cdyear'
																					  AND basicdetails.school='$ses_school'
																					  AND basicdetails.principleApproveStatus=1 
																					  AND basicdetails.appointedAs IS NOT NULL
																					  AND basicdetails.appoinmentletterdte IS NOT NULL";
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
										<td width='10%'>".$row1['panelNo']."</td>
										<td width='10%'>".$school."</td>
										<td width='10%'>".$town."</td>
										<td width='10%'>".$row1['subjectID']." ".$subject."</td>
										<td width='10%'>".$medium."</td>
										<td width='10%'>".$row1['appoinmentletterdte']."</td>
										<td width='10%'>".$appoint."</td>
										<td width='15%'>".$row1['initialName']."</td>
										<td width='10%'>".$row1['nic']."</td>
										<td width='5%'><a href='".$letterlink."'><button class='btn btn-success' type='button'>Letter</button></a></td>
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
		</main>
      </div>
    </div>
  </body>
</html>