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
				<div class="panel-body">
				<?php
				include('connection.php');
				if(isset($_GET['Proj_code'])){
					$Proj_code=$_GET['Proj_code'];
					$sql="SELECT * FROM general_information where Proj_code='$Proj_code'";
		             $result=mysqli_query($connection,$sql);

		              while($rows=mysqli_fetch_array($result))
		            {?>
				<h3><?php echo $rows['Proj_code']." - ". $rows['Proj_name'];?></h3>
				<h2 class="page-header"><a  class='btn btn-primary' data-toggle='modal' data-target='#editpdetails'>EDIT</a></h2>
				<form method="post">
				<table class="detail-view table table-hover table-condensed" style="height: 500px" id="viewdetails">
					  <tr>
					    <th style="background: #ADD8E6;">Project code</th>
					    <td><?php echo $rows['Proj_code']; ?></td>
					    <th style="background:#ADD8E6;">Project name</th>
					    <td><?php echo $rows['Proj_name']; ?></td>
					  </tr>
					  <tr>
					    <th style="background:#ADD8E6;">Procurement code</th>
					    <td><?php echo $rows['Procurement_code']; ?></td>
					    <th style="background:#ADD8E6;">Procurement type</th>
					    <td><?php echo $rows['Procurement_type']; ?></td>
					  </tr>
					  <tr>
					    <th style="background:#ADD8E6;">Funding</th>
					    <td><?php echo $rows['Funding']; ?></td>
					    <th style="background: #ADD8E6;">Appears in business plan</th>
					    <td><?php echo $rows['AppearsIn_BussPlan']; ?></td>
					  </tr>
					  <tr>
					    <th style="background: #ADD8E6;">Date of initiation</th>
					    <td><?php echo $rows['DateOf_initiation']; ?></td>
					    <th style="background: #ADD8E6;">Cost at initiation</th>
					    <td><?php echo $rows['CostAt_initiation']; ?></td>
					  </tr>
					  <tr>
					    <th style="background:#ADD8E6">Project Implementer</th>
					    <td><?php echo $rows['Proj_implementer']; ?></td>
					    <th style="background: #ADD8E6">Project Manager</th>
					    <td><?php echo $rows['Proj_manager']; ?></td>
					  </tr>
					  <tr>
					    <th style="background: #ADD8E6">Project Coordinator</th>
					    <td><?php echo $rows['Proj_coordinator']; ?></td>
					    <th style="background: #ADD8E6">Date of contract</th>
					    <td><?php echo $rows['DateOf_contract']; ?></td>
					  </tr>
					  <tr>
					    <th style="background:#ADD8E6">Project purpose</th>
					    <td><?php echo $rows['Purpose']; ?></td>
					    <th style="background: #ADD8E6">Scope</th>
					    <td><?php echo $rows['Scope']; ?></td>
					  </tr>
					  <tr>
					    <th style="background: #ADD8E6">Planned costing</th>
					    <td><?php echo $rows['Planned_costing']; ?></td>
					    <th style="background: #ADD8E6">Current costing</th>
					    <td><?php echo $rows['Current_costing']; ?></td>
					  </tr>
					  <tr>
					    <th style="background: #ADD8E6">Planned completion(days)</th>
					    <td><?php echo $rows['Planned_completion']; ?></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <th style="background:#ADD8E6">Implementation start date</th>
					    <td><?php echo $rows['Impl_StartDate']; ?></td>
					    <th style="background:#ADD8E6">Implementation end date</th>
					    <td><?php echo $rows['Impl_EndDate']; ?></td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					 

					</table>
					</form>

					<div class="modal fade" id="editpdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="">
				   <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <center><h3 class="modal-title" id="exampleModalLongTitle">EDIT PROJECT DETAILS</h3></center>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form role="form" action="editProject.php" method="post">
				        	<h5>
				            <table class="table table table-hover table-condensed">
								<tr>
								    <td>Project code</td>
								    <td><input type="text" name="pcode"   required class="form-control" value="<?php echo $rows['Proj_code']; ?>" /></td>
								</tr>
								<tr>
								    <td>Project name</td>
								    <td><input type="text" name="pname" required class="form-control" value="<?php echo $rows['Proj_name']; ?>" /></td>
								</tr>
								<tr>
								    <td>Procurement code</td>
								    <td><input type="text" name="prcode" class="form-control" value="<?php echo $rows['Procurement_code']; ?>" /></td>
								</tr>
								<tr>
								    <td>Procurement type</td>
								    <td><select name="prtype" class="form-control" value="<?php echo $rows['Procurement_type']; ?>">

									<option value="Contract">Contract</option>
									<option value="LPO">LPO</option>
									</select></td>
								</tr>
								<tr>
								    <td>Funding</td>
								    <td><select name="fund" class="form-control" style="width: 200px" value="<?php echo $rows['Funding']; ?>" >

									<option value="Capex">Capex</option>
									<option value="Support Programme">Support Programme</option>
									</select></td>
								</tr>
								<tr>
								    <td>Appears in business plan</td>
								    <td><input type="radio" name="inbzp" value="YES" required " value="<?php echo $rows['AppearsIn_BussPlan']; ?>" >YES<input type="radio" name="inbzp" value="NO"  value="<?php echo $rows['AppearsIn_BussPlan']; ?>" />NO</td>
								</tr>
								<tr>
								    <td>Date of initiation</td>
								    <td><input type="date" id="SelectedDate" name='initdate' class="form-control" style="width: 200px" value="<?php echo $rows['DateOf_initiation']; ?>" /></td>
								</tr>
								<tr>
								    <td>Cost at initiation</td>
								    <td><input type="text" name="costInit" required id="this" class="form-control" style="width: 200px" value="<?php echo $rows['CostAt_initiation']; ?>" /></td>
								</tr>
								<tr>
								    <td>Project Implementer</td>
								    <td><input type="text" name="pimpl"  class="form-control" style="width: 200px" value="<?php echo $rows['Proj_implementer']; ?>" /></td>
								</tr>
								<tr>
								    <td>Project Manager</td>
								    <td><input type="text" name="pman" class="form-control" style="width: " value="<?php echo $rows['Proj_manager']; ?>" /></td>
								</tr>
								<tr>
								    <td>Project Coordinator</td>
								    <td><input type="text" name="pcoo" class="form-control" style="width:" value="<?php echo $rows['Proj_coordinator']; ?>" /></td>
								</tr>
								<tr>
								    <td>Date of contract</td>
								    <td><input type="date" id="SelectedDate" name='contd' class="form-control" style="width: 200px" value="<?php echo $rows['DateOf_contract']; ?>" /></td>
								</tr>
								<tr>
								    <td>Project purpose</td>
								    <td><textarea name="ppose" rows="3" class="form-control" style="width: ; height: 50px"> <?php echo $rows['Purpose']; ?> </textarea></td>
								</tr>
								<tr>
								    <td>Scope</td>
								    <td><textarea name="pscope" rows="3" class="form-control" style="width: ; height: 50px"> <?php echo $rows['Scope']; ?> </textarea></td>
								</tr>
								<tr>
								    <td>Planned costing</td>
								    <td><input type="text" name="pcost"  id="this" class="form-control" style="width:" value="<?php echo $rows['Planned_costing']; ?>" /></td>
								</tr>
								<tr>
								    <td>Current costing</td>
								    <td><input type="text" name="ccost"  id="this" class="form-control" style="width: 200px" value="<?php echo $rows['Current_costing']; ?>" /></td>
								</tr>
								<tr>
								    <td>Planned completion(days)</td>
								    <td><?php 
										  $op;
										  for($t=1;$t<=500;$t++){
										 $op.="<option value=".$t.">".$t."</option>";
										  
										  }
										  ?>
						                <select name="pcdays" class="form-control" value="<?php echo $rows['Planned_completion']; ?>" >
						                  <?php  echo $op;?>
						                </select></td>
						        </tr>
								<tr>
								    <td>Implementation start date</td>
								    <td><input type="date" id="SelectedDate" name='impstartdate' class="form-control" style="width: 200px" value="<?php echo $rows['Impl_StartDate']; ?>" /></td>
								</tr>
								<tr>
								    <td>Implementation end date</td>
								    <td><input type="date" id="SelectedDate" name='impenddate' class="form-control" style="width: " value="<?php echo $rows['Impl_EndDate']; ?>" /></td>
								</tr>
																			  
								</table>
								</h5>			
				          </div>
				        	<div class="modal-footer">
				             <input type="submit" value="SAVE" name="save" class="btn btn-primary">
				             <button type="button" class="btn btn-default" data-dismiss="modal"> CLOSE
				             </button>

				                
				        </form>
				      </div> 
				      </div>
					</div>
				  	}
					<?php } ?>
					<?php } ?>				
				</div>
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
