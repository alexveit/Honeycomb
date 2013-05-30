<?php

require_once ('user.php');

$user = new User($_SESSION['id'],$_SESSION['first'],$_SESSION['last'],$_SESSION['email'],$_SESSION['pw'],$_SESSION['user_type'],$_SESSION['verified'],$_SESSION['verify_code']);

require_once ('folder.php');

$folders = get_folder_array($user->id);

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
				<?php
				/*
				
				*/
				$depth = get_folder_depth($user->id);
				$con = get_db_connection();
				echo '<ol class="tree">';
				for ($i=0; $i<=$depth; $i++)
				{
					$select = "SELECT * FROM folders WHERE user_id=" . $user->id . " AND level=" . $i . " ORDER BY name;";
					
					$result = mysqli_query($con,$select);		
					
					if($row = mysqli_fetch_array($result))
					{
						echo '<li><label for="folder$i">' . $row['name'] . '</label> <input type="checkbox" checked disabled id="folder$i" />';
						echo '</li>';
					}
					
					
				}
				mysqli_close($con);
				echo '</ol><br>';

				echo '<ol class="tree">
	<li class="file"><a href="">Filey 1</a></li>
	<li>
		<label for="folder1">Folder 1</label> <input type="checkbox" checked disabled id="folder1" /> 
		<ol>
			<li class="file"><a href="document.html.pdf">File 1</a></li>
			<li>
				<label for="subfolder1">Subfolder 1</label> <input type="checkbox" id="subfolder1" /> 
				<ol>
					<li class="file"><a href="">Filey 1</a></li>
					<li>
						<label for="subsubfolder1">Subfolder 1</label> <input type="checkbox" id="subsubfolder1" /> 
						<ol>
							<li class="file"><a href="">File 1</a></li>
							<li>
								<label for="subsubfolder2">Subfolder 1</label> <input type="checkbox" id="subsubfolder2" /> 
								<ol>
									<li class="file"><a href="">Subfile 1</a></li>
									<li class="file"><a href="">Subfile 2</a></li>
									<li class="file"><a href="">Subfile 3</a></li>
									<li class="file"><a href="">Subfile 4</a></li>
									<li class="file"><a href="">Subfile 5</a></li>
									<li class="file"><a href="">Subfile 6</a></li>
								</ol>
							</li>
						</ol>
					</li>
					<li class="file"><a href="">File 3</a></li>
					<li class="file"><a href="">File 4</a></li>
					<li class="file"><a href="">File 5</a></li>
					<li class="file"><a href="">File 6</a></li>
				</ol>
			</li>
		</ol>
	</li>
	<li>
		<label for="folder2">Folder 2</label> <input type="checkbox" id="folder2" /> 
		<ol>
			<li class="file"><a href="">File 1</a></li>
			<li>
				<label for="subfolder2">Subfolder 1</label> <input type="checkbox" id="subfolder2" /> 
				<ol>
					<li class="file"><a href="">Subfile 1</a></li>
					<li class="file"><a href="">Subfile 2</a></li>
					<li class="file"><a href="">Subfile 3</a></li>
					<li class="file"><a href="">Subfile 4</a></li>
					<li class="file"><a href="">Subfile 5</a></li>
					<li class="file"><a href="">Subfile 6</a></li>
				</ol>
			</li>
		</ol>
	</li>
	<li>
		<label for="folder3">Folder 3</label> <input type="checkbox" id="folder3" /> 
		<ol>
			<li class="file"><a href="">File 1</a></li>
			<li>
				<label for="subfolder3">Subfolder 1</label> <input type="checkbox" id="subfolder3" /> 
				<ol>
					<li class="file"><a href="">Subfile 1</a></li>
					<li class="file"><a href="">Subfile 2</a></li>
					<li class="file"><a href="">Subfile 3</a></li>
					<li class="file"><a href="">Subfile 4</a></li>
					<li class="file"><a href="">Subfile 5</a></li>
					<li class="file"><a href="">Subfile 6</a></li>
				</ol>
			</li>
		</ol>
	</li>
	<li>
		<label for="folder4">Folder 4</label> <input type="checkbox" id="folder4" /> 
		<ol>
			<li class="file"><a href="">File 1</a></li>
			<li>
				<label for="subfolder4">Subfolder 1</label> <input type="checkbox" id="subfolder4" /> 
				<ol>
					<li class="file"><a href="">Subfile 1</a></li>
					<li class="file"><a href="">Subfile 2</a></li>
					<li class="file"><a href="">Subfile 3</a></li>
					<li class="file"><a href="">Subfile 4</a></li>
					<li class="file"><a href="">Subfile 5</a></li>
					<li class="file"><a href="">Subfile 6</a></li>
				</ol>
			</li>
		</ol>
	</li>
	<li>
		<label for="folder5">Folder 5</label> <input type="checkbox" id="folder5" /> 
		<ol>
			<li class="file"><a href="">File 1</a></li>
			<li>
				<label for="subfolder5">Subfolder 1</label> <input type="checkbox" id="subfolder5" /> 
				<ol>
					<li class="file"><a href="">Subfile 1</a></li>
					<li class="file"><a href="">Subfile 2</a></li>
					<li class="file"><a href="">Subfile 3</a></li>
					<li class="file"><a href="">Subfile 4</a></li>
					<li class="file"><a href="">Subfile 5</a></li>
					<li class="file"><a href="">Subfile 6</a></li>
				</ol>
			</li>
		</ol>
	</li>
</ol>'
				?>
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