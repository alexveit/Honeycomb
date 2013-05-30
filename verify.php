<?php

require_once ('user.php');

$user = new User($_GET['id'],$_GET['first'],$_GET['last'],$_GET['email'],$_GET['pw'],$_GET['user_type'],$_GET['verified'], $_GET['verify_code']);


if($user->good_code($_POST['code']))
{
	$user->set_db_verified();
	$_SESSION['id'] = $user->get_id();
	$_SESSION['first'] = $user->get_first();
	$_SESSION['last'] = $user->get_last();
	$_SESSION['email'] = $user->get_email();
	$_SESSION['pw'] = $user->get_pw();
	$_SESSION['user_type'] = $user->get_type();
	$_SESSION['verified'] = $user->get_verified();
	$_SESSION['verify_code'] = $user->get_code();
	include ('gooduser.php');
}
else
{
	$_SESSION['id'] = $user->get_id();
	$_SESSION['first'] = $user->get_first();
	$_SESSION['last'] = $user->get_last();
	$_SESSION['email'] = $user->get_email();
	$_SESSION['pw'] = $user->get_pw();
	$_SESSION['user_type'] = $user->get_type();
	$_SESSION['verified'] = $user->get_verified();
	$_SESSION['verify_code'] = $user->get_code();
	include ('badcode.php');
}
?>