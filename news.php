<?php
include 'admin/db-connect.php';
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
    <title>Notification</title>

   <link rel="stylesheet" href="admin/plugin/font-awesome.min.css">
    <link rel="stylesheet" href="admin/plugins/css@3.css">
    <link href="admin/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/plugins/bootstrap-icons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="admin/plugins/normalize.min.css">
    <link rel='stylesheet' href='admin/plugins/bootstrap.css'>
    <link rel='stylesheet' href='admin/plugins/intlTelInput.css'>
    <link rel='stylesheet' href='admin/plugins/ionicons.min.css'>
    <link rel='stylesheet' href='admin/plugins/nice-select.min.css'>
    <link rel="stylesheet" href="admin/css/style.css">
	<link rel="stylesheet" href="admin/css/demo.css">
	<link rel="stylesheet" href="admin/css/dashboard.css">
	
    <script src="admin/plugins/jquery.min.js"></script>
    <script src="admin/plugins/jquery.min37.js"></script>
	
	<link href="admin/plugins/bootstrap.min52.css" rel="stylesheet">
	<script src="admin/plugins/bootstrap.bundle.min.js"></script>
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
	  
	  .pending th {
        background-color:#17b85d !important;
        color:#fff !important;
      }
    </style>

  </head>
  <body>
  

<div class="container-fluid">
  <div class="row">
   
    <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
      <!-- start -->
      <article>
        <div class="col col-12">
           
			<div class="card">
                <div class="card-body">
                   
					<div class="row">
					  <div class="col-sm-12 col-lg-4">
					  
					  </div>
                      <div class="col-sm-12 col-lg-4">
                             <a href="index.php"><button type="button" class="btn btn-success btn-block"><span class="btnText">Main Menu</span></button></a>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col-sm-12 col-lg-12">
                            <h2>News</h2>
                      </div>
                    </div>
                    <hr style="border-color: black;">
                    <div class="row mt-2">
								<div class="table-responsive">
									<table class='table pending'>
										<tbody>
										<?php
										$select1 = "SELECT * FROM news WHERE year1='$cdyear' ORDER BY date DESC";
										$result1 = $conn->query($select1);
										if ($result1->num_rows == 0) {
										?>
												<tr>
													<td style="font-weight:bold;background-color:red;color:#ffffff"> No New News</td>
												</tr>
										<?php
										}
										else{
											while($row1 = $result1->fetch_assoc()) {
										?>
												<tr>
													<td style="font-weight:bold;background-color:green;color:#ffffff"> <?php echo $row1['date']; ?> -- &nbsp;&nbsp;&nbsp;<?php echo $row1['news'] ?></td>
												</tr>
										<?php
											}
										}
										?>
										</tbody>
									</table>
								</div>
					</div>
					
				</div>
			</div>
     
		<!-- END Multiform HTML -->
		
      </article>
		
      <footer class="credit">Department of Examinations- Sri Lanka <a href="https://www.doenets.lk" target="_blank">www.doenets.lk</a></footer>
	  
      <script src='admin/plugins/jquery.min.js'></script>
      <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script> -->
      <script src='admin/plugins/bootstrap.bundle.min.js'></script>
      <script src='admin/plugins/intlTelInput.js'></script>
      <script src='admin/plugins/popper.min.js'></script>
      <script src='admin/plugins/jquery.nice-select.min.js'></script>
      <script src="admin/js/script.js"></script>   
	  
    </main>
  </div>
</div>
</body>

</html>

