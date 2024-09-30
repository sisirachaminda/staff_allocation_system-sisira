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
                      <h2>Dashboard</h2>
                    </div>
                  </div>
				  <hr>
				  <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <h4>Current Status - <?php echo $cddate; ?></h4>
                    </div>
                  </div>
						<div class="row">
							<div class="col-sm-12 col-lg-12 mt-4">
								<div id="chart-container">FusionCharts will render here</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12 col-lg-8 mt-4">
								<div class="card">
									<div class="card-body" style="background-color:blue; color:#ffffff">
										<h1 class="btnText">Status Of Panels</h1>
										<table class="table" width="100%" border="1">
											<thead>
												<th> Subject</th>
												<th> Medium</th>
												<th> Panels</th>
												<th> Cheif Examiners</th>
												<th> Examiners</th>
											</thead>
											
												<?php
												$allnf_center=0;
												$allnf_chiefex=0;
												$allnf_ex=0;
												
												$select1 = "SELECT * FROM subjects";
												$result1 = $conn->query($select1);	
												while($rows1 = $result1->fetch_assoc()){
													
													$select5 = "SELECT DISTINCT(medium) AS dismedium FROM markingcenters WHERE subjectID='$rows1[subject_id]'";
													$result5 = $conn->query($select5);	
													while($rows5 = $result5->fetch_assoc()){
														$i=$rows5['dismedium'];
																											
														if($i==2){
															$medium1="Sinhala";
														}
														if($i==3){
															$medium1="Tamil";
														}
														if($i==4){
															$medium1="English";
														}
														
														$nf_center=0;
														$nf_chiefex=0;
														$nf_ex=0;
														
														$select2="SELECT * FROM markingcenters WHERE subjectID='$rows1[subject_id]' AND medium='$i'";
														$result2 = $conn->query($select2);
														$nf_center=$result2->num_rows;
														
														$select3="SELECT * FROM chiefdetails INNER JOIN markingcenters ON chiefdetails.panelno=markingcenters.panelNo 
																								   WHERE markingcenters.subjectID='$rows1[subject_id]'
																								    AND markingcenters.medium='$i'";
														$result3 = $conn->query($select3);
														$nf_chiefex=$result3->num_rows;
														
														$select4="SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																								   WHERE markingcenters.subjectID='$rows1[subject_id]'
																								    AND markingcenters.medium='$i'
																									AND basicdetails.panelNo IS NOT NULL";
														$result4 = $conn->query($select4);
														$nf_ex=$result4->num_rows;
														
														echo "<tr>
															<td>".$rows1['subject_name']."</td>
															<td>".$medium1."</td>
															<td align='center'>".number_format($nf_center,0)."</td>
															<td align='center'>".number_format($nf_chiefex,0)."</td>
															<td align='center'>".number_format($nf_ex,0)."</td>
														</tr>";
														
														$allnf_center+=$nf_center;
														$allnf_chiefex+=$nf_chiefex;
														$allnf_ex+=$nf_ex;
													}
												}
												
												echo "<tr style='font-weight:bold;'>
														<td colspan='2'>Total</td>
														<td align='center'>".number_format($allnf_center,0)."</td>
														<td align='center'>".number_format($allnf_chiefex,0)."</td>
														<td align='center'>".number_format($allnf_ex,0)."</td>
												</tr>";
												?>
										</table>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-4 mt-4">
								<div class="card">
									<div class="card-body" style="background-color:green; color:#ffffff">
										<h1 class="btnText">Attendance - <?php echo $cddate; ?></h1>
										<table class="table" width="100%" border="1">
											<thead>
												<th> Subject</th>
												<th> Medium</th>
												<th> %</th>
												
											</thead>
											
												<?php
												$allnf_attendance=0;
												$allnf_allexaminer=0;
												
												$select7 = "SELECT * FROM subjects";
												$result7 = $conn->query($select1);	
												while($rows7 = $result7->fetch_assoc()){
													
													$select6 = "SELECT DISTINCT(medium) AS dismedium FROM markingcenters WHERE subjectID='$rows7[subject_id]'";
													$result6 = $conn->query($select6);	
													while($rows6 = $result6->fetch_assoc()){
														$i1=$rows6['dismedium'];
																											
														if($i1==2){
															$medium1="Sinhala";
														}
														if($i1==3){
															$medium1="Tamil";
														}
														if($i1==4){
															$medium1="English";
														}
														
														$nf_attendance=0;
														$nf_allexaminer=0;
														
														$select9="SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																								   WHERE markingcenters.subjectID='$rows7[subject_id]'
																								    AND markingcenters.medium='$i1'
																									AND basicdetails.panelNo IS NOT NULL";
														$result9 = $conn->query($select9);
														$nf_allexaminer=$result9->num_rows;
														
														$select8="SELECT * FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																							 INNER JOIN exattendance ON basicdetails.examiner_id=exattendance.examinerid 
																								   WHERE markingcenters.subjectID='$rows7[subject_id]'
																								    AND markingcenters.medium='$i1'
																									AND exattendance.date='$cddate'
																									AND exattendance.attendance=1";
														$result8 = $conn->query($select8);
														$nf_attendance=$result8->num_rows;
														
														if($nf_attendance>0){
															$presentage=($nf_attendance/$nf_allexaminer)*100;
														}
														else{
															$presentage=0;
														}
														
														echo "<tr>
															<td>".$rows7['subject_name']."</td>
															<td>".$medium1."</td>
															<td>".number_format($presentage,2)."%</td>
														</tr>";
														
														$allnf_attendance+=$nf_allexaminer;
														$allnf_allexaminer+=$nf_attendance;
													}
												}
												
												$allnf_attpresentage=($allnf_allexaminer/$allnf_attendance)*100;
												
												echo "<tr style='font-weight:bold;'>
														<td colspan='2'>Total</td>
														<td align='center'>".number_format($allnf_attpresentage,2)."%</td>
												</tr>";
												?>
											
										</table>
									</div>
								</div>
							</div>
							
						</div>
						
						
						<div class="row">
							<div class="col-sm-12 col-lg-12 mt-4">
								
									<div class="card">
										<div class="card-body" style="background-color:orange; color:#ffffff">
											<h1 class="btnText">Marking Progress</h1>
											<table class="table" width="100%" border="1">
												<thead>
													<tr>
														<th rowspan="2"> Subject</th>
														<th rowspan="2"> Medium</th>
														<th colspan="4" align="center" style="color:red;"> All Papers</th>
														<th colspan="4" align="center" style="color:green;"> Complete Papers</th>
													</tr>
													<tr>
														<th style="color:red;"> Paper I</th>
														<th style="color:red;"> Paper II</th>
														<th style="color:red;"> Paper III</th>
														<th style="color:red;"> Total</th>
														<th style="color:green;"> Paper I</th>
														<th style="color:green;"> Paper II</th>
														<th style="color:green;"> Paper III</th>
														<th style="color:green;"> Total</th>
													</tr>
												</thead>
												
													<?php
													$all_ttassignpaper1=0;
													$all_ttassignpaper2=0;
													$all_ttassignpaper3=0;
													$all_ttassignpaperall=0;
													
													$all_ttcompletepaper1=0;
													$all_ttcompletepaper2=0;
													$all_ttcompletepaper3=0;
													$all_ttcompletepaperall=0;
													
													
													$select10 = "SELECT * FROM subjects";
													$result10 = $conn->query($select1);	
													while($rows10 = $result10->fetch_assoc()){
														
														$select11 = "SELECT DISTINCT(medium) AS dismedium FROM markingcenters WHERE subjectID='$rows10[subject_id]'";
														$result11 = $conn->query($select11);	
														while($rows11 = $result11->fetch_assoc()){
															$i2=$rows11['dismedium'];
																											
															if($i2==2){
																$medium2="Sinhala";
															}
															if($i2==3){
																$medium2="Tamil";
															}
															if($i2==4){
																$medium2="English";
															}
															
															$ttindipresentage1=0;
															$ttindipresentage2=0;
															$ttindipresentage3=0;
															$ttindipresentageall=0;
															
															$ttassignpaper1=0;
															$ttassignpaper2=0;
															$ttassignpaper3=0;
															$ttassignpaperall=0;
															
															$select12="SELECT SUM(paper1) AS assignpaper1,
																			  SUM(paper2) AS assignpaper2,
																			  SUM(paper3) AS assignpaper3 
																			  FROM markingcenters WHERE subjectID='$rows10[subject_id]'
																									AND medium='$i2'";
															$result12 = $conn->query($select12);
															while($rows12 = $result12->fetch_assoc()){
																$ttassignpaper1=$rows12['assignpaper1'];
																$ttassignpaper2=$rows12['assignpaper2'];;
																$ttassignpaper3=$rows12['assignpaper3'];;
															}
															
															$ttassignpaperall=$ttassignpaper1+$ttassignpaper2+$ttassignpaper3;
															
															
															$ttcompletepaper1=0;
															$ttcompletepaper2=0;
															$ttcompletepaper3=0;
															$ttcompletepaperall=0;
															
															$select13="SELECT SUM(markingprogress.HP1) AS completepaper1,
																			  SUM(markingprogress.HP2) AS completepaper2,
																			  SUM(markingprogress.HP3) AS completepaper3
																								  FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																													INNER JOIN markingprogress ON basicdetails.examiner_id=markingprogress.examinerid 
																														   WHERE markingcenters.subjectID='$rows10[subject_id]'
																															AND markingcenters.medium='$i2'";
															$result13 = $conn->query($select13);
															while($rows13 = $result13->fetch_assoc()){
																$ttcompletepaper1=$rows13['completepaper1'];
																$ttcompletepaper2=$rows13['completepaper2'];
																$ttcompletepaper3=$rows13['completepaper3'];
															}
															
															$ttcompletepaperall=$ttcompletepaper1+$ttcompletepaper2+$ttcompletepaper3;
															
															$ttindipresentage1=($ttcompletepaper1/$ttassignpaper1)*100;
															$ttindipresentage2=($ttcompletepaper2/$ttassignpaper2)*100;
															$ttindipresentage3=($ttcompletepaper3/$ttassignpaper3)*100;
															$ttindipresentageall=($ttcompletepaperall/$ttassignpaperall)*100;
															
															echo "<tr>
																<td>".$rows10['subject_name']."</td>
																<td>".$medium2."</td>
																<td>".number_format($ttassignpaper1,0)."</td>
																<td>".number_format($ttassignpaper2,0)."</td>
																<td>".number_format($ttassignpaper3,0)."</td>
																<td>".number_format($ttassignpaperall,0)."</td>
																<td>".number_format($ttcompletepaper1,0)." - ".$ttindipresentage1."%</td>
																<td>".number_format($ttcompletepaper2,0)." - ".$ttindipresentage2."%</td>
																<td>".number_format($ttcompletepaper3,0)." - ".$ttindipresentage3."%</td>
																<td>".number_format($ttcompletepaperall,0)." - ".$ttindipresentageall."%</td>
																
															</tr>";
															
															$all_ttassignpaper1+=$ttassignpaper1;
															$all_ttassignpaper2+=$ttassignpaper2;
															$all_ttassignpaper3+=$ttassignpaper3;
															$all_ttassignpaperall+=$ttassignpaperall;
															
															$all_ttcompletepaper1+=$ttcompletepaper1;
															$all_ttcompletepaper2+=$ttcompletepaper2;
															$all_ttcompletepaper3+=$ttcompletepaper3;
															$all_ttcompletepaperall+=$ttcompletepaperall;
														}
													}
													
													$all_ttindipresentage1=($all_ttcompletepaper1/$all_ttassignpaper1)*100;
													$all_ttindipresentage2=($all_ttcompletepaper2/$all_ttassignpaper2)*100;
													$all_ttindipresentage3=($all_ttcompletepaper3/$all_ttassignpaper3)*100;
													$all_ttindipresentageall=($all_ttcompletepaperall/$all_ttassignpaperall)*100;
													echo "<tr style='font-weight:bold;'>
															<td colspan='2'>Total</td>
															<td align='center'>".$all_ttassignpaper1."</td>
															<td align='center'>".$all_ttassignpaper2."</td>
															<td align='center'>".$all_ttassignpaper3."</td>
															<td align='center'>".$all_ttassignpaperall."</td>
															<td align='center'>".$all_ttcompletepaper1."  - ".number_format($all_ttindipresentage1,1)."%</td>
															<td align='center'>".$all_ttcompletepaper2."  - ".number_format($all_ttindipresentage2,1)."%</td>
															<td align='center'>".$all_ttcompletepaper3."  - ".number_format($all_ttindipresentage3,1)."%</td>
															<td align='center'>".$all_ttcompletepaperall."  - ".number_format($all_ttindipresentageall,1)."%</td>
														</tr>";
													?>
												
											</table>
										</div>
									</div>
								
							</div>
							
						</div>
                </div>
              </div>
            </div>
          </div>
		  
		 <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
   
		  <script>
	
				FusionCharts.ready(function(){
					var chartObj = new FusionCharts({
						type: 'column3d',
						renderAt: 'chart-container',
						width: '100%',
						height: '500',
						dataFormat: 'json',
						dataSource: {
							"chart": {
								"caption": "Marking Progress",
								"xAxisName": "Subject",
								"yAxisName": "presentage (%)",
								"theme": "fusion"
							},
							"data": [
								<?php
								
								$select20 = "SELECT * FROM subjects";
								$result20 = $conn->query($select20);	
								while($rows20 = $result20->fetch_assoc()){
									
									$select21 = "SELECT DISTINCT(medium) AS dismedium FROM markingcenters WHERE subjectID='$rows20[subject_id]'";
									$result21 = $conn->query($select21);	
									while($rows21 = $result21->fetch_assoc()){
										$f2=$rows21['dismedium'];
																						
										if($f2==2){
											$mediumr2="Sinhala";
										}
										if($f2==3){
											$mediumr2="Tamil";
										}
										if($f2==4){
											$mediumr2="English";
										}
										
										
										$ttindipresentagealln=0;
										
										$ttassignpapern1=0;
										$ttassignpapern2=0;
										$ttassignpapern3=0;
										$ttassignpaperalln=0;
										
										$select22="SELECT SUM(paper1) AS assignpaper1,
														  SUM(paper2) AS assignpaper2,
														  SUM(paper3) AS assignpaper3 
														  FROM markingcenters WHERE subjectID='$rows20[subject_id]'
																				AND medium='$f2'";
										$result22 = $conn->query($select22);
										while($rows22 = $result22->fetch_assoc()){
											$ttassignpapern1=$rows22['assignpaper1'];
											$ttassignpapern2=$rows22['assignpaper2'];;
											$ttassignpapern3=$rows22['assignpaper3'];;
										}
										
										$ttassignpaperalln=$ttassignpapern1+$ttassignpapern2+$ttassignpapern3;
										
										
										$ttcompletepapern1=0;
										$ttcompletepapern2=0;
										$ttcompletepapern3=0;
										$ttcompletepaperalln=0;
										
										$select13="SELECT SUM(markingprogress.HP1) AS completepaper1,
														  SUM(markingprogress.HP2) AS completepaper2,
														  SUM(markingprogress.HP3) AS completepaper3
																			  FROM basicdetails INNER JOIN markingcenters ON basicdetails.panelNo=markingcenters.panelNo 
																								INNER JOIN markingprogress ON basicdetails.examiner_id=markingprogress.examinerid 
																									   WHERE markingcenters.subjectID='$rows20[subject_id]'
																										AND markingcenters.medium='$f2'";
										$result13 = $conn->query($select13);
										while($rows13 = $result13->fetch_assoc()){
											$ttcompletepapern1=$rows13['completepaper1'];
											$ttcompletepapern2=$rows13['completepaper2'];
											$ttcompletepapern3=$rows13['completepaper3'];
										}
										
										$ttcompletepaperalln=$ttcompletepapern1+$ttcompletepapern2+$ttcompletepapern3;
										
										
										$ttindipresentagealln=($ttcompletepaperalln/$ttassignpaperalln)*100;
								?>
								{
									"label": "<?php echo $rows20['subject_name']."-".$mediumr2; ?>",
									"value": "<?php echo number_format($ttindipresentagealln,0); ?>"
								},
								<?php
									}
								}
								?>
							],
							"trendlines": [{
								"line": [{
								  "startvalue": "100",
								  "valueOnRight": "1"
								  
								}]
							}]
						}
					});
					chartObj.render();
				});
			
			</script>
        </main>
      </div>
    </div>
  </body>
</html>

