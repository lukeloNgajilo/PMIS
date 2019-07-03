<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1"
cellspacing="1" class="box">
<tr>
<td>please select a file</td></tr>
<tr>
<td>
<input type="hidden" name="MAX_FILE_SIZE"
value="16000000">
<input name="userfile" type="file" id="userfile"> 
</td>
<td width="80"><input name="upload"
type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST['upload'])&&$_FILES['userfile']['size']>0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$fileType=($_FILES['userfile']['type'])  ;
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}
$con=mysqli_connect('localhost', 'root', '','projectdb') or die(mysql_error());
if($con){
$query = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
$run_sql=mysqli_query($con,$query) or die('Error, query failed'); 

echo "<br>File $fileName uploaded<br>";
}else { echo "file upload failed"; }
} 
?>
</body>
</html>



