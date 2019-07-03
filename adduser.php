<?php
include("connection.php");

if(isset($_POST['adduser'])){

$user_id=$_POST['user_id']; 
$names=$_POST['names']; 
$department=$_POST['department']; 
$role=$_POST['role']; 
$email=$_POST['email']; 
$gender=$_POST['gender']; 
$telephone=$_POST['telephone'];
$username=$_POST['username'];
$password=$_POST['password'];
//$password = md5($password);

$sql="INSERT INTO users  VALUES ('$user_id','$names','$department','$role','$email','$gender','$telephone','$username','$password','')";
$run_sql=mysqli_query($connection,$sql);
if($run_sql){
header ("location:manageusers.php");
}
else {
echo "<script>alert('Error! User was not created successfully'); window.location='manageusers.php'</script>";
}
}
?>