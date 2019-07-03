<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="tools/css/login.css">
</head>
<body>
	
	<div class="signin">

		<form method="post" action="login.php">
			<h2 style="color: white">PMIS</h2><br><br>
			<input type="text" name="username" placeholder="Username"><br><br>
			<input type="password" name="pwd" placeholder="Password"><br><br><br>
			<a href=""><input type="submit" id="submit" name="login" value="Login"></a><br>
			
			<div class="container"><br>
				<a href="#" style="margin-right: 0px; font-size: 13px; font-family: Tahoma,Geneva, sans-serif;">Forgot password?</a>
			</div>
			<?php
			session_start();

			  if (isset($_POST['login'])){ 

			  include_once("connection.php");
			  $username=$_POST['username'];
			  $pwd=$_POST['pwd'];
			  //$pwd = md5($pwd);
			  //$password = md5($password);

			  $uselect = "SELECT * FROM users WHERE username='$username' AND password='$pwd'";
			  $result = mysqli_query($connection,$uselect); 
			    $rows = mysqli_num_rows($result);
			    $fetchdata=mysqli_fetch_array($result); 
			    if($rows){
			    session_start();
			    //session_register("user_id", "username");  
			    $_SESSION['user_id']=$_POST['username'];
			    $_SESSION['password'] = $_POST['pwd'];
			    header("location:index.php");

			  }else if($username =="" || $pwd ==""){
			  echo '<p style="text-align:center"><font color="#8B0000" size="3px" >You forgot to fill all the fields </font></p>';
			  }

			  else{
			  echo '<p style="text-align:center"><font color="#8B0000" size="3px" >Wrong username or password ! Try again</font></p>';
			  }
			}
			?>
		</form>
	</div>
</body>
</html>