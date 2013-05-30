<?php

require_once ('user.php');

$user;
$val;
if(isset($_SESSION['id']))
{
	global $user;
	
	global $val;
	
	$val = "id=" . $_SESSION['id'] . "&";
	$val .= "first=" . $_SESSION['first'] . "&";
	$val .= "last=" . $_SESSION['last'] . "&";
	$val .= "email=" . $_SESSION['email'] . "&";
	$val .= "pw=" . $_SESSION['pw'] . "&";
	$val .= "user_type=" . $_SESSION['user_type'] . "&";
	$val .= "verified=" . $_SESSION['verified'] . "&";
	$val .= "verify_code=" . $_SESSION['verify_code'];
	$user = new User($_SESSION['id'],$_SESSION['first'],$_SESSION['last'],$_SESSION['email'],$_SESSION['pw'],$_SESSION['user_type'],$_SESSION['verified'],$_SESSION['verify_code']);
}
else
{
	global $user;
	
	global $val;
	
	$val = "id=" . $_GET['id'] . "&";
	$val .= "first=" . $_GET['first'] . "&";
	$val .= "last=" . $_GET['last'] . "&";
	$val .= "email=" . $_GET['email'] . "&";
	$val .= "pw=" . $_GET['pw'] . "&";
	$val .= "user_type=" . $_GET['user_type'] . "&";
	$val .= "verified=" . $_GET['verified'] . "&";
	$val .= "verify_code=" . $_GET['verify_code'];
	
	$user = new User($_GET['id'],$_GET['first'],$_GET['last'],$_GET['email'],$_GET['pw'],$_GET['user_type'],$_GET['verified'], $_GET['verify_code']);
}

/*require_once ('folder.php');

$folders = get_folder_array($user->id);*/

require_once ('connection.php');

//$con = get_db_connection();

function DataProcessingFunction()
{
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
		
		global $user;
		
		//send to database
		$query = "INSERT INTO files (user_id, folder_id, data, filename, filesize, filetype) 
					VALUES ('$user->id', 0, '$data', '$filename', '$filesize', '$filetype')";
					
		//echo $query;
		
		$server = "localhost";
		$username = "root";
		//$password = "christelle11";
		$password = "al19862411ex";
		$database = "test";

		mysql_connect ("$server", "$username", "$password") or die (mysql_error());
		mysql_select_db ("$database") or die (mysql_error());
		
		$result = mysql_query ($query);
	}
}

DataProcessingFunction();
/*
if (isset($_POST['upload']))
{
	$DataProcessed = DataProcessingFunction();
}

if (isset($DataProcessed) && $DataProcessed)
{
  header("Location: gooduser.php?$val");
  exit();
}
*/
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
					<div style="position:relative; left:50%;">
						<form enctype='multipart/form-data' name='fileupload' action='gooduser.php?<?php echo $val ?>' method='POST'>
							<input type='file' name='uploadedfile'></br>
							<input class="btn btn-primary" type='submit' name='upload' value='Upload File'>
						</form>
					</div>
					<div style="position:relative; top:-100px">
						<?php

						//require ('connect.php'); //connect to database

						$server = "localhost";
						$username = "root";
						//$password = "christelle11";
						$password = "al19862411ex";
						$database = "test";

						mysql_connect ("$server", "$username", "$password") or die (mysql_error());
						mysql_select_db ("$database") or die (mysql_error());

						//$query = "SELECT * id, filename, filesize, filetype FROM files";
						$query = "SELECT id, user_id, folder_id, filename, filesize, filetype FROM files";
						$result = mysql_query ($query);

						echo "
						<table border='1' style='width:500px'>
							<tr><th>ID</th> <th>UserID</th> <th>Folder</th> <th>Name</th> <th>Size(bytes)</th> <th>Type</th></tr>";
							while	($row = mysql_fetch_object ($result))
							{
								echo 	"<tr>
											<td style='text-align:center'>$row->id</td>
											<td style='text-align:center'>$row->user_id</td>
											<td style='text-align:center'>$row->folder_id</td>
											<td style='text-align:center'>$row->filename</td>
											<td style='text-align:center'>$row->filesize</td>
											<td style='text-align:center'><a href='download.php?id=$row->id'>Download</a></td>
										</tr>";
							}
							
						echo "</table>";



						?>
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