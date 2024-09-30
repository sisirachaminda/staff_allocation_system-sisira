<?php
include 'db-connect.php';
session_start();

$cdate=date("Y-m-d");

$selectDuration = "SELECT sdate, edate FROM info WHERE name = 'appCall'";
$resultDuration = $conn->query($selectDuration);	
while($rows = $resultDuration->fetch_assoc()){
        $sdate = $rows['sdate'];  
        $edate = $rows['edate'];   
}
?>

<?php
if(isset($_POST['btn_login'])){
	$nic = trim(mysqli_real_escape_string($conn, $_POST['nic']));
	$enter_password = MD5($_POST['password']);

	
		$select1 = "SELECT * FROM examiner WHERE nic ='$nic' AND password='$enter_password'";
		$result1 = $conn->query($select1);
		if ($result1->num_rows > 0) {
			
			while($rows1 = $result1->fetch_assoc()){
				$ukey = $rows1['id'];  
			}
			$_SESSION['login_user'] = $nic;
			$_SESSION['user_keye'] = $ukey;
			
			echo "<script>
					window.location.href='home.php';
				</script>";
			session_register("login_user","user_keye");
			
		}
		else{
			echo "<script>
				alert('User Name or password invalid!')
				window.location.href = 'index.php';
			</script>";
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
			<h1>Login</h1>
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
					<label class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></label>
					<input class="form-Control validate" type="text" name="nic" placeholder="NIC Number" id="nic" required>
				</div>
				
				<div class="input-group">
					<label class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></label>
					<input class="form-Control" type="password" name="password" placeholder="Password" id="password" required>
				</div>
				<input type="submit" name="btn_login" value="Login">
			</form>
			<?php
				
                $select = "SELECT sdate, edate FROM info WHERE name = 'appCall'";
				$result = $conn->query($select);	
				if ($result->num_rows > 0) {
					while($rows = $result->fetch_assoc()){
						$sdate = $rows['sdate'];  
						$edate = $rows['edate'];   
					}
					
					if(($sdate < $cdate) && ($cdate < $edate)) {
						echo '
						<div class="text-center mt-2">
							<p>Not a member? <a href="register.php">Register</a></p>	
						</div>';
					}
				}
				
                
			?>
		</div>
	</body>
</html>