<?php

/*
$email = $_POST['email'];

$recipient = "alex.wveit@gmail.com";
$subject = "Dropbox Verification Email";

$formcontent = "Test Content";
$mailheader = "From: $email \r\n";

mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
*/

$val = "id=" . $_SESSION['id'] . "&";
$val .= "first=" . $_SESSION['first'] . "&";
$val .= "last=" . $_SESSION['last'] . "&";
$val .= "email=" . $_SESSION['email'] . "&";
$val .= "pw=" . $_SESSION['pw'] . "&";
$val .= "user_type=" . $_SESSION['user_type'] . "&";
$val .= "verified=" . $_SESSION['verified'] . "&";
$val .= "verify_code=" . $_SESSION['verify_code'] . "&";
$val .= "root_dir=" . $_SESSION['root_dir'];

echo $val;

?>

<html>
<head>
<title>Thank You! - The Honeycomb</title>

<link href="templates/ssdnodes512/css/manage-bootstrap.css" rel="stylesheet">
<link href="templates/ssdnodes512/css/whmcs.css" rel="stylesheet">
<link href="bootstrap.css" rel="stylesheet">
<link href="bootstrap-responsive.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="font-awesome.css" rel="stylesheet">
<link href="ssdnodes.css" rel="stylesheet">
<link href="ssdnodes-responsive.css" rel="stylesheet">
<link href="greentheme.css" rel="stylesheet">


<script type="text/javascript" src="includes/jscript/jquery.js"></script>

<!-- Begin of Alex Veit's functions -->
<script type="text/javascript" src="alexfunctions.js"></script>
<!-- End of Alex Veit's functions -->

<script src="templates/ssdnodes512/js/whmcs.js"></script>
<script src="jquery-1.7.2.min.js"></script>	
<script src="jquerylightboxmin.js"></script>
<script src="bootstrap.js"></script>
<script src="bootstrap-tab.js"></script>
<script src="bootstrap-tooltip.js"></script>


</head>

<body>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<a class="brand" href="index.html">Honeycomb, Inc.</a>

			<div class="nav-collapse">

				<ul class="nav pull-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="loginpage.html">Log In</a></li>
					<!-- <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Log In&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="loginpage.html">Teacher Account </a></li>
							<li><a href="loginpage.html">Student Account </a></li>
							<li class="divider"></li>
							<li><a href="forgotpassword.html">Forgot Password?</a></li>
						</ul>
					</li> -->
				</ul>

			</div><!--/.nav-collapse -->	
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->

<div id="subheader">
	<div class="inner">
		<div class="container">
			<h1>The Honeycomb</h1>
		</div> <!-- /.container -->
	</div> <!-- /inner -->
</div> <!-- /subheader -->

<div id="subpage">	
	<div class="container">
		<div class="page-header">
			<div class="styled_title">
				<?php echo "<h2>Thank you for Signing Up " . $_SESSION['first'] . " " . $_SESSION['last'] . "</h2>"; ?>
				<br />
				<h1>Almost done!</h1>
				<p>An account confirmation email has been sent to <?php echo $_SESSION['email'] ?></p>
			</div>
		</div>
		<form method="post" action="verify.php?<?php echo $val ?>" name="verify">
			Confirmation Code: <input class="input-small" type="text" name="code" id="code" value="" />
			<input class="btn btn-primary" type="submit" name="verify" id="verify" value="Verify" />
		</form>
	</div>
</div>

	<div id="extra">
		<div class="inner">
			<div class="container">
				<div class="row">
					<div class="span4">

					</div> <!-- /span4 -->
					<div class="span4">

					</div> <!-- /span4 -->
				</div> <!-- /row -->
			</div> <!-- /container -->
		</div> <!-- /inner -->
	</div> <!-- /extra -->

<div id="footer">
	<div class="inner">
		<div class="container">
			<div class="row">
				<div id="footer-copyright" class="span4">&copy;</div> <!-- /span4 -->
				<div id="footer-terms" class="span8"></div> <!-- /span8 -->
			</div> <!-- /row -->
		</div> <!-- /container -->
	</div> <!-- /inner -->
</div> <!-- /footer -->

</body>
</html>