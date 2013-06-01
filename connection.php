<?php

function get_db_connection()
{
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
	
	return $con;
}

function connect()
{
	$server = "localhost";
	$username = "root";
	//$password = "christelle11";
	$password = "al19862411ex";
	$database = "test";

	mysql_connect ("$server", "$username", "$password") or die (mysql_error());
	mysql_select_db ("$database") or die (mysql_error());
}
?>
