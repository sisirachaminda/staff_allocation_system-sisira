<?php
include 'db-connect.php';
include 'session_handler.php';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
$selectappcall = "SELECT * FROM info WHERE name = 'appCall'";
$resultappcall = $conn->query($selectappcall);	
while($rows = $resultappcall->fetch_assoc()){
        $appcall_sdate = $rows['sdate'];  
        $appcall_edate = $rows['edate'];   
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
    <link rel="stylesheet" href="plugin/font-awesome.min.css">

    <script src="plugins/jquery.min37.js"></script>

    <link rel="stylesheet" href="plugins/css@3.css">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="plugins/ionicons.min.css" rel="stylesheet">
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
				  <?php
					if($resultmarkingend_sdate<=$cddate && $resultmarkingend_edate>=$cddate){
				  ?>
						<?php
						if($appcall_sdate<=$cddate && $appcall_edate>=$cddate){
						?>
						  <div class="row">
							<div class="col-sm-12 col-lg-6 mt-4">
							  <a href="registration1.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Registration for Marking</span></button></a>
							</div>
							<div class="col-sm-12 col-lg-6 mt-4">
							  <a href="registration1.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Edit Application</span></button></a>
							</div>
						  </div>
						<?php
						}
						else{
						?>
							<?php
							$select1 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey' AND year1='$cdyear' AND appStatus='Complete'";
							$result1 = $conn->query($select1);
							if ($result1->num_rows > 0) {
							?>
								<div class="row">
									<div class="col-sm-4 col-lg-4 mt-4">
									   <a href="viewapp1.php"><button type="button" class="btn btn-warning raised-button"><span class="btnText">View Application</span></button></a>
									</div>
									<?php
									$select2 = "SELECT * FROM basicdetails WHERE examiner_id='$ses_ukey' AND year1='$cdyear' AND appoinmentletterdte IS NOT NULL";
									$result2 = $conn->query($select2);
									if ($result2->num_rows > 0) {
										while($row2 = $result2->fetch_assoc()) {
											if($row2['appointedAs'] == 'adchief') {
												$appoint = 'Aditional Chief';
												
												$letterlink="fpdf/adexaminer_appoinment_letter.php?id=".$row2['examiner_id']."";
											} 
											if($row2['appointedAs'] == 'examiner') {
												$appoint = 'Examiner';
												
												$letterlink="fpdf/examiner_appoinment_letter.php?id=".$row2['examiner_id']."";
											}
										}
									?>
									<div class="col-sm-4 col-lg-4 mt-4">
									   <a href="<?php echo $letterlink; ?>"><button type="button" class="btn btn-success raised-button"><span class="btnText">Appoinment Letter</span></button></a>
									</div>
									<?php
									}
									?>
								</div>
								
								<div class="row">
									<div class="col-sm-12 col-lg-12">
									  <h2>Notifiaction</h2>
									</div>
									
									<table class='table pending'>
										<tbody>
										  <?php
											while($rows1 = $result1->fetch_assoc()){
												$pricipleapprove=$rows1['principleApproveStatus'];
												$rejectreason=$rows1['reject_reson'];
												$rejectpanel=$rows1['reject_panel'];
												$manualupdate1=$rows1['manualupdate'];
												$panelNo1=$rows1['panelNo'];
												
												if($rows1['appointedAs'] == 'adchief') {
													$appoint1 = 'Aditional Chief';
												} 
												if($rows1['appointedAs'] == 'examiner') {
													$appoint1 = 'Examiner';
												}
											}
											
											if($panelNo1!=null){
												$select5 = "SELECT * FROM markingcenters WHERE panelNo='$panelNo1'";
												$result5 = $conn->query($select5);
												while($row5 = $result5->fetch_assoc()) {
														$med = $row5['medium'];
														if($med == '2') {
															$medium = 'Sinhala';
														}else if($med == '3') {
															$medium = 'Tamil';
														}else if($med == '4') {
															$medium = 'English';
														}
														$select6="SELECT * FROM school WHERE sc_id='$row5[schoolID]'";
														$result6 = $conn->query($select6);
														while($row6 = $result6->fetch_assoc()) {
															  $school=$row6['sc_id']."-".$row6['schoolname'];
														}
														  
														$select7="SELECT * FROM town WHERE town_id='$row5[townNo]'";
														$result7 = $conn->query($select7);
														while($row7 = $result7->fetch_assoc()) {
															  $town=$row7['town_id']."-".$row7['town_name'];
														}
														  
														$select8="SELECT * FROM subjects WHERE subject_id='$row5[subjectID]'";
														$result8 = $conn->query($select8);
														while($row8 = $result8->fetch_assoc()) {
															  $subject=$row8['subject_name'];
														}
												}
											}
										  ?>
											<?php
											if($manualupdate1==1){
											?>
												<tr>
													<td style="font-weight:bold;background-color:green;color:#ffffff"> You have been manually added as an <?php echo $appoint1; ?>. Your center is <?php echo $school; ?>. Medium : <?php echo $medium; ?> Town : <?php echo $town; ?>  Subject : <?php echo $subject; ?></td>
												</tr>
											<?php
											}
											else{
											?>
												  <?php
													if($pricipleapprove==1){
												  ?>
												  
														<?php
														if($panelNo1!=null){
														?>
														<tr>
															<td style="font-weight:bold;background-color:green;color:#ffffff"> You have been systematically Selected as an <?php echo $appoint1; ?>. Your center is <?php echo $school; ?>. Medium : <?php echo $medium; ?> Town : <?php echo $town; ?>  Subject : <?php echo $subject; ?></td>
														</tr>
														<?php
														}
														?>
														<tr>
															<td style="font-weight:bold;background-color:green;color:#ffffff"> Principle Approved Succssfully</td>
														</tr>
												  <?php
													}
												  ?>
												  
												  <?php
													if($rejectreason!=null){
												  ?>
														<tr>
															<td style="font-weight:bold;background-color:red;color:#ffffff">Rejected Application - <?php echo $rejectpanel; ?> - <?php echo $rejectreason; ?></td>
														</tr>
												  <?php
													}
												  ?>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							<?php
							}
							else{
							?>
								<h2 align="center" style="color:red;font-weight:bold;">Incomplete Application.</h2>
							<?php
							}
							?>
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

