<?php
session_start();
unset($_SESSION['login_user']);
unset($_SESSION['user_keye']);
session_destroy();
header('Location: index.php');
?>