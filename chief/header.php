<?php
include 'db-connect.php';
include 'session_handler.php';
?>
<style>
    .flex-shrink-0 {
        margin-right: 0px;
    }
    .heading {
      color:#fff;
      font-weight: bold;
      padding-left: 50px;
    }
    #navbarNav {
      /* padding-right: 10px; */
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="plugins/bootstrap.min452.css">
  <title>Staff Allocation System</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <img src="../images/glogo.png" width="30" height="40">
  <h3 class="heading">Staff Allocation System</h3>
  <ul class="navbar-nav flex-row d-md-none">
      <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
      </li>
    </ul>  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/profile.png" width="30" height="30" class="rounded-circle">&nbsp;&nbsp;<b> <?php echo $ses_user; ?></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="userDropdown">
          <h6 class="dropdown-item"><b><?php echo $nic; ?></b></h6>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="chgpwd.php">Change PW</a>
		  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<script src="plugins/jquery-3.5.1.slim.min.js"></script>
<script src="plugins/popper.min10.js"></script>
<script src="plugins/bootstrap.min452.js"></script>

</body>
</html>