<?php

$query = "SELECT * FROM users WHERE email='" . $_POST['username'] . "';";

//echo $_POST['username'] . "<br>";

//echo $query . "<br>";;

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
	return;
}

//echo $ins;

$result = mysqli_query($con,$query);


function goodUser($row)
{
	$_SESSION['id'] = $row['id'];
	$_SESSION['first'] = $row['first'];
	$_SESSION['last'] = $row['last'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['pw'] = $row['pw'];
	$_SESSION['user_type'] = $row['user_type'];
	$_SESSION['verified'] = $row['verified'];
	include ('gooduser.php');
}

function badUser()
{
	$_SESSION['email'] = $_POST['username'];
	include ('baduser.php');
}

function badPw($row)
{
	$_SESSION['id'] = $row['id'];
	$_SESSION['first'] = $row['first'];
	$_SESSION['last'] = $row['last'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['pw'] = $row['pw'];
	$_SESSION['user_type'] = $row['user_type'];
	$_SESSION['verified'] = $row['verified'];
	include ('badpw.php');
}


if ($result && $result->num_rows == 1)
{
	$row = mysqli_fetch_array($result);
	if($row['pw'] == $_POST['password'])
	{
		goodUser($row);
	}
	else
	{
		badPw($row);
	}
}
else
{
	badUser();
}

mysqli_close($con);

?>