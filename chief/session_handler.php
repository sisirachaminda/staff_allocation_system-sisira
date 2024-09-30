<?php
error_reporting(0);
ob_start();
session_start();
	$ses_user=$_SESSION['login_user'];
	$ses_ukey=$_SESSION['user_keye'];
	$ses_panelno=$_SESSION['panel_no'];
	
	if(!isset($_SESSION['login_user'])){
		header("location:../index.php");
	}


?>