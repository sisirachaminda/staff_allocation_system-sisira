<?php
include 'db-connect.php';
include 'session_handler.php';

$cdate=date("Y-m-d");
$cyear=date("Y");

?>

<?php
if(isset($_POST['btn_change'])){
	$pw1=$_POST['oldpassword'];
	$pw2=$_POST['password'];
	$pw3=$_POST['confirmpassword'];
	
	$oldpw=MD5($pw1);
	
	$select1 = "SELECT * FROM principles WHERE year1='$cyear' AND school='$ses_user' AND password='$oldpw'";
	$result1 = $conn->query($select1);
	if ($result1->num_rows == 0) {
		echo "<script>
				alert('Incorrect Old Password')
				window.location.href = 'chgpwd.php';
			</script>";
		
	}
	else{
		if($pw2==$pw3){
			$pass=MD5($pw2);
			
			if ($stmt = $conn->prepare("UPDATE principles SET password='$pass'
														WHERE year1='$cyear' 
														AND school='$ses_user'")) {
				$stmt->execute();
				echo "<script>
					alert('Successfully Change Password!')
					window.location.href = 'home.php';
				</script>";
			}
		
			
		}
		else{
			echo "<script>
				alert('Not Match Password')
				window.location.href = 'chgpwd.php';
			</script>";
			
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head><meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Staff Allocation system</title> 
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="../css/style_index.css" rel="stylesheet" type="text/css">
		<script src="../assets/js/jquery.3.2.1.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	
		<style>
			.input-group {
				margin-left: 20px;
			}
			#nicerror {
				margin-left: -100px;
			}
			img {
				width: 100%;
			}
		</style>
	</head>
	<body>
		<img src="../images/heading.png">
		<div class="login">
			<h1 align="center">Change Password</h1>
			<h1 align="center">User Name: <?php echo $ses_user ?></h1>
			<script>
				$(window).bind("pageshow", function() {
					var form = $('form'); 
					// let the browser natively reset defaults
					form[0].reset();
				});
				$('form').each(function() { 
					this.reset();
				});
			</script>
			
			<form  method="post">
				<script>$('form').each(function() { this.reset() });</script>
				
				<div class="input-group">
					<label class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></label>
					<input class="form-Control" type="password" name="oldpassword" placeholder="Old Password" id="password" required>
				</div>
				<div class="input-group">
					<label class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></label>
					<input class="form-Control" type="password" name="password" placeholder="Password" id="password" required>
				</div>
				<div class="input-group">
					<label class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></label>
					<input class="form-Control" type="password" name="confirmpassword" placeholder="Conform Password" id="password" required>
				</div>
				<input type="submit" name="btn_change" value="Change Password">
			</form>
			
		</div>
	</body>
</html>