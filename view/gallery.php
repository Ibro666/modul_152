<?php 
    $error = "";
    
    require "controller/indexController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../resources/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../resources/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../resources/favicon/favicon-16x16.png">
    <link rel="manifest" href="../resources/favicon/site.webmanifest">
    <link rel="mask-icon" href="../resources/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="PinPostMedia">
    <meta name="application-name" content="PinPostMedia">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" type="text/css" href="view/stylesheets/style.css">
    <title>Galerie</title>
</head>
<header>
    <div id="error-messages">
        <?php echo $error?>
    </div>
</header>
<body>
	<div class="response-nav-container"></div>
    <nav>
		<div class="nav-container">
			<div class="logo">
				<a href="index.php"><img src="resources/logo/ppm-logo.png"></a>
			</div>
			<div class="menu">
				<div class="item-1"><a href="index.php" class="active">Home</a></div>
				<div class="dropdown"><a href="fileUpload.php">Posten</a></div>
				<div class="dropdown"><a href="gallery.php">Gallerie</a></div>
				<div class="item-4"><a href="about.php">ÜberUns</a></div>
				<div class="dropdown-right-btns item-5"><?php echo $loginBtn?></div>
			</div>
			<div class="nav-list">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</nav>
	<div class="container-content">
		<div class="content">
			<h1>Galerie</h1>
			<div class="post-content">
				<div class="gallery-content">
					<?php require "controller/galleryController.php" ?>
				</div>
			</div>
   		</div>
		<a href="#header">zum Anfang</a>
	</div>
	<!-- <script src="../controller/lazy-loader.js"></script> -->
	<script src="controller/lightbox.js"></script>
	<script src="controller/nav-animation.js"></script>
</body>
</html>