<?php
$server = "localhost";
$username = "root";
$password = "christelle11";
$database = "test";

mysql_connect ("$server", "$username", "$password") or die (mysql_error());
 mysql_select_db ("$database") or die (mysql_error());
?>