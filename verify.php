<?php
session_start();

require_once ('user.php');

$user = new User($_GET['id'],$_GET['first'],$_GET['last'],
	$_GET['email'],$_GET['pw'],$_GET['user_type'],$_GET['verified'], 
	$_GET['verify_code'],$_GET['root_dir']);


if($user->good_code($_POST['code']))
{
	$user->set_db_verified();
	$_SESSION['id'] = $user->id;
	$_SESSION['first'] = $user->first;
	$_SESSION['last'] = $user->last;
	$_SESSION['email'] = $user->email;
	$_SESSION['pw'] = $user->pw;
	$_SESSION['user_type'] = $user->user_type;
	$_SESSION['verified'] = $user->verified;
	$_SESSION['verify_code'] = $user->code;
	$_SESSION['root_dir'] = $user->root_dir;
	include ('gooduser.php');
}
else
{
	$_SESSION['id'] = $user->id;
	$_SESSION['first'] = $user->first;
	$_SESSION['last'] = $user->last;
	$_SESSION['email'] = $user->email;
	$_SESSION['pw'] = $user->pw;
	$_SESSION['user_type'] = $user->user_type;
	$_SESSION['verified'] = $user->verified;
	$_SESSION['verify_code'] = $user->code;
	$_SESSION['root_dir'] = $user->root_dir;
	include ('badcode.php');
}
?>