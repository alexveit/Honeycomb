<?php

require_once ('user.php');

$user;

if(isset($_SESSION['id']))
{
	$user = new User($_SESSION['id'],$_SESSION['first'],$_SESSION['last'],$_SESSION['email'],
		$_SESSION['pw'],$_SESSION['user_type'],$_SESSION['verified'],$_SESSION['verify_code'],$_SESSION['root_dir']);

	setcookie("id", $user->id, time()+600);
	setcookie("first", $user->first, time()+600);
	setcookie("last", $user->last, time()+600);
	setcookie("email", $user->email, time()+600);
	setcookie("pw", $user->pw, time()+600);
	setcookie("user_type", $user->user_type, time()+600);
	setcookie("verified", $user->verified, time()+600);
	setcookie("verify_code", $user->code, time()+600);
	setcookie("root_dir", $user->root_dir, time()+600);
}
else if(isset($_COOKIE['id']))
{
	$user = new User($_COOKIE['id'],$_COOKIE['first'],$_COOKIE['last'],$_COOKIE['email'],
		$_COOKIE['pw'],$_COOKIE['user_type'],$_COOKIE['verified'],$_COOKIE['verify_code'],$_COOKIE['root_dir']);
}
else
{
	include ('index.html');
	exit();
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
					<div>
						<table border="0">
							<tr>
								<?php
									$con = get_db_connection();

									if (isset($_POST['upload']))//has form been submitted
									{
										//pull out file information from temp location on server
										$tmp_name = $_FILES['uploadedfile']['tmp_name'];
										
										
											if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "C:/xampp/htdocs/files_upload/files/veit38/". basename($_FILES['uploadedfile']['name'])))
												echo "File has been successfuly uploaded";
											else
												echo "Error: File not uploaded";
										
									}

									/*********file structure here**********/
									echo " <h3> Directory content </h3>";
									$query = "SELECT * FROM root_dir where name='$user->'";

									//retrieving the root_dir content in db
									if  ($result = mysqli_query($conn, $query)) 
									{
										if (mysqli_num_rows($result) == 1)
										{
											$object = mysqli_fetch_object($result);
											$directory = $object->path;
											$root_dir_name = $object->name;
										}
									}


									//move to veit38 file dir
									$files = glob($directory . "*");
									chdir($directory);


									echo"

									<ol class='tree'>
										
										<li>
											<label for='folder2'> " . $root_dir_name . "</label> <input type='checkbox' id='folder2' /> 
												<ol>";
												foreach ($files as $file)
												{
													$filelink = $directory . basename($file);
													echo "<li class='file'><a href='$filelink'>". basename($file). " </a></li>";
												}

									echo "
												</ol>
										</li>
										<li>
									</ol>
										";
										
									/************file structure ends here************/
									mysqli_close($con);
								?>
								<td style="width:50px"></td>
								<td style='vertical-align:text-top;'>
									<form enctype='multipart/form-data' name='fileupload' action='gooduser.php' method='POST'>
										<input style="text-align:right;" type='file' name='uploadedfile'></br>
										<input class="btn btn-primary" type='submit' name='upload' value='Upload File'>
									</form>
									<?php
									if (isset($_POST['upload']))
									{
										if ($result)
											echo "<b>$filename</b><br><i>has been successfuly uploaded</i>";
										else
											echo "Error: <b>$filename</b><br><i>not uploaded</i>";
									}
									?>
								</td>
							</tr>
						</table>
					</div>
					<div style="position:absolute; top:100px;">
						
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