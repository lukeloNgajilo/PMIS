<?php
session_start();
if(empty($_SESSION['user_id']) OR empty($_SESSION['password']) ) {  
  
header('Location: login.php?login=access_denied' );
}?>

<!doctype html>
<html lang="en">

<head>
	<title>Projects management information system</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="tools/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="tools/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="tools/linearicons/style.css">
	
	
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="tools/css/main.css">

	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top" 
		style="background-color:rgba(44,62,80,0.4);-webkit-box-shadow: 0 10px 10px -13px #808080; ">
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu"></i></button>
				</div>
				<!-- logo -->
				<div class="navbar-brand">
					<a href="index.php"><img src="images/angtl1.png" style="width: 80px;height: 24px"></a>
				</div>
				<!-- end logo -->
				<div class="navbar-right">
					<!-- search form -->
					<form id="navbar-search" class="navbar-form search-form">
						<input value="" class="form-control" placeholder="Search here..." type="text">
						<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
					</form>
					<!-- end search form -->
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		
		<!-- LEFT SIDEBAR -->
		<div id="left-sidebar" class="sidebar" style="border-right: 1px solid #a6a6a6;background-color: rgba(44,62,80,0.2)">
			<button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
			<div class="sidebar-scroll">
				<div class="user-account">
					
					<div class="dropdown">
						<a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Hello, 
						 <?php 
						 include("connection.php");							
						 $user_id=$_SESSION['user_id'];
						 $uselect = "SELECT * FROM users WHERE username='$user_id'";
				         $result = mysqli_query($connection,$uselect); 
				         $rows = mysqli_num_rows($result);
				         $fetchdata=mysqli_fetch_array($result);
				         $Name=$fetchdata['name'];

				         echo "<strong>$Name</strong>";
				     
				  		?> <i class="fa fa-caret-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right account">
							<li><a href="myprofile.php">My Profile</a></li>

							<li><a href="#">Settings</a></li>
							<li class="divider"></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
				<nav id="left-sidebar-nav" class="sidebar-nav" >
					<ul id="main-menu" class="metismenu">
						<li class="active"><a href="index.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li class="">
							<a href="addprojects.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-magic-wand"></i><span>Add Project</span></a>
						</li>
						<li class="">
							<a href="projdetails.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-file-empty"></i> <span>Project Details</span></a>
						</li>
						<li class="">
							<a href="implstatus.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-pencil"></i> <span>Implementaion status</span></a>
						</li>
						<li class="">
							<a href="report.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-chart-bars"></i> <span>Reports</span></a>
						</li>
						<?php
						 $user_id=$_SESSION['user_id'];
						 $uselect = "SELECT role FROM users WHERE username='$user_id'";
						 $result = mysqli_query($connection,$uselect); 
				         $rows = mysqli_num_rows($result);
				         $fetchdata=mysqli_fetch_array($result);
				         $Name=$fetchdata['role'];

				         if ($Name = "admin") {
				         	echo "<li>
							<a href='manageusers.php' style='border-bottom: 1px solid #a6a6a6;'><i class='lnr lnr-user'></i> <span>Manage users</span></a>
							</li>";}
						else{
				         	echo "";
						}
						?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<h1 class="sr-only">Dashboard</h1>
				
				<!-- MODIFY STATUS DETAILS -->
				
					<div class="panel-content">
						
						<div class="panel-body">
			              
						<?php 
						include('connection.php');
							if(isset($_GET['Proj_code'])){
								$Proj_code=$_GET['Proj_code'];
						 $select = "SELECT * FROM implementation_status where Proj_code='$Proj_code'";
				         $result = mysqli_query($connection,$select); 
				         while($fetch=mysqli_fetch_array($result)){?>
				         	<h3>Update Status Details:</h3>
								<form method="post">
								<h5>
								<table class="table hover" >
								  <tr>
								    <td>Project Code</td>
								    <td><input type="hidden" name="pcode" required class="form-control" value="<?php echo $fetch['Proj_code']; ?>" /><b><?php echo $fetch['Proj_code']; ?></b></td>     
								    <td>Implementation code</td>
								    <td><input type="text" name="icode" required class="form-control" value="<?php echo $fetch['Impl_code']; ?>" /></td>
								  </tr>
								  <tr>
								    <td>Implementation status</td>
								    <td><textarea name="istatus" rows="3"  class="form-control" style="width: 350px; height: 150px" ><?php echo $fetch['Impl_status']; ?></textarea></td>
								    <td>Project status</td>
								    <td><select name="pstatus" class="form-control" value="<?php echo $fetch['Proj_status']; ?>">

									<option value="Completed">Completed</option>
									<option value="Running">Running</option>
									<option value="Stalled">Stalled</option>
									<option value="Terminated">Terminated</option>
									</select></td>
									
								  </tr>
								   <tr>
								    <td>Remarks</td>
								    <td><textarea name="rmarks" rows="3"  class="form-control" style="width: 350px; height: 150px"  ><?php echo $fetch['Remarks']; ?></textarea></td>
								    <td>Action Required</td>
								    <td><textarea name="areq" rows="3" class="form-control" style="width: 350px; height: 150px" ><?php echo $fetch['Action_required']; ?></textarea></td>
								  </tr>
								  <tr>
								    <td>&nbsp;</td>
								    <td>&nbsp;</td>
								    <td>&nbsp;</td>
								    <td><input type="submit" value="SUBMIT" name="isub" class="btn btn-primary pull-right" style="width: 100px;"/></td>
								  </tr>
							 </table>
							 </h5>
							 </form>
							 <?php	
							include('connection.php');		
							if (isset($_POST['isub'])) {
								
							// get the posted data
							$pcode = $_POST['pcode'];
							$icode= $_POST['icode'];
							$istatus= $_POST['istatus'];
							$pstatus=$_POST['pstatus'];
							$rmarks=$_POST['rmarks'];
							$areq = $_POST['areq'];

							$sql="UPDATE implementation_status SET Impl_code='$icode',Impl_status='$istatus', Proj_status='$pstatus', Remarks='$rmarks',Action_required='$areq' WHERE Proj_code='$pcode' ";
							$run_sql=mysqli_query($connection,$sql);
							if($run_sql){
							echo "<script>alert('Implementation status details updated successfully!'); window.location='viewstatusdetails.php'</script>";

							}else {
							echo "<script>alert('Error ! Failed to update'); window.location='modifystatus.php'</script>";

							}
							}
							mysqli_close($connection);
							?>
							<?php } ?>
							<?php } ?>
							
					</div>

				</div>
				<!-- END MODIFY STATUS DETAILS -->

			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class="clearfix"></div>
		<footer>
			<p class="copyright">&copy; 2019. All Rights Reserved.</p>
		</footer>
	</div>
	<!-- END WRAPPER -->

	<!-- Javascript -->
	<script src="tools/jquery/jquery.min.js"></script>
	<script src="tools/bootstrap/js/bootstrap.min.js"></script>
	<script src="tools/metisMenu/metisMenu.js"></script>
	<script src="tools/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="tools/scripts/common.js"></script>
	<script>
	$(function() {

		// progress bars
		$('.progress .progress-bar').progressbar({
			display_text: 'none'
		});

	});
	</script>
</body>

</html>
