<?php

require ('connect.php'); //connect to database

if(isset($_GET['id'])) 
{ 

// query the server for the picture 
$id = $_GET['id']; 


$query = "SELECT * FROM files WHERE id = '$id'"; 
$result  = mysql_query($query) or die(mysql_error()); 

// define results into variables 
$filename=mysql_result($result,0,"filename"); 
$filesize=mysql_result($result,0,"filesize"); 
$filetype=mysql_result($result,0,"filetype"); 
$data=mysql_result($result,0,"data"); 

// Send the header of the appropriate file...otherwise the php page will be confused
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-length: $filesize"); 
header("Content-type: $filetype"); 
echo $data; 

mysql_close(); 
}else{ 
die("No file ID given..."); 
}


?>