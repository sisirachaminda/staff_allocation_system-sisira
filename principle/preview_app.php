<?php
include 'db-connect.php';
include 'session_handler.php';
include 'cdn.html';

$cddate=date("Y-m-d");
$cdyear=date("Y");

$select8 = "SELECT * FROM declaration WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
$result8 = $conn->query($select8);
while($rows8 = $result8->fetch_assoc()) {
		$bk1=$rows8['sit_exam'];
		$bk2=$rows8['sit_dist'];
		$bk3=$rows8['sit_sub1'];
		$bk4=$rows8['sit_sub2'];
		$bk5=$rows8['sit_sub3'];
		$bk6=$rows8['dis_action'];
		$bk7=$rows8['dib_action'];
		$bk8=$rows8['pvdDetails'];
		$bk9=$rows8['agree'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Application for Marking</title>

     <link rel="stylesheet" href="plugin/font-awesome.min.css">
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
	  title {
		margin:auto;
		text-align: center;
	  }
	  .btn {
		width: 100%;
	  }
	  .accordion-button {
			color:#5a23c8;
	  }
    </style>
	 <link href="plugins/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
	<script>
		$(document).ready(function(){
			$("#show").hide();
			<?php
			if($bk1==1){
			?>
				$("#show").show();
			<?php
			}
			if($bk1==0){
			?>
				$("#show").hide();
			<?php
			}
			?>
        });
	</script>
<?php




if(isset($_POST['btnreject'])) {
	
	if ($stmt = $conn->prepare("UPDATE basicdetails SET principleApproveStatus=0,
														reject_reson='$_POST[rejectreson]', 
														reject_panel='Principle'
														WHERE examiner_id='$_GET[id]' 
														  AND year1='$cdyear'")) {
		$stmt->execute();
		echo "<script>
			alert('Application Rejected')
			window.location.href = 'reqApprove.php';
		</script>";
	}
}
?>
</head>

<body>
<?php include ('header.php'); ?>
<div class="container-fluid">
	<div class="row">
		
    	<?php include ('sidebar.php'); ?>
	
		
		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		<?php
			$select2 = "SELECT * FROM basicdetails WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result2 = $conn->query($select2);
			while($rows2 = $result2->fetch_assoc()) {
					
					$bs1=$rows2['subject']; 
					$bs2=$rows2['medium']; 
					$bs3=$rows2['firstTown']; 
					$bs4=$rows2['secondTown']; 
					$bs5=$rows2['initialName']; 
					$bs6=$rows2['denotedName']; 
					$bs7=$rows2['perAddress']; 
					$bs8=$rows2['email']; 
					$bs9=$rows2['gender'];
					$bs10=$rows2['nic']; 
					$bs11=$rows2['workDistrict'];
					$bs12=$rows2['eduZone']; 
					$bs13=$rows2['school']; 
					$bs14=$rows2['ResiDistrict']; 
					$bs15=$rows2['officeAddress']; 
					$bs16=$rows2['officephone']; 
					$bs17=$rows2['homephone']; 
					$bs18=$rows2['mobilephone']; 
					$bs19=$rows2['dob'];
					$bs20=$rows2['ageAsClose'];
			}
			
			$select3 = "SELECT * FROM servicedetails WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result3 = $conn->query($select3);
			while($rows3 = $result3->fetch_assoc()) {
				
					$be1=$rows3['apoAsTeacher']; 
					$be2=$rows3['designation']; 
					$be3=$rows3['apoAbovePost']; 
					$be4=$rows3['apoAsGraduate']; 
					$be5=$rows3['serviceAsGraduate']; 
					$be6=$rows3['serviceAsDiploma']; 
				
			}
			
			$select4 = "SELECT * FROM proqualifications WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result4 = $conn->query($select4);
			while($rows4 = $result4->fetch_assoc()) {
					$bf1=$rows4['coursetype'];
					$bf2=$rows4['coursefollow1'];
					$bf3=$rows4['year_completed1'];
					$bf4=$rows4['subjects1'];
					$bf5=$rows4['grade1'];
					$bf6=$rows4['institute1'];
					$bf7=$rows4['deploma_follow'];
					$bf8=$rows4['year_diploma'];
					$bf9=$rows4['subjects_diploma'];
					$bf10=$rows4['grade_diploma'];
					$bf11=$rows4['institute_diploma'];
				
			}
			
			
			$select5 = "SELECT * FROM eduqualifications WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result5 = $conn->query($select5);
			while($rows5 = $result5->fetch_assoc()) {
				 
					$bn1=$rows5['degree_follow']; 
					$bn2=$rows5['degree_type'];
					$bn3=$rows5['year_degree'];
					$bn4=$rows5['subjects_degree'];
					$bn5=$rows5['grade_degree'];
					$bn6=$rows5['institute_degree'];
					$bn7=$rows5['pdegree_follow'];
					$bn8=$rows5['year_pdegree'];
					$bn9=$rows5['subjects_pdegree'];
					$bn10=$rows5['grade_pdegree'];
					$bn11=$rows5['institute_pdegree'];
					
			}
			
			
			$select6 = "SELECT * FROM spactivity_schoolsubjectperiod WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result6 = $conn->query($select6);
			while($rows6 = $result6->fetch_assoc()) {
					$br1=$rows6['spactivity']; 
					$br2=$rows6['periods_g12'];
					$br3=$rows6['periods_g13'];
					$br4=$rows6['year_sat'];
					$br5=$rows6['student_sat'];
					$br6=$rows6['student_pass'];
					$br7=$rows6['timetable'];
				
			}
			
			$select7 = "SELECT * FROM experience_selectsubject WHERE examiner_id='$_GET[id]' AND year1='$cdyear'";
			$result7 = $conn->query($select7);
			while($rows7 = $result7->fetch_assoc()) {
					$bu1=$rows7['subject_ex']; 
					$bu2=$rows7['subject_md']; 
					$bu3=$rows7['assi_experince']; 
					$bu4=$rows7['yearLstApoint']; 
					$bu5=$rows7['apointNoast']; 
					$bu6=$rows7['yearAdCheief']; 
					$bu7=$rows7['yearLstAdCheief']; 
					$bu8=$rows7['apointNoAdCheief']; 
					$bu9=$rows7['accept_adex']; 
					
			}
			
			
			
		?>
		
        <div class="col col-12">
			  	<div class="title">
					<h2>Preview Application</h2>
				</div>
          		
				  	<div class="accordion accordion-flush" id="accordionFlushExample">
						<div class="accordion-item">
							<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Basic Details</button>
							</h2>
							<div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="subject">01(a).Subject No & Subject:</label><br>
											<?php
											$select6 = "SELECT * FROM subjects WHERE subject_id='$bs1'";
											$result6 = $conn->query($select6);	
											while($row6=$result6->fetch_assoc()) {
												$sua=$row6['subject_name'];
											}
											?>
											<input class="form-control" class="form-control" type="text" name="subject" id="subject" value="<?php echo $bs1." - ".$sua; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<label for="medium">(b).Medium:</label><br>
											<?php
											if($bs2==2){
												$sua1="Sinhala";
											}
											if($bs2==3){
												$sua1="Tamil";
											}
											if($bs2==4){
												$sua1="English";
											}
											?>
											<input class="form-control" type="text" name="medium" id="medium" value="<?php echo $sua1; ?>" readonly />
										</div>
									</div>
									<div class="form-row" style="text-align:left;">
										<label>02.Area No and area you wish to do marking (Town closest either your place of work or perment residence. Please see the list of areas on last page.) </label>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<?php
											$select8 = "SELECT * FROM town WHERE town_id='$bs3'";
											$result8 = $conn->query($select8);	
											while($row8=$result8->fetch_assoc()) {
												$sua2=$row8['town_name'];
											}
											?>
											<label for="firstTown">(a).First Choice:</label><br>
											<input class="form-control" type="text" name="firstTown" id="firstTown" value="<?php echo $bs3."-".$sua2; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<?php
											$select9 = "SELECT * FROM town WHERE town_id='$bs4'";
											$result9 = $conn->query($select9);	
											while($row9=$result9->fetch_assoc()) {
												$sua3=$row9['town_name'];
											}
											?>
											<label for="secondTown">(b)Second Choice:</label><br>
											<input class="form-control" type="text" name="secondTown" id="secondTown" value="<?php echo $bs4."-".$sua3; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="initialName">03(a).Name with initials:</label>
											<input class="form-control" type="text" name="initialName" id="initialName" value="<?php echo $bs5; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<label for="denotedName">(b).Name denoted by initials</label>
											<input class="form-control" type="text" name="denotedName" id="denotedName" value="<?php echo $bs6; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
											<label for="perAddress">(c).Permenent Address</label>
											<input class="form-control" type="text" name="perAddress" id="perAddress" value="<?php echo $bs7; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-4 mb-3">
											<label for="email">(d).Email Address</label>
											<input class="form-control" type="text" name="email" id="email" value="<?php echo $bs8; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<?php
											if($bs9==0){
												$sua4="Male";
											}
											if($bs9==1){
												$sua4="Female";
											}
											?>
											<label for="gender">(e).Gender</label>
											<input class="form-control" type="text" name="gender" id="gender" value="<?php echo $sua4; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="nic">(f).NIC Number</label>
											<input class="form-control" type="text" name="nic" id="nic" value="<?php echo $bs10; ?>" readonly />
										</div>
									</div>
									<div class="form-row" >
										<label>04.Present working </label>
									</div>
									<div class="form-row">
										<div class="col-md-4 mb-3">
											<?php
											$select12 = "SELECT * FROM district WHERE district_id='$bs11'";
											$result12 = $conn->query($select12);	
											while($row12=$result12->fetch_assoc()) {
												$sua5=$row12['district_name'];
											}
											?>
											<label for="district">(a).District:</label>
											<input class="form-control" type="text" name="district" id="district" value="<?php echo $sua5; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="zone">(b).Education Zone:</label>
											<?php
											$select13 = "SELECT * FROM zonal WHERE zonal_id='$bs12'";
											$result13 = $conn->query($select13);	
											while($row13=$result13->fetch_assoc()) {
												$sua6=$row13['zonal_name'];
											}
											?>
											<input class="form-control" type="text" name="zone" id="zone" value="<?php echo $sua6; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<?php
											$select14 = "SELECT * FROM school WHERE sc_id='$bs13'";
											$result14 = $conn->query($select14);	
											while($row14=$result14->fetch_assoc()) {
												$sua7=$row14['sc_id']." - ".$row14['schoolname'];
											}
											?>
											<label for="school">(c).School:</label>
											<input class="form-control" type="text" name="school" id="school" value="<?php echo $sua7; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="officeAddress">(d).Official Address:</label>
											<input class="form-control" type="text" name="officeAddress" id="officeAddress" value="<?php echo $bs15; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<?php
											$select16 = "SELECT * FROM district WHERE district_id='$bs14'";
											$result16 = $conn->query($select16);	
											while($row16=$result16->fetch_assoc()) {
												$sua8=$row16['district_name'];
											}
											?>
											<label for="ResiDistrict">(e).Residential District:</label>
											<input class="form-control" type="text" name="ResiDistrict" id="ResiDistrict" value="<?php echo $sua8; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-4 mb-3">
											<label for="officephone">Office Telephone No.</label>
											<input class="form-control" type="text" name="officephone" id="officephone" value="<?php echo $bs16; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="homephone">Home Telephone No.</label>
											<input class="form-control" type="text" name="homephone" id="homephone" value="<?php echo $bs17; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="mobilephone">Mobile No</label>
											<input class="form-control" type="text" name="mobilephone" id="mobilephone" value="<?php echo $bs18; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="dob">05(a).Date of Birth:</label>
											<input class="form-control" type="text" name="dob" id="dob" value="<?php echo $bs19; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<label for="ageAsClose">(b).Age as at closing date</label>
											<input class="form-control" type="text" name="ageAsClose" id="ageAsClose" value="<?php echo $bs20; ?>" readonly />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Service Details</button>
							</h2>
							<div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="form-row">
										<div class="col-12">
											<h4></h4>
										</div>
										<hr>
									</div>
									<div class="form-row">
										<div class="col-md-4 mb-3">
											<label for="apoAsTeacher">06.Date of Appointment as a teacher:</label>
											<input class="form-control" type="text" name="apoAsTeacher" id="apoAsTeacher" value="<?php echo $be1; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="designation">7(a).Present Designation(service & grade):</label>
											<?php
											$select10 = "SELECT * FROM designation  WHERE designation_id='$be2'";
											$result10 = $conn->query($select10);	
											while($row10=$result10->fetch_assoc()) {
												$sua9=$row10['designation_name'];
											}
											?>
											<input class="form-control" type="text" name="designation" id="designation" value="<?php echo $sua9; ?>" readonly />
										</div>
										<div class="col-md-4 mb-3">
											<label for="apoAbovePost">(b).Date of Appointment to the above post:</label>
											<input class="form-control" type="text" name="apoAbovePost" id="apoAbovePost" value="<?php echo $be3; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<label for="apoAsGraduate">8(a).Date of Appointment as a graduate/higher deploma teacher:</label>
											<input class="form-control" type="text" name="apoAsGraduate" id="apoAsGraduate" value="<?php echo $be4; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<label for="serviceAsGraduate">(b).Period of service as a graduate/higher deploma teacher(years):</label>
											<input class="form-control" type="text" name="serviceAsGraduate" id="serviceAsGraduate" value="<?php echo $be5; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
											<label for="serviceAsDiploma">09.Period of service as a holder of Diploma/post graduate Diploma in education or similar(years):</label>
											<input class="form-control" type="text" name="serviceAsDiploma" id="serviceAsDiploma" value="<?php echo $be6; ?>" readonly />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Academic and professional qualifications</button>
							</h2>
							<div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo">Trainings (Relevant to the subject )</button>
											<div id="demo" class="accordion-collapse collapse">
												<br>
												<div class="accordion-body">
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<?php
															if($bf1==1){
																$sua10="Higher Edu. Diploma";
															}
															if($bf1==2){
																$sua10="Teachers Training";
															}
															?>
															<label for="courseType">(a).Course Type:</label>
															<input class="form-control" type="text" name="courseType" id="courseType" value="<?php echo $sua10; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="courseFollow">(b).Course Followed:</label>
															<?php
															$select19 = "SELECT * FROM training WHERE training_id='$bf2'";
															$result19 = $conn->query($select19);	
															while($row19=$result19->fetch_assoc()) {
																$sua11=$row19['training_name'];
															}
															?>
															<input class="form-control" type="text" name="courseFollow" id="courseFollow" value="<?php echo $sua11; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="year_completed1">(c).year completed:</label>
															<input class="form-control" type="text" name="year_completed1" id="year_completed1" value="<?php echo $bf3; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="subjects1">(d).subjects:</label>
															<input class="form-control" type="text" name="subjects1" id="subjects1" value="<?php echo $bf4; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="Grade1">(e).Grade:</label>
															<input class="form-control" type="text" name="Grade1" id="Grade1" value="<?php echo $bf5; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="institute1">(f).Institute:</label>
															<input class="form-control" type="text" name="institute1" id="institute1" value="<?php echo $bf6; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo1">Degree(Relevant to the subject)</button>
											<div id="demo1" class="accordion-collapse collapse">
											<br>
												<div class="accordion-body">
													<div class="form-row">
														<?php
														if($bn2==1){
															$sua12="Special Degree";
														}
														if($bn2==2){
															$sua12="General Degree";
														}
														?>
														<div class="col-md-6 mb-3">
															<label for="degree_type">(a).Degree Type:</label>
															<input class="form-control" type="text" name="degree_type" id="degree_type" value="<?php echo $sua12; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<?php
															$select21 = "SELECT * FROM degree WHERE degree_id='$bn1'";
															$result21 = $conn->query($select21);	
															while($row21=$result21->fetch_assoc()) {
																$sua13=$row21['degree_name'];
															}
															?>
															<label for="degree_follow">(b).Name of the Degree:</label>
															<input class="form-control" type="text" name="degree_follow" id="degree_follow" value="<?php echo $sua13; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="year_degree">(c).year completed:</label>
															<input class="form-control" type="text" name="year_degree" id="year_degree" value="<?php echo $bn3; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="subjects_degree">(d).Main subjects:</label>
															<input class="form-control" type="text" name="subjects_degree" id="subjects_degree" value="<?php echo $bn4; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<?php
														if($bn5==1){
															$sua26="First Class";
														}
														if($bn5==2){
															$sua26="Second Class";
														}
														?>
														<div class="col-md-6 mb-3">
															<label for="Grade_degree">(e).Grade:</label>
															<input class="form-control" type="text" name="Grade_degree" id="Grade_degree" value="<?php echo $sua26; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="institute_degree">(f).Institute:</label>
															<input class="form-control" type="text" name="institute_degree" id="institute_degree" value="<?php echo $bn6; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo2">Postgraduate Diploma(Relevant to the subject)</button>
											<div id="demo2" class="accordion-collapse collapse">
											<br>
												<div class="accordion-body">
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<?php
															$select23 = "SELECT * FROM pdeploma WHERE diploma_id='$bf7'";
															$result23 = $conn->query($select23);	
															while($row23=$result23->fetch_assoc()) {
																$sua14=$row23['diploma_name'];
															}
															?>
															<label for="diploma_follow">(a).Name of the Diploma:</label>
															<input class="form-control" type="text" name="diploma_follow" id="diploma_follow" value="<?php echo $sua14; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="year_diploma">(b).year completed:</label>
															<input class="form-control" type="text" name="year_diploma" id="year_diploma" value="<?php echo $bf8; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="subjects_diploma">(c).Main subjects:</label>
															<input class="form-control" type="text" name="subjects_diploma" id="subjects_diploma" value="<?php echo $bf9; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="Grade_diploma">(d).Grade:</label>
															<input class="form-control" type="text" name="Grade_diploma" id="Grade_diploma" value="<?php echo $bf10; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-12 mb-3">
															<label for="institute_diploma">(e).Institute:</label>
															<input class="form-control" type="text" name="institute_diploma" id="institute_diploma" value="<?php echo $bf11; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo3">Postgraduate Degree(Relevant to the subject)</button>
											<div id="demo3" class="accordion-collapse collapse">
											<br>
												<div class="accordion-body">
													<div class="form-row">	
														<div class="col-md-6 mb-3">
															<?php
															$select25 = "SELECT * FROM pdegree WHERE pdegree_id='$bn7'";
															$result25 = $conn->query($select25);	
															while($row25=$result25->fetch_assoc()) {
																$sua15=$row25['pdegree_name'];
															}
															?>
															<label for="pdegree_follow">(a).Name of the Postgraduate Degree:</label>
															<input class="form-control" type="text" name="pdegree_follow" id="pdegree_follow" value="<?php echo $sua15; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="year_pdegree">(b).year completed:</label>
															<input class="form-control" type="text" name="year_pdegree" id="year_pdegree" value="<?php echo $bn8; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="subjects_pdegree">(c).Main subjects:</label>
															<input class="form-control" type="text" name="subjects_pdegree" id="subjects_pdegree" value="<?php echo $bn9; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="Grade_pdegree">(d).Grade:</label>
															<input class="form-control" type="text" name="Grade_pdegree" id="Grade_pdegree" value="<?php echo $bn10; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-12 mb-3">
															<label for="institute_pdegree">(e).Institute:</label>
															<input class="form-control" type="text" name="institute_pdegree" id="institute_pdegree" value="<?php echo $bn11; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo4">Special Quailifications(Relevant to the subject)</button>
											<div id="demo4" class="accordion-collapse collapse">
												<br>
												<div class="accordion-body">
													<div class="form-row">
														<?php
														$select27 = "SELECT * FROM activity WHERE activity_id='$br1'";
														$result27 = $conn->query($select27);	
														while($row27=$result27->fetch_assoc()) {
															$sua16=$row27['activity_name'];
														}
														?>
														<div class="col-md-12 mb-3">
															<label for="sp_activity">Activity</label>
															<input class="form-control" type="text" name="sp_activity" id="sp_activity" value="<?php echo $sua16; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo5">Time table details(Relevant to the subject)</button>
											<div id="demo5" class="accordion-collapse collapse">
												<br>
												<div class="accordion-body">
													<div class="form-row">
														<div class="col-md-12 mb-3" style="text-align:left;">
															<label>(a).No of Periods you teach the applied subject in G.C.E(A/L) clases per week</label>
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="Grade12">Grade 12:</label>
															<input class="form-control" type="text" name="Grade12" id="Grade12" value="<?php echo $br2; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="Grade13">Grade 13:</label>
															<input class="form-control" type="text" name="Grade13" id="Grade13" value="<?php echo $br3; ?>" readonly />
														</div>
													</div>
													 <div class="col-md-12 mb-3" style="text-align:left;">
														<?php
															$imgpath="../examiner/uploads/".$br7;
														?>
														<img src="<?php echo $imgpath; ?>" width="100%" height="390px">
													
													</div>
													<div class="form-row">
														<div class="col-md-4 mb-3">
															<label for="year_sat">Year:</label>
															<input class="form-control" type="text" name="year_sat" id="year_sat" value="<?php echo $br4; ?>" readonly />
														</div>
														<div class="col-md-4 mb-3">
															<label for="student_sat">No of Students Sat:</label>
															<input class="form-control" type="text" name="student_sat" id="student_sat" value="<?php echo $br5; ?>" readonly />
														</div>
														<div class="col-md-4 mb-3">
															<label for="student_pass">No of Students Passed:</label>
															<input class="form-control" type="text" name="student_pass" id="student_pass" value="<?php echo $br6; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-item">
											<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo6">Experince in Evaluation of selected subject</button>
											<div id="demo6" class="accordion-collapse collapse">
												<br>
												<div class="accordion-body">
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<?php
															$select29 = "SELECT * FROM subjects WHERE subject_id='$bu1'";
															$result29 = $conn->query($select29);	
															while($row29=$result29->fetch_assoc()) {
																$sua17=$row29['subject_id'] ."-". $row29['subject_name'];
															}
															?>
															<label for="subject_ex">(a).subject:</label>
															<input class="form-control" type="text" name="subject_ex" id="subject_ex" value="<?php echo $sua17; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<?php
															if($bu2==2){
																$sua18="Sinhala";
															}
															if($bu2==3){
																$sua18="Tamil";
															}
															if($bu2==4){
																$sua18="English";
															}
															?>
															<label for="subject_md">(b).Medium:</label>
															<input class="form-control" type="text" name="subject_md" id="subject_md" value="<?php echo $sua18; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="ass_experince">(c).No Years Experince as Assistant Examiner:</label>
															<input class="form-control" type="text" name="ass_experince" id="ass_experince" value="<?php echo $bu3; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="yearLstApoint">(d)Year of Last appointment(Assistant Examiner):</label>
															<input class="form-control" type="text" name="yearLstApoint" id="yearLstApoint" value="<?php echo $bu4; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="apointNoast">(e)Appointment No as Assistant Examiner:</label>
															<input class="form-control" type="text" name="apointNoast" id="apointNoast" value="<?php echo $bu5; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="yearAdCheief">(f).No Years Experince as Additional cheief Examiner:</label>
															<input class="form-control" type="text" name="yearAdCheief" id="yearAdCheief" value="<?php echo $bu6; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<label for="yearLstAdCheief">(g)Year of Last appointment(Additional cheief Examiner):</label>
															<input class="form-control" type="text" name="yearLstAdCheief" id="yearLstAdCheief" value="<?php echo $bu7; ?>" readonly />
														</div>
													</div>
													<div class="form-row">
														<div class="col-md-6 mb-3">
															<label for="apointNoAdCheief">(h)Appointment No as Additional cheief Examiner:</label>
															<input class="form-control" type="text" name="apointNoAdCheief" id="apointNoAdCheief" value="<?php echo $bu8; ?>" readonly />
														</div>
														<div class="col-md-6 mb-3">
															<?php
																if($bu9==1){
																	$sua19="Yes";
																}
																if($bu9==0){
																	$sua19="No";
																}
															?>
															<label for="accept_adex">12(ii).Would you like to accept apointment as an Additional Cheief Examiner(If Selected):</label>
															<input class="form-control" type="text" name="accept_adex" id="accept_adex" value="<?php echo $sua19; ?>" readonly />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">Declaration</button>
							</h2>
							<div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<?php
											if($bk1==1){
												$sua20="Yes";
											}
											if($bk1==0){
												$sua20="No";
											}
											?>
											<label for="sit_exam">13.Is a family member or a resident of your house expected to sit the above examination this year?</label>
											<input class="form-control" type="text" name="" id="" value="<?php echo $sua20; ?>" readonly />
										</div>
									</div>
									<div id="show">
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<?php
												$select17 = "SELECT * FROM district WHERE district_id='$bk2'";
												$result17 = $conn->query($select17);	
												while($row17=$result17->fetch_assoc()) {
													$sua21=$row17['district_name'];
												}
												?>
												<label for="sit_dist">(a).Ditrict</label>
												<input class="form-control" type="text" name="sit_dist" id="sit_dist" value="<?php echo $sua21; ?>" readonly />
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<?php
												$select19 = "SELECT * FROM subjects WHERE subject_id='$bk3'";
												$result19 = $conn->query($select19);	
												while($row19=$result19->fetch_assoc()) {
													$sua22=$row19['subject_name'];
												}
												?>
												<label for="sit_sub1">First Subject</label>
												<input class="form-control" type="text" name="sit_sub1" id="sit_sub1" value="<?php echo $sua22; ?>" readonly />
											</div>
											<div class="col-md-4 mb-3">
												<?php
												$select21 = "SELECT * FROM subjects WHERE subject_id='$bk4'";
												$result21 = $conn->query($select21);	
												while($row21=$result21->fetch_assoc()) {
													$sua23=$row21['subject_name'];
												}
												?>
												<label for="sit_sub2">Second Subject</label>
												<input class="form-control" type="text" name="sit_sub2" id="sit_sub2" value="<?php echo $sua23; ?>" readonly />
											</div>
											<div class="col-md-4 mb-3">
												<?php
												$select23 = "SELECT * FROM subjects WHERE subject_id='$bk5'";
												$result23 = $conn->query($select23);	
												while($row23=$result23->fetch_assoc()) {
													$sua24=$row23['subject_name'];
												}
												?>
												<label for="sit_sub3">Third Subject</label>
												<input class="form-control" type="text" name="sit_sub3" id="sit_sub3" value="<?php echo $sua24; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
											<?php
											if($bk6==1){
												$sua25="Yes";
											}
											if($bk6==0){
												$sua25="No";
											}
											?>
											<label for="dis_action">14(i). Is any disciplinary inquiry against you in progress:</label>
											<input class="form-control" type="text" name="dis_action" id="dis_action" value="<?php echo $sua25; ?>" readonly />
										</div>
										<div class="col-md-6 mb-3">
											<?php
											if($bk7==1){
												$sua25="Yes";
											}
											if($bk7==0){
												$sua25="No";
											}
											?>
											<label for="dib_action">(ii). Are you debarred from examination duties:</label>
											<input class="form-control" type="text" name="dib_action" id="dib_action" value="<?php echo $sua25; ?>" readonly />
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
											<label for="pvdDetails">(iii)If yes, Provide details:</label>
											<input class="form-control" type="text" name="pvdDetails" id="pvdDetails" value="<?php echo $bk8; ?>" readonly />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
	</div>
	<script src='plugins/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='plugins/jquery.easing.min.js'></script>
      <script src='plugins/intlTelInput.js'></script>
      <script src='plugins/popper.min.js'></script>
      <script src='plugins/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>
	</main>
</div>
</body>
</html>