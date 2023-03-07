<?php 
	$loginBtn = "";
	$error = "";
	
	require "controller/indexController.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PinPostMedia</title>
	<link rel="apple-touch-icon" sizes="180x180" href="resources/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="resources/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="resources/favicon/favicon-16x16.png">
	<link rel="manifest" href="resources/favicon/site.webmanifest">
	<link rel="mask-icon" href="resources/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="PinPostMedia">
	<meta name="application-name" content="PinPostMedia">
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="view/stylesheets/style.css">
	<script src="controller/lazy-loader.js"></script>
</head>
<header>
	<div id="error-messages">
		<?php echo $error?>
	</div>
</header>
<body>
	<nav>
		<ul>
			<li><a href="index.php" class="active">Home</a></li>
			<li class="dropdown"><a href="fileUpload.php">Posten</a></li>
			<li class="dropdown"><a href="gallery.php">Gallerie</a></li>
			<li><a href="#">Über Uns</a></li>
			<li class="dropdown-right-btns"><?php echo $loginBtn?>
				<div class="dropdown-content">
					<a href="#">Profil</a>
				</div>
			</li>
		</ul>
	</nav>
	<div class="container-content">
		<div class="content">
			<h1>PinPostMedia</h1>
			<div class="post-content">
			</div>
				<?php require "controller/output.php"?>
		</div>
		<a href="#header">zum Anfang</a>
	</div>
	<footer>
		
	</footer>
</body>
</html>