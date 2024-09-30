<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
$selectemarkingperiod = "SELECT * FROM info WHERE name = 'markingperiod'";
$resultselectemarkingperiod = $conn->query($selectemarkingperiod);	
while($rows = $resultselectemarkingperiod->fetch_assoc()){
        $markingperiod_sdate = $rows['sdate'];  
        $markingperiod_edate = $rows['edate'];   
}

$selectmarkingend = "SELECT * FROM info WHERE name = 'markingend'";
$resultmarkingend = $conn->query($selectmarkingend);	
while($rows1 = $resultmarkingend->fetch_assoc()){
        $resultmarkingend_sdate = $rows1['sdate'];  
        $resultmarkingend_edate = $rows1['edate'];   
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
    <title>Reports</title>
    
	
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
      .btnText {
        font-size: 24px;
      }
      .raised-button {
        height: 200px;
        width: 100%;
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        border: 2px solid #4CAF50;
        color: #4CAF50;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
      }
      .raised-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      }
    </style>
	
    
    <!-- Custom styles for this template -->
    <link href="plugins/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/dashboard.css" rel="stylesheet">
    
  </head>
  <body>
  <?php include ('header.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include ('sidebar.php'); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="form-row">
            <div class="col-sm-12 col-12">
              <div class="card">
                <div class="card-body">
                  
				  <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <h2>Reports</h2>
                    </div>
                  </div>
				  <hr>
				  <?php
					if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				  ?>
						<?php
						if($markingperiod_sdate<=$cddate && $markingperiod_edate>=$cddate){
						?>
					
							<div class="row">
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpmarkingprogress.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Marking Progress</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpattendanceprogess.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Attendance Progress</span></button></a>
							  </div>
						
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpexaminerlist.php"><button type="button" class="btn btn-warning raised-button"><span class="btnText">Examiner List</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpchiefexaminerlist.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Cheif Examiner List</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpmarkingcenterlist.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Marking Center List</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rtpnotexaminerlist.php"><button type="button" class="btn btn-danger raised-button"><span class="btnText">Not Selected Examiners</span></button></a>
							  </div>
							</div>
							
						<?php
						}
						?>
					<?php
					}
					?>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>

