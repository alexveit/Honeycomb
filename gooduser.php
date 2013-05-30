<?php

require_once ('user.php');

$user = new User($_SESSION['id'],$_SESSION['first'],$_SESSION['last'],$_SESSION['email'],$_SESSION['pw'],$_SESSION['user_type'],$_SESSION['verified'],$_SESSION['verify_code']);

if (isset($_POST['upload']))//has form been submitted
{
	//pull out file information from temp location on server
	$tmp_name = $_FILES['uploadedfile']['tmp_name'];
	$filetype = $_FILES['uploadedfile']['type'];
	$filesize = $_FILES['uploadedfile']['size'];
	$filename = $_FILES['uploadedfile']['name'];
	
	//extract the file data
	$data = fopen($tmp_name, 'rb');
	$data = fread ($data, $filesize);
	$data = addslashes($data); //adding slashes so it doesnot break anything
	
	$con = get_db_connection();
	
	//send to database
	$query = "INSERT INTO files (user_id, folder_id, data, filename, filesize, filetype) 
				VALUES ('$user->id', 0, '$data', '$filename', '$filesize', '$filetype')";
	$result = mysqli_query($con,$query);
	if ($result)
		echo "File has been successfuly uploaded";
	else
		echo "Error: File not uploaded";
}

?>

<html>
<head>
<title>Weccome! - The Honeycomb</title>

<link href="templates/ssdnodes512/css/manage-bootstrap.css" rel="stylesheet">
<link href="templates/ssdnodes512/css/whmcs.css" rel="stylesheet">
<link href="bootstrap.css" rel="stylesheet">
<link href="bootstrap-responsive.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="font-awesome.css" rel="stylesheet">
<link href="ssdnodes.css" rel="stylesheet">
<link href="ssdnodes-responsive.css" rel="stylesheet">
<link href="greentheme.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="treeview/_styles.css" media="screen">


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
					<li><a href="index.html">Log out</a></li>
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
				<h2>Wealcome back <?php echo $user->get_first_last(); ?> </h2>
				<br>
				<div>
					<div style="position:relative; left:70%;">
						<form enctype='multipart/form-data' name='fileupload' action='gooduser.php' method='POST'>
							<input type='file' name='uploadedfile'></br>
							<input class="btn btn-primary" type='submit' name='upload' value='Upload File'>
						</form>
					</div>
				</div>
			</div>
		</div>
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