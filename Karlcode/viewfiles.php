<?php

//require ('connect.php'); //connect to database

$server = "localhost";
$username = "root";
//$password = "christelle11";
$password = "al19862411ex";
$database = "test";

mysql_connect ("$server", "$username", "$password") or die (mysql_error());
mysql_select_db ("$database") or die (mysql_error());

$query = "SELECT id, filename, filesize, filetype FROM files";
$result = mysql_query ($query);

echo "
<table>
	<tr><th>ID</th> <th>Name</th> <th>Size (bytes)</th> <th>Type</th><th></th> </tr>";
	while	($row = mysql_fetch_object ($result))
	{
		echo "<tr><td>$row->id</td> <td>$row->filename</td> <td>$row->filesize</td> <td> <a href='download.php?id=$row->id'> Download </a></td></tr>";
	}
	
echo "</table>";



?>