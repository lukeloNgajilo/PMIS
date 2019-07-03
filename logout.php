<?php 
session_start();
$_SESSION['user_id'] = "";   
 $_SESSION['password'] = ""; 
session_destroy();
header("location:login.php");
?>