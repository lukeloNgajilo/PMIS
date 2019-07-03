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
						<li class="">
							<a href="manageusers.php" style="border-bottom: 1px solid #a6a6a6;"><i class="lnr lnr-user"></i> <span>Manage users</span></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				
			<div class="panel-body">
				<a  class='btn btn-primary' data-toggle='modal' data-target='#addNewuser'>ADD NEW USER</a>
				<div class="modal fade" id="addNewuser" tabindex="-1" role="dialog" 
				     aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <!-- Modal Header -->
				            <div class="modal-header">
				                <button type="button" class="close" 
				                   data-dismiss="modal">
				                       <span aria-hidden="true">&times;</span>
				                       <span class="sr-only">Close</span>
				                </button>
				                <h4 class="modal-title" id="myModalLabel">
				                    <center><font style="color: ">ADD NEW USER</font></center>
				                </h4>
				            </div>
				            
				            <!-- Modal Body -->
				            <div class="modal-body">
				                
				                <form class="form-horizontal" role="form" action="adduser.php" method="post">
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="text" class="form-control" name="user_id" placeholder="User_ID" required="this" />
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="text" class="form-control"  name="names" placeholder="Names"/>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                    	<select name="department" class="form-control">
											<option value="" disabled selected>Department</option>
											<option value="ict_dp">ICT Department</option>
											<option value="sales_dp">Sales Department</option>
										</select>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <select name="role" class="form-control">
				                        	<option value="" disabled selected>Role</option>
											<option value="admin">Admin</option>
											<option value="user">User</option>
										</select>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="email" class="form-control"  name="email" placeholder="E-mail"/>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <select name="gender" class="form-control">
				                        	<option value="" disabled selected>Gender</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="text" class="form-control"  name="telephone" placeholder="Telephone_No"/>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="text" class="form-control"  name="username" placeholder="Username"/>
				                    </div>
				                  </div>
				                  <div class="form-group">
				                    <div class="col-sm-12">
				                        <input type="password" class="form-control"  name="password" placeholder="Password"/>
				                    </div>
				                  </div>
				               
				              </div>
				            
				            <!-- Modal Footer -->
				            <div class="modal-footer">
				             <input type="submit" value="ADD" name="adduser" class="btn btn-primary">
				             <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE</button>
				            </form>
				            </div>
				        </div>
				    </div>
				</div>
				<p></p>
			          <table class="table table-striped table-hover">
			            <tr style="background:#ADD8E6">
			              <th>User ID</th>
			              <th>Name</th>
			              <th>Department</th>
			              <th>E-mail address</th>
			              <th>Telephone_No</th>
			              <th>Username</th>
			              <th style="color: white">MORE</th>
			            </tr>				
							<?php
							include('connection.php');
							
							$sql="select * from users";
			                 $result=mysqli_query($connection,$sql);

			                  while($rows=mysqli_fetch_array($result))
			                {
			               
			                  $user_id=$rows['user_id'];
			                  $name=$rows['name'];
			                  $department=$rows['department'];
			                  $email_address=$rows['email_address'];
			                  $gender=$rows['gender'];
			                  $telephone=$rows['telephone_no'];
			                  $username=$rows['username'];
			                 									  
			                  echo("<tr>");
			                  echo("<td>$user_id</td>");
			                  echo("<td>$name</td>");
			                  echo("<td>$department</td>");
			                  echo("<td>$email_address</td>");
			                  echo("<td>$telephone</td>");
			                  echo("<td>$username</td>");
			                  echo("<td><a href=''>view</a></td>");
			                  echo("</tr>");
			                  
							}?>
						</table>
				</div>

				<?php  ?>

					<?php
						include('connection.php');
						if(isset($_GET['user_id'])){
						$user_id=$_GET['user_id'];
						$sql="SELECT * FROM users where user_id='$user_id'";
			            $result=mysqli_query($connection,$sql);

			            while($rows=mysqli_fetch_array($result))
			         {?>

					 

						<h3><?php echo $rows['user_id']." - ". $rows['name'];?></h3>
						<h2 class="page-header"><a class='btn btn-danger' href="?del=<?php echo $rows['course_id']; ?>" style="margin-left: 985px">DELETE</a> | <a  class='btn btn-default' data-toggle='modal' data-target='#edituser' style="margin-left: 2px;">EDIT</a></h2>

						<form method="post">
						<table class="detail-view table table-hover table-condensed" style="height: 420px">
							  <tr>
							    <th style="background: #ffefcc;">User_ID</th>
							    <td><?php echo $rows['user_id']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Names</th>
							    <td><?php echo $rows['name']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Department</th>
							    <td><?php echo $rows['department']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Role</th>
							    <td><?php echo $rows['role']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Email Address</th>
							    <td><?php echo $rows['email_address']; ?></td>
							  </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td>&nbsp;</td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Gender</th>
							    <td><?php echo $rows['gender']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Telephone No</th>
							    <td><?php echo $rows['telephone_no']; ?></td>
							  </tr>
							  <tr>
							    <th style="background: #ffefcc;">Username</th>
							    <td><?php echo $rows['username']; ?></td>
							  </tr>
							 

							</table>
							</form>
							<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="">
						   <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <center><h3 class="modal-title" id="exampleModalLongTitle" style="color: orange">EDIT USER DETAILS</h3></center>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <form role="form" action="" method="post">
						        	<h4>
						            <table class="table table table-hover table-condensed">
										<tr>
										    <td>User ID</td>
										    <td><input type="text" name="user_id"   required class="form-control" value="<?php echo $rows['user_id']; ?>" /></td>
										</tr>
										<tr>
										    <td>Names</td>
										    <td><input type="text" name="names" required class="form-control" value="<?php echo $rows['name']; ?>" /></td>
										</tr>
										<tr>
										    <td>Department</td>
										    <td><input type="text" name="department" class="form-control" value="<?php echo $rows['department']; ?>" /></td>
										</tr>
										<tr>
										    <td>Role</td>
										    <td><textarea name="ppose" rows="3" class="form-control" style="width: ; height: 50px"> <?php echo $rows['role']; ?> </textarea></td>
										</tr>
										<tr>
										    <td>Email address</td>
										    <td><input type="email" name="email_address" required id="this" class="form-control"  value="<?php echo $rows['email_address']; ?>" /></td>
										</tr>
										<tr>
										    <td>Gender</td>
										    <td><input type="text" name="gender"  class="form-control"  value="<?php echo $rows['gender']; ?>" /></td>
										</tr>
										<tr>
										    <td>Telephone No</td>
										    <td><input type="text" name="telephone" class="form-control" style="width: " value="<?php echo $rows['telephone_no']; ?>" /></td>
										</tr>
										<tr>
										    <td>Username</td>
										    <td><input type="text" name="username" class="form-control" style="width:" value="<?php echo $rows['username']; ?>" /></td>
										</tr>							  
										</table>
										</h4>			
						          </div>
						        	<div class="modal-footer">
						             <button type="submit" name="save" class="btn btn-primary">SAVE</button>
						             <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE
						             </button>        
						        </form>
						      </div> 
						      </div>

						

				<?php } ?>
				<?php } ?>


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
