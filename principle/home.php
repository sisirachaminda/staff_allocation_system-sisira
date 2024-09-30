<?php
include 'db-connect.php';
include 'session_handler.php';
include 'cdn.html';

$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
$selectprincipleapprove = "SELECT * FROM info WHERE name = 'principleapprove'";
$resultprincipleapprove = $conn->query($selectprincipleapprove);	
while($rows = $resultprincipleapprove->fetch_assoc()){
        $principleapprove_sdate = $rows['sdate'];  
        $principleapprove_edate = $rows['edate'];   
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
    <title>Application for Marking</title>
    <link rel="stylesheet" href="plugins/css@3.css">
	<link rel="stylesheet" href="plugin/font-awesome.min.css">
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
                      <div class="col-sm-12 col-lg-12">
                        <h2>Dashboard</h2>
                      </div>
                    </div>
				   <?php
					if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				   ?>
					   <?php
						if($principleapprove_sdate<=$cddate && $principleapprove_edate>=$cddate){
					   ?>
							<div class="row">
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="reqapprove.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Approve Requests</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="examinerlist.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Examiner List</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rejectedlist.php"><button type="button" class="btn btn-danger raised-button"><span class="btnText">Rejected List</span></button></a>
							  </div>
							</div>
						<?php
						}
						else{
						?>
							<div class="row">
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="examinerlist.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Examiner List</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="appoinmentletters.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Appoinment Letters</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="rejectedlist.php"><button type="button" class="btn btn-danger raised-button"><span class="btnText">Rejected List</span></button></a>
							  </div>
							</div>
						<?php
						}
						?>
					<?php
					}
					else{
					?>
						<div class="row">
								<div class="col-sm-12 col-lg-12 mt-4">
								  <h2 align="center" style="color:red;font-weight:bold;">This year marks are over.</h2>
								</div>
						</div>
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

