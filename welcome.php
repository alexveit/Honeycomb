<?php
session_start();
require_once ('connection.php');

function goodUser($row)
{
	$_SESSION['id'] = $row['id'];
	$_SESSION['first'] = $row['first'];
	$_SESSION['last'] = $row['last'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['pw'] = $row['pw'];
	$_SESSION['user_type'] = $row['user_type'];
	$_SESSION['verified'] = $row['verified'];
	$_SESSION['verify_code'] = $row['verify_code'];
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
	$_SESSION['verify_code'] = $row['verify_code'];
	include ('badpw.php');
}

function pleaseVerify($row)
{
	$_SESSION['id'] = $row['id'];
	$_SESSION['first'] = $row['first'];
	$_SESSION['last'] = $row['last'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['pw'] = $row['pw'];
	$_SESSION['user_type'] = $row['user_type'];
	$_SESSION['verified'] = $row['verified'];
	$_SESSION['verify_code'] = $row['verify_code'];
	include ('goodsignup.php');
}

$con = get_db_connection();

$query = "SELECT * FROM users WHERE email='" . $_POST['username'] . "';";

$result = mysqli_query($con,$query);

mysqli_close($con);

if ($result && $result->num_rows == 1)
{
	$row = mysqli_fetch_array($result);
	if($row['pw'] == $_POST['password'])
	{
		if($row['verified'] == 1)
			goodUser($row);
		else
			pleaseVerify($row);
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

?>