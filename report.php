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
				
				<!-- REPORTS -->
				<div class="dashboard-section">
					
					<section class="breadcrumb" style="background-color: #ADD8E6;border:solid black; border-width: 1.3px;">
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
							<ul class="nav navbar-nav navbar-left">
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: black">CHOOSE A REPORT TO GENERATE <span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="?action=stdprojectreport" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#ADD8E6'">STANDARD PROJECT REPORT</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=statusofprojects" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">STATUS OF PROJECTS</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=completedprojects" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">COMPLETED PROJECTS</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=runningprojects" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">RUNNING PROJECTS</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=stalledprojects" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">STALLED PROJECTS</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=terminatedprojects" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">TERMINATED PROJECTS</a></li>
					          </ul>
					        </li>
					      	</ul>

					      	<ul class="nav navbar-nav navbar-right">
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: black">MONTHLY PROJECT REPORTS<span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="?action=jan" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#ADD8E6'">January</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=feb" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">February</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=march" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">March</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=april" style=":active {background: #ADD8E6}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">April</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=may" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">May</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=june" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">June</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=july" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">July</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=aug" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">August</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=sept" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">September</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=oct" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">October</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=nov" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">November</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="?action=dec" style=":active {background: orange}" onMouseOver="this.style.background='#ADD8E6'" onMouseOut="this.style.background='#FEFDFA'">December</a></li>
					          </ul>
					        </li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
					</section>
					   
						
				 </div><!-- /.container-fluid -->
				</div>

				<div class="container-full" style="margin: 50px;border-radius: 7px">


				<!--January-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='jan'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> January Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-01-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End January-->


				<!--February-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='feb'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> February Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-02-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End February-->


				<!--March-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='march'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> March Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-03-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End March-->


				<!--April-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='april'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> April Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-04-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End April-->


				<!--May-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='may'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> May Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-05-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End May-->


				<!--June-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='june'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> June Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-06-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End June-->


				<!--July-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='july'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> July Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-07-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End July-->


				<!--August-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='aug'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> August Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-08-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End August-->

				<!--September-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='sept'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Standard Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-09-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End September-->


				<!--October-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='oct'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> October Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-10-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End October-->

				<!--November-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='nov'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Standard Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-11-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End November-->


				<!--December-->
				<?php
				$action=$_REQUEST['action'];
				if($action=='dec'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> December Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						

						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information WHERE Impl_StartDate like '%-12-%'";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End December-->


				<!-- Action standard project report-->
				
				<?php
				$action=$_REQUEST['action'];
				if($action=='stdprojectreport'){
				 ?>


			
				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Standard Project Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button type="button" class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
									
						<?php
						include('connection.php');
						$get="SELECT * 
						FROM general_information";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="example" class="table table-striped table-hover table-condensed table-bordered table-dark">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Proj.Name</th>
								<th class="pcCodeTd">Proc.Code</th>
								<th class="pcTypeTd">Proc.Type</th>
								<th class="fundTd">Funding</th>
								<th class="bsAppTd">Appear B/P</th>
								<th class="inDateTd">In.Date</th>
								<th class="inCostTd">Cost@In</th>
								<th class="prjImpTd">Proj.Imp</th>
								<th class="prjManTd">Proj.Man</th>
								<th class="prjCoodTd">Proj.Cordt</th>
								<th class="ppsTd">Purpose</th>
								<th class="scopeTd">Scope</th>
								<th class="cntDateTd">Date.Ctrct</th>
								<th class="plnCostTd">Planned.Cst</th>
								<th class="crCostTd">Current.Cst</th>
								<th class="plnDaysTd">PlannedDays</th>
								<th class="strtDateTd">Impl.Strt</th>
								<th class="endDateTd">Impl-End</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>
					</div>

				 <?php } ?>

				<!-- End action standard project report-->


				
				<!-- Action status of projects-->

				<?php
				$action=$_REQUEST['action'];
				if($action=='statusofprojects'){
				 ?>

				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY | <font color="#0F9AC7">Status of projects</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Implemenation Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation Status</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Status</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Remarks</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Action Required</label></th>

									  <th scope="col"><button class="Button btn-primary" onclick="printDiv()">PRINT</button></th>

									</tr>	 
							</table>
							</form>
						</div>
									
						<?php
						include('connection.php');
						$get="SELECT * 
						FROM implementation_status";?>
						<div  style="overflow-x:scroll;">
						<div id="printableTable">
						<table id="results" class="table table-striped table-hover table-condensed table-bordered">
							<tr style="background-color:#ADD8E6">
								<th class="prjCodeTd">Proj.Code</th>
								<th class="prjNameTd">Impl.Code</th>
								<th class="pcCodeTd">Impl.Status</th>
								<th class="pcTypeTd">Remarks</th>
								<th class="fundTd">Action.Required</th>
								<th class="bsAppTd">Proj.Status</th>
							</tr>
							
							<?php $run_sql=mysqli_query($connection,$get);
											    
							while($fetch=mysqli_fetch_array($run_sql)){	?>

						<tr bgcolor="white">
						<?php
						echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Impl_code'].'</td>';
						echo '<td class="pcCodeTd">'.$fetch['Impl_status'].'</td><td class="pcTypeTd">'.$fetch['Remarks'].'</td>';
						echo '<td class="fundTd">'.$fetch['Action_required'].'</td><td class="bsAppTd">'.$fetch['Proj_status'].'</td>';
						}?>
					</tr>
						</table>
						<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
						</div>

					</div> 
				 <?php } ?>

				<!-- End action status of projects -->


				
				
				<!-- Action completed projects-->

				<?php
				$action=$_REQUEST['action'];
				if($action=='completedprojects'){
				 ?>

				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Completed Projects Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						<?php
           				include('connection.php');
					      $get="SELECT * FROM implementation_status, general_information
					      WHERE general_information.Proj_code=implementation_status.Proj_code AND Proj_status='Completed'"?>
      									<div  style="overflow-x:scroll;">
      										<div id="printableTable">
											<table id="results" class="table table-striped table-hover table-condensed table-bordered">
												<tr style="background-color:#ADD8E6">
													<th class="prjCodeTd">Proj.Code</th>
													<th class="prjNameTd">Proj.Name</th>
													<th class="pcCodeTd">Proc.Code</th>
													<th class="pcTypeTd">Proc.Type</th>
													<th class="fundTd">Funding</th>
													<th class="bsAppTd">Appear B/P</th>
													<th class="inDateTd">In.Date</th>
													<th class="inCostTd">Cost@In</th>
													<th class="prjImpTd">Proj.Imp</th>
													<th class="prjManTd">Proj.Man</th>
													<th class="prjCoodTd">Proj.Cordt</th>
													<th class="ppsTd">Purpose</th>
													<th class="scopeTd">Scope</th>
													<th class="cntDateTd">Date.Ctrct</th>
													<th class="plnCostTd">Planned.Cst</th>
													<th class="crCostTd">Current.Cst</th>
													<th class="plnDaysTd">PlannedDays</th>
													<th class="strtDateTd">Impl.Strt</th>
													<th class="endDateTd">Impl-End</th>
													<th>Proj.Status</th>
												</tr>
					      <?php $run_sql=mysqli_query($connection,$get);
					      while($fetch=mysqli_fetch_array($run_sql)){ 	?>

						<tr bgcolor="white"> 

				         <?php 
				         echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						 echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						 echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						 echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						 echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						 echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						 echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						 echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td><td>'.$fetch['Proj_status'].'</td>';
				          
						}		
						mysqli_close($connection);
				        ?>
					</tr>
					</table>
					<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
					</div>
					</div>

				 <?php } ?>

				<!-- End action completed projects -->


				
				<!-- Action running projects-->

				<?php
				$action=$_REQUEST['action'];
				if($action=='runningprojects'){
				 ?>

				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Running Projects Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
									<th scope="col"></th>
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
									</tr>

									<tr>
									<th scope="col">&nbsp;</th>
									  <th scope="col">&nbsp;</th>
									  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
									  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
									  
									  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
									  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
									  
									  <th scope="col"><button class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
									  <th scope="col">&nbsp;</th>
									</tr>	 
							</table>
							</form>
						</div>
						<?php
           				include('connection.php');
					      $get="SELECT * FROM implementation_status, general_information
					      WHERE general_information.Proj_code=implementation_status.Proj_code AND Proj_status='Running'"?>
								<div  style="overflow-x:scroll;">
								<div id="printableTable">
								<table id="results" class="table table-striped table-hover table-condensed table-bordered">
									<tr style="background-color:#ADD8E6">
										<th class="prjCodeTd">Proj.Code</th>
										<th class="prjNameTd">Proj.Name</th>
										<th class="pcCodeTd">Proc.Code</th>
										<th class="pcTypeTd">Proc.Type</th>
										<th class="fundTd">Funding</th>
										<th class="bsAppTd">Appear B/P</th>
										<th class="inDateTd">In.Date</th>
										<th class="inCostTd">Cost@In</th>
										<th class="prjImpTd">Proj.Imp</th>
										<th class="prjManTd">Proj.Man</th>
										<th class="prjCoodTd">Proj.Cordt</th>
										<th class="ppsTd">Purpose</th>
										<th class="scopeTd">Scope</th>
										<th class="cntDateTd">Date.Ctrct</th>
										<th class="plnCostTd">Planned.Cst</th>
										<th class="crCostTd">Current.Cst</th>
										<th class="plnDaysTd">PlannedDays</th>
										<th class="strtDateTd">Impl.Strt</th>
										<th class="endDateTd">Impl-End</th>
										<th>Proj.Status</th>
									</tr>
					      <?php $run_sql=mysqli_query($connection,$get);
					      while($fetch=mysqli_fetch_array($run_sql)){ 	?>

						<tr bgcolor="white"> 

				         <?php 
				         echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						 echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						 echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						 echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						 echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						 echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						 echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						 echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td><td>'.$fetch['Proj_status'].'</td>';
				          
						}		
						mysqli_close($connection);
				        ?>
					</tr>
					</table>
					<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
					</div>
					</div>

				 <?php } ?>

				<!-- End action running projects -->



				<!-- Action stalled projects-->

				<?php
				$action=$_REQUEST['action'];
				if($action=='stalledprojects'){
				 ?>

				 <h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Stalled Projects Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
								<tr>
								<th scope="col"></th>
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
								</tr>

								<tr>
								<th scope="col">&nbsp;</th>
								  <th scope="col">&nbsp;</th>
								  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
								  
								  <th scope="col"><button class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
								  <th scope="col">&nbsp;</th>
								</tr>	 
							</table>
							</form>
						</div>
						<?php
           				include('connection.php');
					      $get="SELECT * FROM implementation_status, general_information
					      WHERE general_information.Proj_code=implementation_status.Proj_code AND Proj_status='Stalled'"?>
								<div  style="overflow-x:scroll;">
								<div id="printableTable">
								<table id="results" class="table table-striped table-hover table-condensed table-bordered">
									<tr style="background-color:#ADD8E6">
										<th class="prjCodeTd">Proj.Code</th>
										<th class="prjNameTd">Proj.Name</th>
										<th class="pcCodeTd">Proc.Code</th>
										<th class="pcTypeTd">Proc.Type</th>
										<th class="fundTd">Funding</th>
										<th class="bsAppTd">Appear B/P</th>
										<th class="inDateTd">In.Date</th>
										<th class="inCostTd">Cost@In</th>
										<th class="prjImpTd">Proj.Imp</th>
										<th class="prjManTd">Proj.Man</th>
										<th class="prjCoodTd">Proj.Cordt</th>
										<th class="ppsTd">Purpose</th>
										<th class="scopeTd">Scope</th>
										<th class="cntDateTd">Date.Ctrct</th>
										<th class="plnCostTd">Planned.Cst</th>
										<th class="crCostTd">Current.Cst</th>
										<th class="plnDaysTd">PlannedDays</th>
										<th class="strtDateTd">Impl.Strt</th>
										<th class="endDateTd">Impl-End</th>
										<th>Proj.Status</th>
									</tr>
					      <?php $run_sql=mysqli_query($connection,$get);
					      while($fetch=mysqli_fetch_array($run_sql)){ 	?>

						<tr bgcolor="white"> 

				         <?php 
				         echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						 echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						 echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						 echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						 echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						 echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						 echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						 echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td><td>'.$fetch['Proj_status'].'</td>';
				          
						}		
						mysqli_close($connection);
				        ?>
					</tr>
					</table>
					<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
					</div>
					</div>


				 <?php } ?>
				<!-- End action stalled projects -->


				<!-- Action terminated projects-->

				<?php
				$action=$_REQUEST['action'];
				if($action=='terminatedprojects'){
				 ?>

				<h3><center>PLEASE SELECT FIELDS TO DISPLAY |<font color="#0F9AC7"> Terminated Projects Report</font></center></h3>
				 	
						<div class="form-check form-check-inline">
							<form method="post">
							<table class="table table-sm detail-view  table-condensed" style="background-color:white;">
								
							<tr>
								<th scope="col"></th>
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCodeCheck" name="c1" value="Proj_code" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Project Code  </label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjNameCheck" name="c2" value="Proj_name" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Project Name</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="pcCodeCheck" name="c3" value="Procurement_code" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Procurement Code</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="pcTypeCheck" name="c4" value="Procurement_type" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Procurement Type  </label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="fundCheck" name="c5" value="Funding" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox2"> Funding</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="bsAppCheck" name="c6" value="AppearsIn_Bussplan" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">AppearsBussPlan</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="inDateCheck" name="c7" value="DateOf_initiation" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox1">Date of Initiation</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="inCostCheck" name="c8" value="CostAt_initiation" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox2">Cost at Initiation</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjImpCheck" name="c9" value="Proj_implementer" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Project Implementer</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjManCheck" name="c10" value="Proj_manager" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox1">Project Manager</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="prjCoodCheck" name="c11" value="Proj_coordinator" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Project Coordinator</label></th>
								</tr>

								<tr>
								<th scope="col">&nbsp;</th>
								  <th scope="col">&nbsp;</th>
								  <th scope="col"><input  type="checkbox" id="ppsCheck" name="c12" value="Purpose" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Purpose</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="scopeCheck" name="c13" value="Scope" style="zoom:1.5" checked><br>
								  <label class="form-check-label" for="inlineCheckbox3">Scope</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="cntDateCheck" name="c14" value="DateOf_contract" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Date of contract</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="plnCostCheck" name="c15" value="Planned_costing" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox2"> Planned costing</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="crCostCheck" name="c16" value="Current_costing" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Current costing</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="plnDaysCheck" name="c17" value="Planned_completion" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox1">Planned completion(days)</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="strtDateCheck" name="c18" value="Impl_StartDate" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Implementation StartDate</label></th>
								  
								  <th scope="col"><input class="form-check-input" type="checkbox" id="endDateCheck" name="c19" value="Impl_EndDate" style="zoom:1.5" checked>
								  <label class="form-check-label" for="inlineCheckbox3">Implementation EndDate</label></th>
								  
								  <th scope="col"><button class="Button btn-primary" onclick="printDiv()">PRINT</button></th>
								  <th scope="col">&nbsp;</th>
								</tr>	 
							</table>
							</form>
						</div>
						<?php
           				include('connection.php');
					      $get="SELECT * FROM implementation_status, general_information
					      WHERE general_information.Proj_code=implementation_status.Proj_code AND Proj_status='Terminated'"?>
      									<div  style="overflow-x:scroll;">
      										<div id="printableTable">
											<table id="results" class="table table-striped table-hover table-condensed table-bordered">
												<tr style="background-color:#ADD8E6">
													<th class="prjCodeTd">Proj.Code</th>
													<th class="prjNameTd">Proj.Name</th>
													<th class="pcCodeTd">Proc.Code</th>
													<th class="pcTypeTd">Proc.Type</th>
													<th class="fundTd">Funding</th>
													<th class="bsAppTd">Appear B/P</th>
													<th class="inDateTd">In.Date</th>
													<th class="inCostTd">Cost@In</th>
													<th class="prjImpTd">Proj.Imp</th>
													<th class="prjManTd">Proj.Man</th>
													<th class="prjCoodTd">Proj.Cordt</th>
													<th class="ppsTd">Purpose</th>
													<th class="scopeTd">Scope</th>
													<th class="cntDateTd">Date.Ctrct</th>
													<th class="plnCostTd">Planned.Cst</th>
													<th class="crCostTd">Current.Cst</th>
													<th class="plnDaysTd">PlannedDays</th>
													<th class="strtDateTd">Impl.Strt</th>
													<th class="endDateTd">Impl-End</th>
													<th>Proj.Status</th>
												</tr>
					      <?php $run_sql=mysqli_query($connection,$get);
					      while($fetch=mysqli_fetch_array($run_sql)){ 	?>

						<tr bgcolor="white"> 

				         <?php 
				         echo '<td class="prjCodeTd">'.$fetch['Proj_code'].'</td><td class="prjNameTd">'.$fetch['Proj_name'].'</td>';
						 echo '<td class="pcCodeTd">'.$fetch['Procurement_code'].'</td><td class="pcTypeTd">'.$fetch['Procurement_type'].'</td>';
						 echo '<td class="fundTd">'.$fetch['Funding'].'</td><td class="bsAppTd">'.$fetch['AppearsIn_BussPlan'].'</td>';
						 echo '<td class="inDateTd">'.$fetch['DateOf_initiation'].'</td><td class="inCostTd">'.$fetch['CostAt_initiation'].'</td>';
						 echo '<td class="prjImpTd">'.$fetch['Proj_implementer'].'</td><td class="prjManTd">'.$fetch['Proj_manager'].'</td>';
						 echo '<td class="prjCoodTd">'.$fetch['Proj_coordinator'].'</td><td class="ppsTd">'.$fetch['Purpose'].'</td>';
						 echo '<td class="scopeTd">'.$fetch['Scope'].'</td><td class="cntDateTd">'.$fetch['DateOf_contract'].'</td>';
						 echo '<td class="plnCostTd">'.$fetch['Planned_costing'].'</td><td class="crCostTd">'.$fetch['Current_costing'].'</td>';
						 echo '<td class="plnDaysTd">'.$fetch['Planned_completion'].'</td><td class="strtDateTd">'.$fetch['Impl_StartDate'].'</td>';
						 echo '<td class="endDateTd">'.$fetch['Impl_EndDate'].'</td><td>'.$fetch['Proj_status'].'</td>';
				          
						}		
						mysqli_close($connection);
				        ?>
					</tr>
					</table>
					<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
					</div>
					</div>

				 <?php } ?>

				<!-- End action terminated projects -->
			

			</div>
					</div>

				</div>
				<!-- END PROJECTS ANALYTICS -->

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
	

	<script src="tools/scripts/jquery-3.2.1.js"></script> 
    <script src="tools/scripts/main.js"></script>
       	
    <!--link type="text/css" href="css/print.css" rel="stylesheet"-->
    <script src="tools/scripts/print.js"></script>
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
