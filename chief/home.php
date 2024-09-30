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
    <title>Application for Marking</title>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
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
                      <h2>Dashboard</h2>
                    </div>
                  </div>
				  <hr>
				  <?php
					if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				  ?>
						<?php
						if($markingperiod_sdate<=$cddate && $markingperiod_edate>=$cddate){
						?>
						
							<?php
							$select1 = "SELECT * FROM markingcenters  WHERE panelNo = '$ses_panelno'";
							$result1 = $conn->query($select1);	
							while($rows1 = $result1->fetch_assoc()){
									$assignpaper_p1 = $rows1['paper1'];  
									$assignpaper_p2 = $rows1['paper2'];   
									$assignpaper_p3 = $rows1['paper3'];   
							}
							
							$select2 = "SELECT SUM(markingprogress.HP1) AS completepaper1,
											   SUM(markingprogress.HP2) AS completepaper2,
											   SUM(markingprogress.HP3) AS completepaper3
												FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																  INNER JOIN markingprogress ON basicdetails.examiner_id=markingprogress.examinerid 
																   WHERE markingcenters.panelNo= '$ses_panelno'";
							$result2 = $conn->query($select2);	
							while($rows2 = $result2->fetch_assoc()){
									$completepaper_p1 = $rows2['completepaper1'];  
									$completepaper_p2 = $rows2['completepaper2'];   
									$completepaper_p3 = $rows2['completepaper3'];   
							}
							$ttassignpaperall=$assignpaper_p1+$assignpaper_p2+$assignpaper_p3; 
							$ttcompletepaperall=$completepaper_p1+$completepaper_p2+$completepaper_p3; 
							
							$ttindipresentage1=($completepaper_p1/$assignpaper_p1)*100;
							$ttindipresentage2=($completepaper_p2/$assignpaper_p2)*100;
							$ttindipresentage3=($completepaper_p3/$assignpaper_p3)*100;
							$ttindipresentageall=($ttcompletepaperall/$ttassignpaperall)*100;
							?>
							<table class="table display" id="example" width="100%">
								<thead>
								  <tr>
									<th colspan="4" align="center"style="color:red;font-weight:bold;">Assinged Papers</th>
									<th colspan="8" align="center" style="color:green;font-weight:bold;">Completed Papers</th>
								  </tr>
								  <tr>
									<th style="color:red;font-weight:bold;">PaperI</th>
									<th style="color:red;font-weight:bold;">PaperII</th>
									<th style="color:red;font-weight:bold;">PaperIII</th>
									<th style="color:red;font-weight:bold;">Total</th>
									
									<th style="color:green;font-weight:bold;">PaperI</th>
									<th style="color:green;font-weight:bold;">PaperI %</th>
									<th style="color:green;font-weight:bold;">PaperII</th>
									<th style="color:green;font-weight:bold;">PaperII %</th>
									<th style="color:green;font-weight:bold;">PaperIII</th>
									<th style="color:green;font-weight:bold;">PaperIII %</th>
									
									<th style="font-size:22px;color:green;font-weight:bold;">All Progress</th>
									<th style="font-size:22px;color:green;font-weight:bold;">All Progress %</th>
								  </tr>
								</thead>
								<tbody>
									<tr>
										<td align="right" style="color:red;font-weight:bold;"><?php echo $assignpaper_p1; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:red;font-weight:bold;"><?php echo $assignpaper_p2; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:red;font-weight:bold;"><?php echo $assignpaper_p3; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:red;font-weight:bold;"><?php echo $ttassignpaperall; ?>&nbsp;&nbsp;</td>
										
										<td align="right" style="color:green;font-weight:bold;"><?php echo $completepaper_p1; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage1; ?>%&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $completepaper_p2; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage2; ?>%&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $completepaper_p3; ?>&nbsp;&nbsp;</td>
										<td align="right" style="color:green;font-weight:bold;"><?php echo $ttindipresentage3; ?>%&nbsp;&nbsp;</td>
										
										<td align="right" style="font-size:22px;color:green;font-weight:bold;"><?php echo $ttcompletepaperall; ?>&nbsp;&nbsp;</td>
										<td align="right" style="font-size:22px;color:green;font-weight:bold;"><?php echo $ttindipresentageall; ?>%&nbsp;&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<div class="row">
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="attendance.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Enter Attendance</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="assignpapers.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Assign Papers</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="markingprogress.php"><button type="button" class="btn btn-danger raised-button"><span class="btnText">Marking Progress</span></button></a>
							  </div>
							</div>
							<div class="row">
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="comments.php"><button type="button" class="btn btn-secondary raised-button"><span class="btnText">Comments</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="appoinmentletters.php"><button type="button" class="btn btn-info raised-button"><span class="btnText">Appointment Letters</span></button></a>
							  </div>
							  <div class="col-sm-12 col-lg-4 mt-4">
								<a href="reports.php"><button type="button" class="btn btn-warning raised-button"><span class="btnText">Reports</span></button></a>
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

