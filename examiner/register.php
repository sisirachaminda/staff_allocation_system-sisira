<?php 
include 'db-connect.php';
$cdate=date("Y-m-d");

$selectDuration = "SELECT sdate, edate FROM info WHERE name = 'appCall'";
$resultDuration = $conn->query($selectDuration);	
while($rows = $resultDuration->fetch_assoc()){
        $sdate = $rows['sdate'];  
        $edate = $rows['edate'];   
}

if(!(($sdate < $cdate) && ($cdate < $edate))) {
	echo "<script>alert('Time Expired')</script>";
	echo "<script>window.location.href = 'index.php';</script>";
}

?>

<?php
if (isset($_POST['btn_register'])) {
	if (empty($_POST['nic']) || empty($_POST['password']) || empty($_POST['email'])) {
		echo "<script>
			alert('Please complete the registration form')
		</script>";
	}
	else{
			$select1 = "SELECT id, password FROM examiner WHERE nic ='$_POST[nic]'";
			$result1 = $conn->query($select1);
			if ($result1->num_rows > 0) {
		
				echo "<script>
						alert('User exists, please choose another!')
				</script>";
			} 
			else {
				$password=MD5($_POST['password']);
				
				if ($stmt = $conn->prepare("INSERT INTO examiner(nic, password, email) VALUES ('$_POST[nic]', '$password', '$_POST[email]')")) {
					$stmt->execute();
					echo "<script>
						alert('You have successfully registered! You can now login!')
						window.location.href = 'index.php';
					</script>";
				} else {
					
					echo "<script>
						alert('Could not prepare statement!')
						window.location.href = 'index.php';
					</script>";
				}
			}
		 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Register</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<!--<script src="../assets/js/validation.js"></script>-->
<style>
body {
	color: #fff;
	background: #3598dc;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 41px;
	background: #f2f2f2;
	box-shadow: none !important;
	border: none;
}
.form-control:focus {
	background: #e2e2e2;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 400px;
	margin: 30px auto;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #fff;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form h2  {
	color: #333;
	font-weight: bold;
	margin-top: 0;
}
.signup-form hr  {
	margin: 0 -30px 20px;
}    
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;
	background: #3598dc;
	border: none;
	min-width: 140px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #2389cd !important;
	outline: none;
}
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #3598dc;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}
.signup-form .hint-text  {
	padding-bottom: 15px;
	text-align: center;
}
</style>





</head>
<body>
<div class="signup-form">
    <form name="form1" method="post">
		<h2>Sign Up</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
        	<input type="text" class="form-control" name="nic" id="nic" placeholder="NIC Number" required="required">
			<label id="nicerror"></label>
        </div>
		
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
			<label id="passworderror"></label>
        </div>
		<div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required">
			<label id="emailerror"></label>
        </div>

        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
        <input type="submit" name="btn_register" value="Register">
    </form>
	<div class="hint-text">Already have an account? <a href="index.php">Login here</a></div>
</div>
</body>
</html>