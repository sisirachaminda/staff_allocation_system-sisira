<?php
include 'session_handler.php';
include 'db-connect.php';
include 'cdn.html';
$cddate=date("Y-m-d");
$cdyear=date("Y");
?>

<?php
if(isset($_POST['btn_apppart3'])){
	
	$courseType = $_POST['courseType'];
	$courseFollow1 = $_POST['courseFollow'];
	$year_completed1 = $_POST['year_completed1'];
	$subjects1 = $_POST['subjects1'];
	$Grade1 = $_POST['Grade1'];
	$institute1 = $_POST['institute1'];
	
	$diploma_follow = $_POST['diploma_follow'];
	$year_diploma = $_POST['year_diploma'];
	$subjects_diploma = $_POST['subjects_diploma'];
	$Grade_diploma = $_POST['Grade_diploma'];
	$institute_diploma = $_POST['institute_diploma'];
	
	$degree_type = $_POST['degree_type'];
	$degree_follow = $_POST['degree_follow'];
	$year_degree = $_POST['year_degree'];
	$subjects_degree = $_POST['subjects_degree'];
	$Grade_degree = $_POST['Grade_degree'];
	$institute_degree = $_POST['institute_degree'];
	
	$pdegree_follow = $_POST['pdegree_follow'];
	$year_pdegree = $_POST['year_pdegree'];
	$subjects_pdegree = $_POST['subjects_pdegree'];
	$Grade_pdegree = $_POST['Grade_pdegree'];
	$institute_pdegree = $_POST['institute_pdegree'];
	
	$sp_activity = $_POST['sp_activity'];
	$Grade12 = $_POST['Grade12'];
	$Grade13 = $_POST['Grade13'];
	$timetablePath = $_POST["timetable"];
	$year_sat = $_POST['year_sat'];
	$student_sat = $_POST['student_sat'];
	$student_pass = $_POST['student_pass'];
	
	$subject_ex = $_POST['subject_ex'];
	$subject_md = $_POST['subject_md'];
	$ass_experince = $_POST['ass_experince'];
	$yearLstApoint = $_POST['yearLstApoint'];
	$apointNoast = $_POST['apointNoast'];
	$yearAdCheief = $_POST['yearAdCheief'];
	$yearLstAdCheief = $_POST['yearLstAdCheief'];
	$apointNoAdCheief = $_POST['apointNoAdCheief'];
	$accept_adex = $_POST['accept_adex'];
	
	

	$select1 = "SELECT * FROM proqualifications WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
	$result1 = $conn->query($select1);
	if ($result1->num_rows == 0) {
	
			if($stmt = $conn->prepare("INSERT INTO proqualifications (examiner_id,
															  year1, 
															  coursetype, 
															  coursefollow1,
															  year_completed1,
															  subjects1,
															  grade1,
															  institute1,
															  deploma_follow,
															  year_diploma,
															  subjects_diploma,
															  grade_diploma,
															  institute_diploma) 
															  VALUES (
															  '$ses_ukey',
															  '$cdyear',
															  '$courseType',
															  '$courseFollow1',
															  '$year_completed1',
															  '$subjects1',
															  '$Grade1',
															  '$institute1',
															  '$diploma_follow',
															  '$year_diploma',
															  '$subjects_diploma',
															  '$Grade_diploma',
															  '$institute_diploma'
															  )")){
			$stmt->execute();
			
			
		}
		
	}
	else{
		if ($stmt = $conn->prepare("UPDATE proqualifications SET coursetype='$courseType', 
																 coursefollow1='$courseFollow1',
																 year_completed1='$year_completed1',
																 subjects1='$subjects1',
																 grade1='$Grade1',
																 institute1='$institute1',
																 deploma_follow='$diploma_follow',
																 year_diploma='$year_diploma',
																 subjects_diploma='$subjects_diploma',
																 grade_diploma='$Grade_diploma',
																 institute_diploma='$institute_diploma'
														WHERE examiner_id='$ses_ukey' AND
															  year1='$cdyear'")) {
			$stmt->execute();
			
		}
	}
	
	
	
	$select12 = "SELECT * FROM eduqualifications WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
	$result12 = $conn->query($select12);
	if ($result12->num_rows == 0) {
			
			if($stmt1 = $conn->prepare("INSERT INTO eduqualifications (examiner_id,
															  year1, 
															  degree_follow, 
															  degree_type,
															  year_degree,
															  subjects_degree,
															  grade_degree,
															  institute_degree,
															  pdegree_follow,
															  year_pdegree,
															  subjects_pdegree,
															  grade_pdegree,
															  institute_pdegree
															  ) 
															  VALUES (
															  '$ses_ukey',
															  '$cdyear',
															  '$degree_follow',
															  '$degree_type',
															  '$year_degree',
															  '$subjects_degree',
															  '$Grade_degree',
															  '$institute_degree',
															  '$pdegree_follow',
															  '$year_pdegree',
															  '$subjects_pdegree',
															  '$Grade_pdegree',
															  '$institute_pdegree'
															  )")){
			$stmt1->execute();
		}
	}
	else{
		if ($stmt1 = $conn->prepare("UPDATE eduqualifications SET degree_follow='$degree_follow', 
																 degree_type='$degree_type',
																 year_degree='$year_degree',
																 subjects_degree='$subjects_degree',
																 grade_degree='$Grade_degree',
																 institute_degree='$institute_degree',
																 pdegree_follow='$pdegree_follow',
																 year_pdegree='$year_pdegree',
																 subjects_pdegree='$subjects_pdegree',
																 grade_pdegree='$Grade_pdegree',
																 institute_pdegree='$institute_pdegree'
														WHERE examiner_id='$ses_ukey' AND
															  year1='$cdyear'")) {
			$stmt1->execute();
			
		}
	}
	

	$select13 = "SELECT * FROM spactivity_schoolsubjectperiod WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
	$result13 = $conn->query($select13);
	if ($result13->num_rows == 0) {	
			
			if ($stmt2 = $conn->prepare("INSERT INTO spactivity_schoolsubjectperiod (examiner_id,
															  year1, 
															  spactivity, 
															  periods_g12,
															  periods_g13,
															  year_sat,
															  student_sat,
															  student_pass) 
															  VALUES (
															  '$ses_ukey',
															  '$cdyear',
															  '$sp_activity',
															  '$Grade12',
															  '$Grade13',
															  '$year_sat',
															  '$student_sat',
															  '$student_pass'
															  )")){
				$stmt2->execute();
			}
	}
	else{
		
			if ($stmt2 = $conn->prepare("UPDATE spactivity_schoolsubjectperiod SET spactivity='$sp_activity', 
																	 periods_g12='$Grade12',
																	 periods_g13='$Grade13',
																	 timetable='$timetablePath',
																	 year_sat='$year_sat',
																	 student_sat='$student_sat',
																	 student_pass='$student_pass'
															WHERE examiner_id='$ses_ukey' AND
																  year1='$cdyear'")) {
				$stmt2->execute();
				
			}
	}
	
	$select14 = "SELECT * FROM experience_selectsubject WHERE examiner_id='$ses_ukey' AND year1='$cdyear'";
	$result14 = $conn->query($select14);
	if ($result14->num_rows == 0) {	
			
			if($stmt3 = $conn->prepare("INSERT INTO experience_selectsubject (examiner_id,
															  year1, 
															  subject_ex, 
															  subject_md,
															  assi_experince,
															  yearLstApoint,
															  apointNoast,
															  yearAdCheief,
															  yearLstAdCheief,
															  apointNoAdCheief,
															  accept_adex
															  ) 
															  VALUES (
															  '$ses_ukey',
															  '$cdyear',
															  '$subject_ex',
															  '$subject_md',
															  '$ass_experince',
															  '$yearLstApoint',
															  '$apointNoast',
															  '$yearAdCheief',
															  '$yearLstAdCheief',
															  '$apointNoAdCheief',
															  '$accept_adex'
															  )")){
				$stmt3->execute();
			}
	}
	else{
		if ($stmt3 = $conn->prepare("UPDATE experience_selectsubject SET  subject_ex='$subject_ex', 
																		  subject_md='$subject_md',
																		  assi_experince='$ass_experince',
																		  yearLstApoint='$yearLstApoint',
																		  apointNoast='$apointNoast',
																		  yearAdCheief='$yearAdCheief',
																		  yearLstAdCheief='$yearLstAdCheief',
																		  apointNoAdCheief='$apointNoAdCheief',
																		  accept_adex='$accept_adex'
															WHERE examiner_id='$ses_ukey' AND
																  year1='$cdyear'")) {
				$stmt3->execute();
				
		}
	}
	
	
	
	
	$target_dir ="uploads/";

	$target_file = $target_dir.basename($_FILES['upd_images']['name']);
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
				
	$target_new = $target_dir ."a".$ses_ukey."_".$cdyear.".".$fileType;
									
	if(move_uploaded_file($_FILES["upd_images"]["tmp_name"], $target_new)){
		$awers1="a".$ses_ukey."_".$cdyear.".".$fileType;
		
		$select30 = "SELECT * FROM spactivity_schoolsubjectperiod WHERE examiner_id='$ses_ukey' AND year1='$cdyear' AND timetable='$awers1'";
		$result30 = $conn->query($select30);
		if ($result30->num_rows == 0) {	
			if ($stmt4 = $conn->prepare("UPDATE spactivity_schoolsubjectperiod SET  timetable='$awers1'
																WHERE examiner_id='$ses_ukey' AND
																	  year1='$cdyear'")) {
					$stmt4->execute();
					
			}
		}
	}
	
	
	
	echo "<script>
				alert('Successfully Saved!')
				window.location.href = 'registration4.php';
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
    <script src="js/validation.js"></script>

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
    </style>

    <script>
      
    </script>
    
  </head>
  <body>
  <?php include ('header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <?php include ('sidebar.php'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- start -->
      <article>
        <!-- Start Multiform HTML -->
        <section class="multi_step_form">  
          <form method ="post" id="msform" enctype="multipart/form-data"> 
            <!-- Tittle -->
            <div class="tittle">
              <h1>Marking Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Basic Details</li>  
              <li class="active">Service Details</li> 
              <li class="active">Academic and professional qualifications</li>
              <li>Declaration</li>
            </ul>
            
			<?php
			$statusofupd=0;
			
			$select2 = "SELECT * FROM proqualifications WHERE examiner_id='$ses_ukey'";
			$result2 = $conn->query($select2);
			if ($result2->num_rows > 0) {
				$statusofupd=1;
				
				while($rows2 = $result2->fetch_assoc()) {
						$bs1=$rows2['coursetype'];
						$bs2=$rows2['coursefollow1'];
						$bs3=$rows2['year_completed1'];
						$bs4=$rows2['subjects1'];
						$bs5=$rows2['grade1'];
						$bs6=$rows2['institute1'];
						$bs7=$rows2['deploma_follow'];
						$bs8=$rows2['year_diploma'];
						$bs9=$rows2['subjects_diploma'];
						$bs10=$rows2['grade_diploma'];
						$bs11=$rows2['institute_diploma'];
					
				}
			}
			
			$select15 = "SELECT * FROM eduqualifications WHERE examiner_id='$ses_ukey'";
			$result15 = $conn->query($select15);
			if ($result15->num_rows > 0) {
				$statusofupd=1;
				
				while($rows15 = $result15->fetch_assoc()) {
						 $bn1=$rows15['degree_follow']; 
						 $bn2=$rows15['degree_type'];
						 $bn3=$rows15['year_degree'];
						 $bn4=$rows15['subjects_degree'];
						 $bn5=$rows15['grade_degree'];
						 $bn6=$rows15['institute_degree'];
						 $bn7=$rows15['pdegree_follow'];
						 $bn8=$rows15['year_pdegree'];
						 $bn9=$rows15['subjects_pdegree'];
						 $bn10=$rows15['grade_pdegree'];
						 $bn11=$rows15['institute_pdegree'];
					
				}
			}
			
			$select16 = "SELECT * FROM spactivity_schoolsubjectperiod WHERE examiner_id='$ses_ukey'";
			$result16 = $conn->query($select16);
			if ($result16->num_rows > 0) {
				$statusofupd=1;
				
				while($rows16 = $result16->fetch_assoc()) {
						$br1=$rows16['spactivity']; 
						$br2=$rows16['periods_g12'];
						$br3=$rows16['periods_g13'];
						$br4=$rows16['year_sat'];
						$br5=$rows16['student_sat'];
						$br6=$rows16['student_pass'];
						$br7=$rows16['timetable'];
				}
			}
			
			$select17 = "SELECT * FROM experience_selectsubject WHERE examiner_id='$ses_ukey'";
			$result17 = $conn->query($select17);
			if ($result17->num_rows > 0) {
				$statusofupd=1;
				
				while($rows17 = $result17->fetch_assoc()) {
						$bu1=$rows17['subject_ex']; 
						$bu2=$rows17['subject_md']; 
						$bu3=$rows17['assi_experince']; 
						$bu4=$rows17['yearLstApoint']; 
						$bu5=$rows17['apointNoast']; 
						$bu6=$rows17['yearAdCheief']; 
						$bu7=$rows17['yearLstAdCheief']; 
						$bu8=$rows17['apointNoAdCheief']; 
						$bu9=$rows17['accept_adex']; 
					
				}
			}
			
			?>
			
			
			<!-- fieldsets -->
            <fieldset>
              <h3>Academic and professional qualifications</h3>
              <h6>Please provide valid details</h6> 
              <div class="accordion">
                <div class="accordion-item">
                  <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo">Trainings (Relevant to the subject )</button>
                  <div id="demo" class="accordion-collapse collapse">
                    <br>
                      <div class="accordion-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3" style="text-align:left;">
                              <label>10-a.Training Relevant to the subject applied (Select most important course):</label>
                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                          <label>(a).Course Type:</label>                    
                          <select class='form-control' name="courseType" id="courseType">
							 <?php
							  if($statusofupd==1){
								
								if($bs1==1){
									echo "<option value='1'>Higher Edu. Diploma</option>";
									echo "<option value='2'>Teachers Training</option>";
								}
								if($bs1==2){
									echo "<option value='2'>Teachers Training</option>";
									echo "<option value='1'>Higher Edu. Diploma</option>";
								}
							  }
							  else{
								echo "<option value='' disabled selected hidden>Select Course Type.............</option>";
								echo "<option value='1'>Higher Edu. Diploma</option>";
								echo "<option value='2'>Teachers Training</option>";
							  }
							?>
                          </select>
                        </div>
                          <div class="col-md-8 mb-3" style="text-align:left;">
                            <label>(b).Course Followed:</label> 
                             <select class='form-control' name="courseFollow" id="courseFollow">
							   <?php
								  $sel18="";
								  $select18 = "SELECT * FROM training";
								  $result18 = $conn->query($select18);	
								  while($row18=$result18->fetch_assoc()) {
									$sel18 = $sel18."<option value='" .$row18['training_id']."'>" . $row18['training_name'] ."</option>";
								  }
								  
								  if($statusofupd==1){
									$select19 = "SELECT * FROM training WHERE training_id='$bs2'";
									$result19 = $conn->query($select19);	
									while($row19=$result19->fetch_assoc()) {
										$sel19 = $sel19."<option value='" .$row19['training_id']."'>" . $row19['training_name'] ."</option>";
									}
									echo $sel19;
									echo $sel18;
								  }
								  else{
									echo "<option value='' disabled selected hidden>Select Course.............</option>";
									echo $sel18;
								  }
								?>
                            </select>
                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(c).year completed:</label> 
                            <input type="text" class="form-control" name="year_completed1" id="year_completed1"  value="<?php if($statusofupd==1){ echo $bs3;} ?>">    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).subjects:</label> 
                            <input type="text" class="form-control" name="subjects1" id="subjects1"  value="<?php if($statusofupd==1){ echo $bs4;} ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(e).Grade:</label> 
                            <input type="text" class="form-control" name="Grade1" id="Grade1"  value="<?php if($statusofupd==1){ echo $bs5;} ?>">    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(f).Institute:</label> 
                            <input type="text" class="form-control" name="institute1" id="institute1"  value="<?php if($statusofupd==1){ echo $bs6;} ?>">    
                          </div>          
                                     
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>
              <div class="accordion">
                <div class="accordion-item">
                  <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo1">Degree(Relevant to the subject)</button>
                  <div id="demo1" class="accordion-collapse collapse">
                    <br>
                    <div class="accordion-body">
                      <div class="form-row">
                        <div class="col-md-12 mb-3" style="text-align:left;">
                          <label>10-b.Degree relevant to the subject applied:</label>   
                        </div>
                        <div class="col-md-4 mb-3" style="text-align:left;">
                          <label>(a).Degree Type:</label>                    
                          <select class='form-control' name="degree_type" id="degree_type">
							<?php
							  if($statusofupd==1){
								
								if($bn2==1){
									echo "<option value='1'>Special</option>";
									echo "<option value='2'>General</option>";
								}
								if($bn2==2){
									echo "<option value='2'>General</option>";
									echo "<option value='1'>Special</option>";
								}
							  }
							  else{
								echo "<option value='' disabled selected hidden>Select Degree Type.............</option>";
								echo "<option value='1'>Special</option>";
								echo "<option value='2'>General</option>";
							  }
							?>
                          </select>
                        </div>
                        <div class="col-md-8 mb-3" style="text-align:left;">
                          <label>(b).Name of the Degree:</label>                    
                          <select class='form-control' name="degree_follow" id="degree_follow">
                            
							<?php
								  $sel20="";
								  $select20 = "SELECT * FROM degree";
								  $result20 = $conn->query($select20);	
								  while($row20=$result20->fetch_assoc()) {
									$sel20= $sel20."<option value='" .$row20['degree_id']."'>" . $row20['degree_name'] ."</option>";
								  }
								  
								  if($statusofupd==1){
									$select21 = "SELECT * FROM degree WHERE degree_id='$bn1'";
									$result21 = $conn->query($select21);	
									while($row21=$result21->fetch_assoc()) {
										$sel21 = $sel21."<option value='" .$row21['degree_id']."'>" . $row21['degree_name'] ."</option>";
									}
									echo $sel21;
									echo $sel20;
								  }
								  else{
									echo "<option value='' disabled selected hidden>Select Degree.............</option>";
									echo $sel20;
								  }
							?>
                          </select>
                        </div>
                        <div class="col-md-4 mb-3" style="text-align:left;">
                          <label>(c).year completed:</label> 
                          <input type="text" class="form-control" name="year_degree" id="year_degree"  value="<?php if($statusofupd==1){ echo $bn3;} ?>">  
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>(d).Main subjects:</label> 
                          <input type="text" class="form-control" name="subjects_degree" id="subjects_degree"  value="<?php if($statusofupd==1){ echo $bn4;} ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>(e).Grade:</label> 
                          
						  <select class='form-control' name="Grade_degree" id="Grade_degree">
							<?php
							  if($statusofupd==1){
								
								if($bn5==1){
									echo "<option value='1'>First Class</option>";
									echo "<option value='2'>Second Class</option>";
								}
								if($bn5==2){
									echo "<option value='2'>Second Class</option>";
									echo "<option value='1'>First Class</option>";
								}
							  }
							  else{
								echo "<option value='' disabled selected hidden>Select Grade.............</option>";
								echo "<option value='1'>First Class</option>";
								echo "<option value='2'>Second Class</option>";
							  }
							?>
                          </select>
                        </div>   
                        <div class="col-md-12 mb-3" style="text-align:left;">
                          <label>(f).Institute:</label> 
                          <input type="text" class="form-control" name="institute_degree" id="institute_degree"  value="<?php if($statusofupd==1){ echo $bn6;} ?>">    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br><br>

              <div class="accordion">
                <div class="accordion-item">
                  <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo2">Postgraduate Diploma(Relevant to the subject)</button>
                  <div id="demo2" class="accordion-collapse collapse">
                    <br>
                      <div class="accordion-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>10-c.Postgraduate Diploma relevant to the subject applied:</label>
                          </div>
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(a).Name of the Diploma:</label> 
                                                
                            <select class='form-control' name="diploma_follow" id="diploma_follow">
								
								<?php
								  $sel22="";
								  $select22 = "SELECT * FROM pdeploma";
								  $result22 = $conn->query($select22);	
								  while($row22=$result22->fetch_assoc()) {
									$sel22= $sel22."<option value='" .$row22['diploma_id']."'>" . $row22['diploma_name'] ."</option>";
								  }
								  
								  if($statusofupd==1){
									$select23 = "SELECT * FROM pdeploma WHERE diploma_id='$bs7'";
									$result23 = $conn->query($select23);	
									while($row23=$result23->fetch_assoc()) {
										$sel23 = $sel23."<option value='" .$row23['diploma_id']."'>" . $row23['diploma_name'] ."</option>";
									}
									echo $sel23;
									echo $sel22;
								  }
								  else{
									echo "<option value='' disabled selected hidden>Select Diploma.............</option>";
									echo $sel22;
								  }
								?>
							</select>

                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(b).year completed:</label> 
                            <input type="text" class="form-control" name="year_diploma" id="year_diploma"  value="<?php if($statusofupd==1){ echo $bs8;} ?>">    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(c).Main subjects:</label> 
                            <input type="text" class="form-control" name="subjects_diploma" id="subjects_diploma"  value="<?php if($statusofupd==1){ echo $bs9;} ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).Grade:</label> 
                            <input type="text" class="form-control" name="Grade_diploma" id="Grade_diploma"  value="<?php if($statusofupd==1){ echo $bs10;} ?>">
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e).Institute:</label> 
                            <input type="text" class="form-control" name="institute_diploma" id="institute_diploma"  value="<?php if($statusofupd==1){ echo $bs11;} ?>">    
                          </div>
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
                <br><br>

                <div class="accordion">
                  <div class="accordion-item">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo3">Postgraduate Degree(Relevant to the subject)</button>
                    <div id="demo3" class="accordion-collapse collapse">
                      <br>
                      <div class="accordion-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>10-d.Postgraduate Degree relevant to the subject applied:</label> 
                          </div>
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(a).Name of the Postgraduate Degree:</label> 
                                                   
                            <select class='form-control' name="pdegree_follow" id="pdegree_follow">
								
								<?php
								  $sel24="";
								  $select24 = "SELECT * FROM pdegree";
								  $result24 = $conn->query($select24);	
								  while($row24=$result24->fetch_assoc()) {
									$sel24= $sel24."<option value='" .$row24['pdegree_id']."'>" . $row24['pdegree_name'] ."</option>";
								  }
								  
								  if($statusofupd==1){
									$select25 = "SELECT * FROM pdegree WHERE pdegree_id='$bn7'";
									$result25 = $conn->query($select25);	
									while($row25=$result25->fetch_assoc()) {
										$sel25 = $sel25."<option value='" .$row25['pdegree_id']."'>" . $row25['pdegree_name'] ."</option>";
									}
									echo $sel25;
									echo $sel24;
								  }
								  else{
									echo "<option value='' disabled selected hidden>Select Diploma.............</option>";
									echo $sel24;
								  }
								?>
							</select>
                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(b).year completed:</label> 
                            <input type="text" class="form-control" name="year_pdegree" id="year_pdegree"  value="<?php if($statusofupd==1){ echo $bn8;} ?>">    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(c).Main subjects:</label> 
                            <input type="text" class="form-control" name="subjects_pdegree" id="subjects_pdegree"  value="<?php if($statusofupd==1){ echo $bn9;} ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).Grade:</label> 
                            <input type="text" class="form-control" name="Grade_pdegree" id="Grade_pdegree"  value="<?php if($statusofupd==1){ echo $bn10;} ?>">    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e).Institute:</label> 
                            <input type="text" class="form-control" name="institute_pdegree" id="institute_pdegree"  value="<?php if($statusofupd==1){ echo $bn11;} ?>">    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>

                <div class="accordion">
                  <div class="accordion-item">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo4">Special Quailifications(Relevant to the subject)</button>
                    <div id="demo4" class="accordion-collapse collapse">
                      <br>
                      <div class="accordion-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>10-e.If you have Participated in national level activities in following list,Select it </label>
                          </div>
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>Select the Activity</label>
                            <select id="sp-activity" name="sp_activity" class="form-control" >
                              
								<?php
								  $sel26="";
								  $select26 = "SELECT * FROM activity";
								  $result26 = $conn->query($select26);	
								  while($row26=$result26->fetch_assoc()) {
									$sel26= $sel26."<option value='" .$row26['activity_id']."'>" . $row26['activity_name'] ."</option>";
								  }
								  
								  if($statusofupd==1){
									$select27 = "SELECT * FROM activity WHERE activity_id='$br1'";
									$result27 = $conn->query($select27);	
									while($row27=$result27->fetch_assoc()) {
										$sel27 = $sel27."<option value='" .$row27['activity_id']."'>" . $row27['activity_name'] ."</option>";
									}
									echo $sel27;
									echo $sel26;
								  }
								  else{
									echo $sel26;
								  }
								?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>

                <div class="accordion">
                  <div class="accordion-item">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo5">Time table details(Relevant to the subject)</button>
                    <div id="demo5" class="accordion-collapse collapse">
                      <br>
                        <div class="accordion-body">
                          <div class="form-row">
                            <div class="col-md-12 mb-3" style="text-align:left;">
                              <label>11. Fill in (a),(b) and (c) sections according to your duties</label>   
                            </div>
                            <div class="col-md-12 mb-3" style="text-align:left;">
                              <label>(a).No of Periods you teach the applied subject in G.C.E(A/L) clases per week</label>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Grade 12:</label> 
                              <input type="number" class="form-control" name="Grade12" id="Grade12" required value="<?php if($statusofupd==1){ echo $br2;} ?>">
                              <label id="Grade12error"></label>
                            </div>   
                            <div class="col-md-6 mb-3">
                              <label>Grade 13:</label> 
                              <input type="number" class="form-control" name="Grade13" id="Grade13" required value="<?php if($statusofupd==1){ echo $br3;} ?>">
                              <label id="Grade13error"></label>
                            </div>   
                            <div class="col-md-12 mb-3">
                              <h6 style="text-align:left;">(b).Please upload the time table to verify.</h6>
                              <div class="input-group"> 
                                  <input type="file" class="form-control" name="upd_images">
                                  <!-- <label class="custom-file-label" for="upload"><i class="ion-android-cloud-outline"></i>Choose file</label> -->
                              </div>
                            </div>
							
							 <div class="col-md-12 mb-3" style="text-align:left;">
							<?php
								if($statusofupd==1){
									$imgpath="uploads/".$br7;
							?>
									<img src="<?php echo $imgpath; ?>" width="100%" height="390px">
							<?php
								}
							?>
							</div>
							
                            <div class="col-md-12 mb-3" style="text-align:left;">
                              <label>(c).Results of school at last G.C.E(A/L) Examination for the subject you applied as subject for marking</label> 
                            </div>
                            <div class="col-md-4 mb-3">
                              <label>Year:</label> 
                              <input type="text" class="form-control" name="year_sat" id="year_sat" required value="<?php if($statusofupd==1){ echo $br4;} ?>">   
                            </div>   
                            <div class="col-md-4 mb-3">
                              <label>No of Students Sat:</label> 
                              <input type="number" class="form-control" name="student_sat" id="student_sat" required value="<?php if($statusofupd==1){ echo $br5;} ?>">    
                            </div>   
                            <div class="col-md-4 mb-3">
                              <label>No of Students Passed:</label> 
                              <input type="number" class="form-control" name="student_pass" id="student_pass" required value="<?php if($statusofupd==1){ echo $br6;} ?>">
                              <label id="student_passerror"></label>    
                            </div>   
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>

                <div class="accordion">
                  <div class="accordion-item">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#demo6">Experince in Evaluation of selected subject</button>
                    <div id="demo6" class="accordion-collapse collapse">
                      <br>
                      <div class="accordion-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>12(i).Exaperince in evaluation:</label>  
                          </div>
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(a).subject:</label> 
                            <select class='form-control' name="subject_ex" id="subject_ex" required>
                              
							 <?php
								  $sel28="";
								  $select28 = "SELECT * FROM subjects";
								  $result28 = $conn->query($select28);	
								  while($row28=$result28->fetch_assoc()) {
									$sel28= $sel28."<option value='" .$row28['subject_id']."'>" . $row28['subject_id'] ."-". $row28['subject_name'] . "</option>";
								  }
								  
								  if($statusofupd==1){
									$select29 = "SELECT * FROM subjects WHERE subject_id='$bu1'";
									$result29 = $conn->query($select29);	
									while($row29=$result29->fetch_assoc()) {
										$sel29 = $sel29."<option value='" .$row29['subject_id']."'>" . $row29['subject_id'] ."-". $row29['subject_name'] . "</option>";
									}
									echo $sel29;
									echo $sel28;
								  }
								  else{
																		
									echo "<option value='' disabled selected hidden>Select Subject.............</option>";
									echo $sel28;
								  }
								?>
                            </select>                              
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>(b).Medium:</label> 
                            <select id="subject_md" name="subject_md" class="form-control" required>
							  <?php
							  if($statusofupd==1){
								
								if($bu2==2){
									echo "<option value='2'>Sinhala</option>";
									echo "<option value='3'>Tamil</option>";
									echo "<option value='4'>English</option>";
								}
								if($bu2==3){
									echo "<option value='3'>Tamil</option>";
									echo "<option value='2'>Sinhala</option>";
									echo "<option value='4'>English</option>";
								}
								if($bu2==4){
									echo "<option value='4'>English</option>";
									echo "<option value='2'>Sinhala</option>";
									echo "<option value='3'>Tamil</option>";
								}
							  }
							  else{
								echo "<option value='' disabled selected hidden>Select Medium.............</option>";
								echo "<option value='2'>Sinhala</option>";
								echo "<option value='3'>Tamil</option>";
								echo "<option value='4'>English</option>";
							  }
							  ?>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(c).No Years Experince as Assistant Examiner:</label> 
                            <input type="number" class="form-control" name="ass_experince" id="ass_experince" max="10" min="0" required value="<?php if($statusofupd==1){ echo $bu3;} ?>">
                            <label id="ass_experinceerror"></label>
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(d)Year of Last appointment(Assistant Examiner):</label> 
                            <input type="text" class="form-control" name="yearLstApoint" id="yearLstApoint"  required value="<?php if($statusofupd==1){ echo $bu4;} ?>">    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e)Appointment No as Assistant Examiner:</label> 
                            <input type="text" class="form-control" name="apointNoast" id="apointNoast" required value="<?php if($statusofupd==1){ echo $bu5;} ?>">    
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(f).No Years Experince as Additional cheief Examiner:</label> 
                            <input type="number" class="form-control" name="yearAdCheief" id="yearAdCheief" required max="10" min="0" value="<?php if($statusofupd==1){ echo $bu6;} ?>"> 
                            <label id="yearAdCheieferror"></label>   
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(g)Year of Last appointment(Additional cheief Examiner):</label> 
                            <input type="text" class="form-control" name="yearLstAdCheief" id="yearLstAdCheief" required value="<?php if($statusofupd==1){ echo $bu7;} ?>">    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(h)Appointment No as Additional cheief Examiner:</label> 
                            <input type="text" class="form-control" name="apointNoAdCheief" name="apointNoAdCheief" required value="<?php if($statusofupd==1){ echo $bu8;} ?>">    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>12(ii).Would you like to accept apointment as an Additional Cheief Examiner(If Selected):</label> 
                            <select id="subject_md" name="accept_adex" class="form-control" >
                              
							  <?php
							  if($statusofupd==1){
								
								if($bu9==1){
									echo "<option value='1'>Yes</option>";
									echo "<option value='0'>No</option>";
									
								}
								if($bu9==0){
									echo "<option value='0'>No</option>";
									echo "<option value='1'>Yes</option>";
								}
							  }
							  else{
								echo "<option value='' disabled selected hidden>Select.............</option>";
								echo "<option value='1'>Yes</option>";
								echo "<option value='0'>No</option>";
							  }
							  ?>
                            </select>
                          </div>   
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <br><br> 
               <a href="registration2.php"><button type="button" class="btn btn-danger">Back</button></a>
              <button type="submit" name="btn_apppart3" class="btn btn-success">Continue</button>  
            </fieldset>  
        </section> 
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

