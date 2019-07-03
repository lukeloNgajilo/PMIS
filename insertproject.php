<?php	
include('connection.php');

if (isset($_POST['submit'])) {
	
// get the posted data
 $pcode =trim($_POST['pcode']);
 $pname = trim($_POST['pname']);
 $prcode= trim($_POST['prcode']);
 $prtype=trim($_POST['prtype']);
 $fund=trim($_POST['fund']);
 $inbusplan = trim($_POST['inbzp']);
 $initdate = trim($_POST['initdate']);
 $costInit = trim($_POST['costInit']);
 $pimpl=trim($_POST['pimpl']);
 $pman=trim($_POST ['pman']);
 $pcoo=trim($_POST ['pcoo']);
 $contdate = trim($_POST ['contd']);
 $ppose = trim($_POST ['ppose']);
 $pscope=trim($_POST ['pscope']);
 $pcost = trim($_POST ['pcost']);
 $ccost=trim($_POST ['ccost']);
 $pcdays=trim($_POST ['pcdays']);
 $impstartdate=trim($_POST ['impenddate']);
 $impenddate=trim($_POST ['impenddate']);


$checkpcode=mysqli_query("SELECT * FROM general_information where 1 and Proj_code='$pcode'");
  $outpcode=mysqli_fetch_array($checkpcode);
   $rowpcode=mysqli_num_rows($checkpcode);
 if($rowpcode > 0 ){
 echo "<script>alert('Project code already exists!'); window.location='addprojects.php'</script>";

 }
else if( $pcode=="")
{
 echo "<script>alert('Project code cannot be empty'); window.location='addprojects.php'</script>";

}
else{

$sql = "INSERT INTO general_information VALUES( '$pcode', '$pname', '$prcode', '$prtype', '$fund', '$inbusplan','$initdate','$costInit', '$pimpl', '$pman','$pcoo', '$ppose', '$pscope','$contdate', '$pcost','$ccost','$pcdays', '$impstartdate', '$impenddate')";
if (mysqli_query($connection, $sql)) { 

	echo "<script>alert('New record added successfully!'); window.location='index.php'</script>";
} 
else {
	    echo "<script>alert('Error! Project details were not added successfully'); window.location='addprojects.php'</script>";
	}

	mysqli_close($connection);
}
}
?>