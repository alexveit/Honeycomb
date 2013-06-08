<?php
session_start();
/*
$email = $_POST['email'];

$recipient = "alex.wveit@gmail.com";
$subject = "Dropbox Verification Email";

$formcontent = "Test Content";
$mailheader = "From: $email \r\n";

mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
*/

require ('user.php');

$user = new User(0,$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['pass'],$_POST['deptid'],0, 0, 0);

if(!$user->contains_in_db())
{
	$user->add_to_db();
	$_SESSION['id'] = $user->id;
	$_SESSION['first'] = $user->first;
	$_SESSION['last'] = $user->last;
	$_SESSION['email'] = $user->email;
	$_SESSION['pw'] = $user->pw;
	$_SESSION['user_type'] = $user->user_type;
	$_SESSION['verified'] = $user->verified;
	$_SESSION['verify_code'] = $user->code;
	$_SESSION['root_dir'] = $user->root_dir;
	include ('goodsignup.php');
}
else
{
	$_SESSION['email'] = $user->email;
	include ('badsignup.php');
}

?>