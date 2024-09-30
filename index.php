<?php
include 'admin/db-connect.php';
session_start();

?>



<!DOCTYPE html>
<html>
	<head><html lang="en" data-bs-theme="auto">
  <head><script src="chief/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Staff Allocation System</title>
    
	<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="chief/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
    <link rel="stylesheet" href="chief/css/style.css">
	<link rel="stylesheet" href="chief/css/demo.css">
	<link rel="stylesheet" href="chief/css/dashboard.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    <link href="chief/assets/dashboard.css" rel="stylesheet">
	</head>
	<body>
		
				  <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <img src="images/heading.png" width="100%">
                    </div>
                  </div>
				  <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <h2 align="center">Welcome </h2>
                    </div>
                  </div>
				  <hr>
					<div class="row">
					  <div class="col-sm-12 col-lg-4 mt-4">
						
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						 <a href="news.php"><button type="button" class="btn btn-warning btn-block"><span class="btnText">News</span></button></a>
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						
					  </div>
					</div>
					
					<div class="row">
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="examiner/index.php"><button type="button" class="btn btn-primary raised-button"><span class="btnText">Examiner</span></button></a>
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="principle/index.php"><button type="button" class="btn btn-success raised-button"><span class="btnText">Principle</span></button></a>
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="chief/index.php"><button type="button" class="btn btn-danger raised-button"><span class="btnText">Cheif Examiner</span></button></a>
					  </div>
					</div>
					<div class="row">
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="operator/index.php"><button type="button" class="btn btn-secondary raised-button"><span class="btnText">System Operator</span></button></a>
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="management/index.php"><button type="button" class="btn btn-info raised-button"><span class="btnText">Management</span></button></a>
					  </div>
					  <div class="col-sm-12 col-lg-4 mt-4">
						<a href="admin/index.php"><button type="button" class="btn btn-warning raised-button"><span class="btnText">System Administrator</span></button></a>
					  </div>
					</div>
			
           
	</body>
</html>