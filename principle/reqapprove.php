<?php
include 'db-connect.php';
include 'session_handler.php';
include 'cdn.html';

$cddate=date("Y-m-d");
$cdyear=date("Y");
?>
<?php
$select2 = "SELECT * FROM basicdetails WHERE school='$ses_school' 
										AND year1='$cdyear' 
										AND appStatus='Complete' 
										AND principleApproveStatus IS NULL 
										AND reject_reson IS NULL";
$result2 = $conn->query($select2);
while($row2 = $result2->fetch_assoc()) {
	$apply_subject=$row2['subject'];
	
	$select3 = "SELECT * FROM declaration WHERE examiner_id='$row2[examiner_id]' AND year1='$cdyear' AND sit_exam=1";
	$result3 = $conn->query($select3);
	if ($result3->num_rows > 0) {
		while($row3 = $result3->fetch_assoc()) {
			$sit_sub1=$row3['sit_sub1'];
			$sit_sub2=$row3['sit_sub2'];
			$sit_sub3=$row3['sit_sub3'];
		}
		
		$reject_reason="A member of your family or someone staying at home appearing for the subject you have applied for.";
		$reject_panel="System";
		
		if($apply_subject==$sit_sub1){
			
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson='$reject_reason',
																 reject_panel='$reject_panel'
															WHERE examiner_id='$row2[examiner_id]' 
															  AND year1='$cdyear'")) {
				$stmt1->execute();
			}
		}
		if($apply_subject==$sit_sub2){
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson='$reject_reason',
																 reject_panel='$reject_panel'
															WHERE examiner_id='$row2[examiner_id]' 
															  AND year1='$cdyear'")) {
				$stmt1->execute();
			}
		}
		if($apply_subject==$sit_sub3){
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson='$reject_reason',
																 reject_panel='$reject_panel'
															WHERE examiner_id='$row2[examiner_id]' 
															  AND year1='$cdyear'")) {
				$stmt1->execute();
			}
			
		}

	}
	
	$select4 = "SELECT * FROM declaration WHERE examiner_id='$row2[examiner_id]' AND year1='$cdyear' AND dis_action='1'";
	$result4 = $conn->query($select4);
	if ($result4->num_rows > 0) {
			
			$reject_reason1="Disciplinary inquiry against you in progress";
			$reject_panel="System";
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson='$reject_reason1',
																 reject_panel='$reject_panel'
															WHERE examiner_id='$row2[examiner_id]' 
															  AND year1='$cdyear'")) {
				$stmt1->execute();
			}
	}
	
	$select5 = "SELECT * FROM declaration WHERE examiner_id='$row2[examiner_id]' AND year1='$cdyear' AND dib_action='1'";
	$result5 = $conn->query($select5);
	if ($result5->num_rows > 0) {
			
			$reject_reason2="Debarred from examination duties.";
			$reject_panel="System";
			
			if ($stmt1 = $conn->prepare("UPDATE basicdetails SET reject_reson='$reject_reason2',
																 reject_panel='$reject_panel'
															WHERE examiner_id='$row2[examiner_id]' 
															  AND year1='$cdyear'")) {
				$stmt1->execute();
			}
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
                    <h5>Pending Applications</h5>
                    
                      <table class='table pending'>
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
																			AND appStatus='Complete' 
																			AND principleApproveStatus IS NULL 
																			AND reject_reson IS NULL";
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
											  <a href='approve_app.php?id=".$row['examiner_id']."'><button class='btn btn-primary' type='button'>View</button></a>
										  </td>
                                        </tr>";
                                }
                            } 
							else {
								echo "<tr><td colspan='6' align='center'>No pending application</td></tr>";
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