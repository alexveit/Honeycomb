<?php
/*
$email = $_POST['email'];

$recipient = "alex.wveit@gmail.com";
$subject = "Dropbox Verification Email";

$formcontent = "Test Content";
$mailheader = "From: $email \r\n";

mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
*/



require ('user.php');

$user = new User(0,$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['pass'],$_POST['deptid']);

if(!$user->contains_in_db())
{
	$_SESSION['id'] = $user->get_id();
	$_SESSION['first'] = $user->get_first();
	$_SESSION['last'] = $user->get_last();
	$_SESSION['email'] = $user->get_email();
	$_SESSION['pw'] = $user->get_pw();
	$_SESSION['user_type'] = $user->get_type();
	$_SESSION['verified'] = $user->get_verified();
	include ('goodsignup.php');
}
else
{
	$_SESSION['email'] = $user->get_email();
	include ('badsignup.php');
}

?>