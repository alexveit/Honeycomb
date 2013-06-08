<?php

if(isset($_COOKIE['id']))
{
	setcookie("id", "", 0);
	setcookie("first", "", 0);
	setcookie("last", "", 0);
	setcookie("email", "", 0);
	setcookie("pw", "", 0);
	setcookie("user_type", "", 0);
	setcookie("verified", "", 0);
	setcookie("verify_code", "", 0);
}

include ("index.html");

?>