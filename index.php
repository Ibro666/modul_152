<?php 
	$loginBtn = "";
	
	require "controller/view-controller.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PinPostMedia</title>
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="PinPostMedia">
	<meta name="application-name" content="PinPostMedia">
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="view/stylesheets/style.css">
	<script src="layz-loader.js"></script>
	<header>
		<div id="error-messages">
			
		</div>
	</header>
</head>
<body>
	<nav>
		<ul>
			<li><a href="index.php" class="active">Home</a></li>
			<li class="dropdown"><a href="#">Posten</a></li>
			<li class="dropdown"><a href="#">Gallerie</a></li>
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
			<div class="post-content">
				<form method="POST" action="controller/upload.php" enctype="multipart/form-data">
					<input type="file" name="datei">
					<button type="submit">Upload</button>
				</form>
				<picture>
					<source srcset="" media="(max-width: 800px)">
					<img src="model\images\test-adam-kool.webp" alt="Das Bild symbolisiert eine landschaft." loading="lazy" onload="loadFullImage(event);">
				</picture>
			</div>
			<div class="post-data">
				<div class="like-btn">
					<button type="submit" name="like">like</button>
				</div>
				<div class="metadata">
					<p>autor</p>
				</div>
			</div>
			<div class="coment-content">
				<textarea name="coment" id="coment" cols="30" rows="10" placeholder="Kommentar"></textarea>
				<button type="submit" name="post-coment">Senden</button>
			</div>


			<div class="title-blog-container">
				<figure>
					<picture>
						<source srcset="" media="">
						<img src="Model\bilder\Politik.svg" alt="mehrere Menschen, die sich Unterhalten" title="Politok" loading="lazy">
						<figcaption>Politok! ein Thema dass nicht weggelassen werden kann</figcaption>
					</picture>
				</figure>
			</div>
   		</div>
		<div class="content">
			<video src="" controls></video>
		</div>
		<a href="#header">zum Anfang</a>
	</div>
	<footer>
		
	</footer>
</body>
</html>