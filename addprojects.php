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

         <!-- ADD NEW PROJECT -->
                <div class="section-heading">
                        <h1 class="page-title">Enter project details</h1>
                </div>
                <form method="post" action="insertproject.php">
                <h5>
                    <table class="detail-view table " style="border:1px solid  #e8e8e8">
                        <tr>
                        <td>Project code</td>
                        <td><input type="text" name="pcode"   required class="form-control" style="width: 200px" /></td>
                        <td>Project name</td>
                        <td><input type="text" name="pname" required class="form-control" style="width: 350px" /></td>
                        </tr>
                        <tr>
                        <td>Procurement code</td>
                        <td><input type="text" name="prcode" class="form-control" style="width: 200px" /></td>
                        <td>Procurement type</td>
                        <td><select name="prtype" class="form-control" style="width: 200px" >

                        <option value="Contract">Contract</option>
                        <option value="LPO">LPO</option>
                        </select></td>
                        </tr>
                        <tr>
                        <td>Funding</td>
                        <td><select name="fund" class="form-control" style="width: 200px" >

                        <option value="Capex">Capex</option>
                        <option value="Support Programme">Support Programme</option>
                        </select></td>
                        <td>Appears in business plan</td>
                        <td><input type="radio" name="inbzp" value="YES" required " >YES<input type="radio" name="inbzp" value="NO"  />NO</td>
                        </tr>
                        <tr>
                        <td>Date of initiation</td>
                        <td><input type="date" id="SelectedDate" name='initdate' class="form-control" style="width: 200px" /></td>
                        <td>Cost at initiation</td>
                        <td><input type="text" name="costInit" required id="this" class="form-control" style="width: 200px" /></td>
                        </tr>
                        <tr>
                        <td>Project Implementer</td>
                        <td><input type="text" name="pimpl"  class="form-control" style="width: 200px" /></td>
                        <td>Project Manager</td>
                        <td><input type="text" name="pman" class="form-control" style="width: 200px"  /></td>
                        </tr>
                        <tr>
                        <td>Project Coordinator</td>
                        <td><input type="text" name="pcoo" class="form-control" style="width: 200px"  /></td>
                        <td>Date of contract</td>
                        <td><input type="date" id="SelectedDate" name='contd' class="form-control" style="width: 200px" /></td>
                        </tr>
                        <tr>
                        <td>Project purpose</td>
                        <td><textarea name="ppose" rows="3" class="form-control" style="width: 350px; height: 150px"   ></textarea></td>
                        <td>Scope</td>
                        <td><textarea name="pscope" rows="3" class="form-control" style="width: 350px; height: 150px"  ></textarea></td>
                        </tr>
                        <tr>
                        <td>Planned costing</td>
                        <td><input type="text" name="pcost"  id="this" class="form-control" style="width: 200px" /></td>
                        <td>Current costing</td>
                        <td><input type="text" name="ccost"  id="this" class="form-control" style="width: 200px" /></td>
                        </tr>
                        <tr>
                        <td>Planned completion(days)</td>
                        <td><?php 
                                $op;
                                for($t=1;$t<=500;$t++){
                                $op.="<option value=".$t.">".$t."</option>";
                                
                                }
                            ?>
                            <select name="pcdays" class="form-control" style="width: 200px" >
                                <?php  echo $op;?>
                            </select></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </tr>
                        <tr>
                        <td>Implementation start date</td>
                        <td><input type="date" id="SelectedDate" name='impstartdate' class="form-control" style="width: 200px"  /></td>
                        <td>Implementation end date</td>
                        <td><input type="date" id="SelectedDate" name='impenddate' class="form-control" style="width: 200px" /></td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="SUBMIT" name="submit" class="btn btn-primary pull-right" style="width: 100px;" /></td>
                        </tr>
                        
                    </table>
                    </h4>
                </h5>
                </form>
				

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
