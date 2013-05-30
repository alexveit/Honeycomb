<?php

//require ('connect.php'); //connect to database

$server = "localhost";
$username = "root";
//$password = "christelle11";
$password = "al19862411ex";
$database = "test";

$con = mysqli_connect($server,$username,$password,$database);

// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	return false;
}

if (isset($_POST['upload']))//has form been submitted
{
	//pull out file information from temp location on server
	$tmp_name = $_FILES['uploadedfile']['tmp_name'];
	$filetype = $_FILES['uploadedfile']['type'];
	$filesize = $_FILES['uploadedfile']['size'];
	$filename = $_FILES['uploadedfile']['name'];
	
	//extract the file data
	$data = fopen($tmp_name, 'rb');
	$data = fread ($data, $filesize);
	$data = addslashes($data); //adding slashes so it doesnot break anything
	
	//send to database
	$query = "INSERT INTO files (data, filename, filesize, filetype) 
				VALUES ('$data', '$filename', '$filesize', '$filetype')";
	$result = mysql_query ($query);
	if ($result)
		echo "File has been successfuly uploaded";
	else
		echo "Error: File not uploaded";
}

//Form to upload file
echo "
	<form enctype='multipart/form-data' name='fileupload' action='index.php' method='POST'>
		<input type='file' name='uploadedfile'></br>
		<input type='submit' name='upload' value='Upload File'>
	</form>
";

echo "
<a href='viewfiles.php'> View my files</a>";

mysqli_close($con);
?>