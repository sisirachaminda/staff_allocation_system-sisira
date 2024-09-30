<?php
include 'session_handler.php';
include 'db-connect.php';

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
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--<script src="js/validation.js"></script>-->

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
      $(document).ready(function(){
        $("#show").hide();
        $("#sit_exam").change(function(){
          var sit_exam = $("#sit_exam").val();

          if(sit_exam == "1") {
            $("#show").show();
          } else {
            $("#show").hide();
          }
        });

        // Zone
        $("#district").change(function () {
            var district = $("#district").val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: 'district=' + district,
                success: function (data) {
                    $("#zone").html(data);
                }
            });
        });

        //School
        $("#zone").change(function () {
            var zone = $("#zone").val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: 'zone=' + zone,
                success: function (data) {
                    $("#school").html(data);
                }
            });
        });
      });
    </script>
    <?php 
      //include '../function/selectExDetails.php';
    ?>
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
          <form action="appPreview.php" method ="POST" id="msform" enctype="multipart/form-data" class="needs-validation" novalidate> 
            <!-- Tittle -->
            <div class="tittle">
              <h1>Edit Marking Application </h1>
              <!--<p>In order to use this service, you have to complete this verification process</p> -->
            </div>
            <!-- progressbar -->
            <ul id="progressbar">
              <li class="active">Basic Details</li>  
              <li>Service Details</li> 
              <li>Academic and pfofessional qualifications</li>
              <li>Declaration</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">01(a).Subject No & Subject:</label>
                  <select class='form-control' name="subject" id="subject">
                    <option value="">Select Subject</option>
                   <?php
					  $select1 = "SELECT * FROM subjects";
					  $result1 = $conn->query($select1);	
					  while($row1=$result1->fetch_assoc()) {
                        echo "<option value='" .$row1['subject_id']."'>" . $row1['subject_id'] ."-". $row1['subject_name'] . "</option>";
                      }
				   ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Medium:</label>
                  
                  <select id="medium" name="medium" class="form-control" >
                    <option value="2">Sinhala</option>
                    <option value="3">Tamil</option>
                    <option value="4">English</option>
                  </select>
                </div>
  
              </div>

              <div class="form-row" style="text-align:left;">
                <label>02.Area No and area you wish to do marking (Town closest either your place of work or perment residence. Please see the list of areas on last page.) </label>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(a).First Choice:</label>
                  <select id="firstTown" name="firstTown" class="form-control" >
                    <option value="">Select First Town</option>
					<?php
					  $select2 = "SELECT * FROM town";
					  $result2 = $conn->query($select2);	
					  while($row2=$result2->fetch_assoc()) {
                        echo "<option value='" .$row2['town_id']."'>" . $row2['town_id'] ."-". $row2['town_name'] . "</option>";
                      }
				   ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b)Second Choice:</label>
                  <select id="secondTown" name="secondTown" class="form-control" >
                    <option value="">Select Second Town</option>
                    <?php
					  $select3 = "SELECT * FROM town";
					  $result3 = $conn->query($select3);	
					  while($row3=$result3->fetch_assoc()) {
                        echo "<option value='" .$row3['town_id']."'>" . $row3['town_id'] ."-". $row3['town_name'] . "</option>";
                      }
				   ?>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip01">03(a).Name with initials:</label>
                  <input type="text" class="form-control" name="initialName" id="initialName"placeholder="Name with initials" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(b).Name denoted by initials</label>
                  <input type="text" class="form-control" name="denotedName" id="denotedName" placeholder="Name denoted by initials"  required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="address">(c).Permenent Address</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="perAddress" id="perAddress" placeholder="Address" required>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip03">(d).Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                  <label id="emailerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip04">(e).Gender</label>
                  <select id="gender" name="gender" class="form-control" >
                  <option value="0">Male</option>
                  <option value="1">Female</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(f).NIC Number</label>
                  <input type="text" class="form-control" name="nic" id="nic" placeholder="NIC Number" required>
                  <label id="nicerror"></label>
                </div>
              </div>

              <div class="form-row">
                <label>04.Present working </label>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(a).District:</label>
                  <select id="district" name="district" class="form-control" >
                    <option value="">Select District</option>
					<?php
					  $select4 = "SELECT * FROM district";
					  $result4 = $conn->query($select4);	
					  while($row4=$result4->fetch_assoc()) {
                        echo "<option value='" .$row4['district_id']."'>" . $row4['district_name'] ."</option>";
                      }
					?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip05">(b).Education Zone:</label>
                  <select id="zone" name="zone" class="form-control" >
                    <option value="">Select Zone</option>
                   
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">(c).School:</label>
                  <select id="school" name="school" class="form-control" >
                    <option value="">Select School</option>
                    
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(d).Official Address:</label>
                  <input type="text" class="form-control" name="officeAddress" id="officeAddress" placeholder="Official-address"  required>
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;" >
                  <label for="validationTooltip02" >(e).Residential District:</label>
                                  
                  <select id="ResiDistrict" name="ResiDistrict" class="form-control" >
                    <option value="">Select Residential District</option>
                   
                  </select>            
                </div>
              </div>

              <div class="form-row" style="text-align:left;" >
                <label >(f).Telephone:</label>
              </div>

              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Office Telephone No</label>
                  <input type="text" class="form-control" name="officephone" id="officephone" placeholder="Office"  required>
                  <label id="officephoneerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Home Telephone No    </label>
                  <input type="text" class="form-control" name="homephone" id="homephone" placeholder="Home"  required>
                  <label id="homephoneerror"></label>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationTooltip02">Mobile No </label>
                  <input type="text" class="form-control" name="mobilephone" id="mobilephone" placeholder="Mobile"  required>
                  <label id="mobilephoneerror"></label>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip01">05(a).Date of Birth:</label>   
                  <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth"  required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Age as at closing date</label>
                  <input type="text" class="form-control" name="ageAsClose" id="ageAsClose" placeholder="Age"  required>
                  <label id="ageAsCloseerror"></label>
                </div>
              </div>  
              <!-- <button type="button" class="action-button previous_button">Back</button> -->
              <button type="button" class="next action-button">Continue</button>  
            </fieldset>
			<!-- .................................................................................................................................-->
			
			
			
            <fieldset>
              <h3>Service Details</h3>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label for="validationTooltip01" >06.Date of Appointment as a teacher:</label>
                  <input type="date" class="form-control" name="apoAsTeacher" id="apoAsTeacher" placeholder="app"  required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">7(a).Present Designation(service & grade):</label>
                  <select id="designation" name="designation" class="form-control" >
                    <option value="">Select Designation</option>
                    <?php
					  $select5 = "SELECT * FROM designation";
					  $result5 = $conn->query($select5);	
					  while($row5=$result5->fetch_assoc()) {
                        echo "<option value='" .$row5['designation_id']."'>" . $row5['designation_name'] ."</option>";
                      }
					?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationTooltip02">(b).Date of Appointment to the above post:</label>
                  <input type="date" class="form-control" name="apoAbovePost" id="apoAbovePost" required>
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;">
                <label for="validationTooltip02">8(a).Date of Appointment as a graduate/higher deploma teacher:</label>
                  <input type="date" class="form-control" name="apoAsGraduate" id="apoAsGraduate" required>
                </div>
                <div class="col-md-6 mb-3" style="text-align:left;">
                  <label for="validationTooltip02">(b).Period of service as a graduate/higher deploma teacher(years):</label>
                  <input type="number" class="form-control" name="serviceAsGraduate" id="serviceAsGraduate" required>
                  <label id="serviceAsGraduateerror"></label>
                </div>
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label for="validationTooltip02">09.Period of service as a holder of Diploma/post graduate Diploma in education or similar(years):</label>
                  <input type="number" class="form-control" name="serviceAsDiploma" id="serviceAsDiploma" required>
                  <label id="serviceAsDiplomaerror"></label>
                </div>
              </div>
              <button type="button" class="action-button previous previous_button">Back</button>
              <button type="button" class="next action-button">Continue</button>  
            </fieldset>  
			<!-- .................................................................................................................................-->
			
			
			
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
                            <option value=''>Select Degree Type</option>
                            <option value='1'>Higher Edu. Diploma</option>
                            <option value='2'>Teachers Training</option>
                          </select>
                        </div>
                          <div class="col-md-8 mb-3" style="text-align:left;">
                            <label>(b).Course Followed:</label> 
                             <select class='form-control' name="courseFollow" id="courseFollow">
                              <option value="">Select the Course</option>
							  <?php
							  $select6 = "SELECT * FROM training";
							  $result6 = $conn->query($select6);	
							  while($row6=$result6->fetch_assoc()) {
								echo "<option value='" .$row6['training_id']."'>" . $row6['training_name'] ."</option>";
							  }
							  ?>
                            </select>
                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(c).year completed:</label> 
                            <input type="text" class="form-control" name="year_completed1" id="year_completed1" required>    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).subjects:</label> 
                            <input type="text" class="form-control" name="subjects1" id="subjects1" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(e).Grade:</label> 
                            <input type="text" class="form-control" name="Grade1" id="Grade1" required>    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(f).Institute:</label> 
                            <input type="text" class="form-control" name="institute1" id="institute1" required>    
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
                            <option value=''>Select Degree Type</option>
                            <option value='1'>First Class</option>
                            <option value='2'>Second Class</option>
                          </select>
                        </div>
                        <div class="col-md-8 mb-3" style="text-align:left;">
                          <label>(b).Name of the Degree:</label>                    
                          <select class='form-control' name="degree_follow" id="degree_follow">
                            <option value="">Select Degree</option>
                            <?php
							  $select7 = "SELECT * FROM degree";
							  $result7 = $conn->query($select7);	
							  while($row7=$result7->fetch_assoc()) {
								echo "<option value='" .$row7['degree_id']."'>" . $row7['degree_name'] ."</option>";
							  }
							?>
                          </select>
                        </div>
                        <div class="col-md-4 mb-3" style="text-align:left;">
                          <label>(c).year completed:</label> 
                          <input type="text" class="form-control" name="year_degree" id="year_degree" required>  
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>(d).Main subjects:</label> 
                          <input type="text" class="form-control" name="subjects_degree" id="subjects_degree" required>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>(e).Grade:</label> 
                          <input type="text" class="form-control" name="Grade_degree" id="Grade_degree" required>    
                        </div>   
                        <div class="col-md-12 mb-3" style="text-align:left;">
                          <label>(f).Institute:</label> 
                          <input type="text" class="form-control" name="institute_degree" id="institute_degree" required>    
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
								<option value="">Select Diploma</option>
								<?php
								$select8 = "SELECT * FROM pdeploma";
								$result8 = $conn->query($select8);	
								while($row8=$result8->fetch_assoc()) {
									echo "<option value='" .$row8['diploma_id']."'>" . $row8['diploma_name'] ."</option>";
								}
								?>
							</select>

                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(b).year completed:</label> 
                            <input type="text" class="form-control" name="year_diploma" id="year_diploma" required>    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(c).Main subjects:</label> 
                            <input type="text" class="form-control" name="subjects_diploma" id="subjects_diploma" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).Grade:</label> 
                            <input type="text" class="form-control" name="Grade_diploma" id="Grade_diploma" required>
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e).Institute:</label> 
                            <input type="text" class="form-control" name="institute_diploma" id="institute_diploma" required>    
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
								<option value="">Select Postgraduate Degree</option>
								<?php
								$select9 = "SELECT * FROM pdegree";
								$result9 = $conn->query($select9);	
								while($row9=$result9->fetch_assoc()) {
									echo "<option value='" .$row9['pdegree_id']."'>" . $row9['pdegree_name'] ."</option>";
								}
								?>
							</select>
                          </div>
                          <div class="col-md-4 mb-3" style="text-align:left;">
                            <label>(b).year completed:</label> 
                            <input type="text" class="form-control" name="year_pdegree" id="year_pdegree" required>    
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(c).Main subjects:</label> 
                            <input type="text" class="form-control" name="subjects_pdegree" id="subjects_pdegree" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label>(d).Grade:</label> 
                            <input type="text" class="form-control" name="Grade_pdegree" id="Grade_pdegree" required>    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e).Institute:</label> 
                            <input type="text" class="form-control" name="institute_pdegree" id="institute_pdegree" required>    
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
								$select10 = "SELECT * FROM activity";
								$result10 = $conn->query($select10);	
								while($row10=$result10->fetch_assoc()) {
									echo "<option value='" .$row10['activity_id']."'>" . $row10['activity_name'] ."</option>";
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
                              <input type="number" class="form-control" name="Grade12" id="Grade12" required>
                              <label id="Grade12error"></label>
                            </div>   
                            <div class="col-md-6 mb-3">
                              <label>Grade 13:</label> 
                              <input type="number" class="form-control" name="Grade13" id="Grade13" required>
                              <label id="Grade13error"></label>
                            </div>   
                            <div class="col-md-12 mb-3">
                              <h6 style="text-align:left;">(b).Please upload the time table to verify.</h6>
                              <div class="input-group"> 
                                  <input type="file" class="form-control" name="timetable" id="upload" value="Upload Files" accept="image/*">
                                  <!-- <label class="custom-file-label" for="upload"><i class="ion-android-cloud-outline"></i>Choose file</label> -->
                              </div>
                            </div>
                            <div class="col-md-12 mb-3" style="text-align:left;">
                              <label>(c).Results of school at last G.C.E(A/L) Examination for the subject you applied as subject for marking</label> 
                            </div>
                            <div class="col-md-4 mb-3">
                              <label>Year:</label> 
                              <input type="text" class="form-control" name="year_sat" id="year_sat" required>   
                            </div>   
                            <div class="col-md-4 mb-3">
                              <label>No of Students Sat:</label> 
                              <input type="number" class="form-control" name="student_sat" id="student_sat" required>    
                            </div>   
                            <div class="col-md-4 mb-3">
                              <label>No of Students Passed:</label> 
                              <input type="number" class="form-control" name="student_pass" id="student_pass" required>
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
                            <select class='form-control' name="subject_ex" id="subject_ex">
                              <option value="">Select Subject</option>
                             <?php
							  $select11 = "SELECT * FROM subjects";
							  $result11 = $conn->query($select11);	
							  while($row11=$result11->fetch_assoc()) {
								echo "<option value='" .$row11['subject_id']."'>" . $row11['subject_id'] ."-". $row11['subject_name'] . "</option>";
							  }
							 ?>
                            </select>                              
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>(b).Medium:</label> 
                            <select id="subject_md" name="subject_md" class="form-control" >
                              <option value="2">Sinhala</option>
                              <option value="3">Tamil</option>
                              <option value="4">English</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(c).No Years Experince as Assistant Examiner:</label> 
                            <input type="number" class="form-control" name="ass_experince" id="ass_experince" required>
                            <label id="ass_experinceerror"></label>
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(d)Year of Last appointment(Assistant Examiner):</label> 
                            <input type="text" class="form-control" name="yearLstApoint" id="yearLstApoint" required>    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(e)Appointment No as Assistant Examiner:</label> 
                            <input type="text" class="form-control" name="apointNoast" id="apointNoast" required>    
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(f).No Years Experince as Additional cheief Examiner:</label> 
                            <input type="number" class="form-control" name="yearAdCheief" id="yearAdCheief" required> 
                            <label id="yearAdCheieferror"></label>   
                          </div>   
                          <div class="col-md-6 mb-3" style="text-align:left;">
                            <label>(g)Year of Last appointment(Additional cheief Examiner):</label> 
                            <input type="text" class="form-control" name="yearLstAdCheief" id="yearLstAdCheief" required>    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>(h)Appointment No as Additional cheief Examiner:</label> 
                            <input type="text" class="form-control" name="apointNoAdCheief" name="apointNoAdCheief" required>    
                          </div>   
                          <div class="col-md-12 mb-3" style="text-align:left;">
                            <label>12(ii).Would you like to accept apointment as an Additional Cheief Examiner(If Selected):</label> 
                            <select id="subject_md" name="accept_adex" class="form-control" >
                              <option value="1">yes</option>
                              <option value="2">No</option>
                            </select>
                          </div>   
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <br><br> 
              <button type="button" class="action-button previous previous_button">Back</button>
              <button type="button" class="next action-button">Continue</button>  
            </fieldset> 
            <fieldset>
              <h3>Declaration</h3>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>13.Is a family member or a resident of your house expected to sit the above examination this year?</label> 
                  <select id="sit_exam" name="sit_exam" class="form-control" id="sit_exam">
                    <option value="1">yes</option>
                    <option value="2" selected>No</option>
                  </select> 
                </div>   
              </div>
              <div id="show">
                <div class="form-row">
                  <h6> Provide following details:</h6>
                  <div class="col-md-12 mb-3" style="text-align:left;">
                    <label>(a).Ditrict</label>
                    <select class='form-control' name="sit_dist" id="sit_dist"> 
                      <option value="">Select District</option>
                      <?php
					  $select12 = "SELECT * FROM district";
					  $result12 = $conn->query($select12);	
					  while($row12=$result12->fetch_assoc()) {
                        echo "<option value='" .$row12['district_id']."'>" . $row12['district_name'] ."</option>";
                      }
					  ?>
                    </select>
                  </div>  
                </div>
                <div class="form-row">
                  <div class="col-md-12 mb-3" style="text-align:left;">
                    <label>(b).Subjects:</label>
                  </div>  
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub1" id="sit_sub1">
                      <option value="">Select First Subject</option>
					  <?php
						  $select13 = "SELECT * FROM subjects";
						  $result13 = $conn->query($select13);	
						  while($row13=$result13->fetch_assoc()) {
							echo "<option value='" .$row13['subject_id']."'>" . $row13['subject_id'] ."-". $row13['subject_name'] . "</option>";
						  }
					  ?>
                    </select>
                  </div>   
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub2" id="sit_sub2">
                      <option value="">Select Second Subject</option>
                      <?php
						  $select14 = "SELECT * FROM subjects";
						  $result14 = $conn->query($select14);	
						  while($row14=$result14->fetch_assoc()) {
							echo "<option value='" .$row14['subject_id']."'>" . $row14['subject_id'] ."-". $row14['subject_name'] . "</option>";
						  }
					  ?>
                    </select>  
                  </div>   
                  <div class="col-md-4 mb-3" style="text-align:left;">
                    <select class='form-control' name="sit_sub3" id="sit_sub3">
                      <option value="">Select Third Subject</option>
                      <?php
						  $select15 = "SELECT * FROM subjects";
						  $result15 = $conn->query($select14);	
						  while($row15=$result15->fetch_assoc()) {
							echo "<option value='" .$row15['subject_id']."'>" . $row15['subject_id'] ."-". $row15['subject_name'] . "</option>";
						  }
					  ?>
                    </select>
                  </div>   
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>14(i). Is any disciplinary inquiry against you in progress:</label> 
                  <select id="dis_action" name="dis_action" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>   
                </div>  
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>(ii). Are you debarred from examination duties:</label> 
                  <select id="dib_action" name="dib_action" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>    
                </div>  
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>(iii)If yes, Provide details:</label> 
                  <input type="text" class="form-control" name="pvdDetails"  required>
                </div>   
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <label>15.Declaration of the Applicant:</label> 
                </div>   
                <div class="col-md-12 mb-3" style="text-align:left;">
                  <div class="form-check">    
                    <p>
                      <input class="form-check-input" type="checkbox" name="agree" value="1" id="flexCheckIndeterminate" style="border-color:black;">
                      I hereby declare that the information given above is true and accurate and  that I am not debarred from marking at present and I am aware that I will be subjected to disciplinary actions if found to have submitted false information and mislead the department.
                    </p> 
                  </div>
                </div>
              </div>
              <button type="button" class="action-button previous previous_button">Back</button>
              <button type="submit" name = "formSubmit" class="action-button">Update</button>
              <!-- <a href="#" class="action-button">Finish</a>  -->
            </fieldset>  
          </form>  
        </section> 
      <!-- END Multiform HTML -->
      </article>
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
      <script src="js/script.js"></script>   
    </main>
  </div>
</div>
</body>

</html>

