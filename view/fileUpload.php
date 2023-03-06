<?php 
	$loginBtn = "";
	$error = "";
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
    <title>File-Upload</title>
</head>
<header>
    <div>
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
    <div class="column">
        <div class="window-middle-part">
            <div class="title-login"><h1>File-Upload</h1></div>
            <form method="POST" enctype="multipart/form-data">
                <div class="text-field">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"><!--Client seitige datei grössen limitierung-->
                    <input type="file"  name="file" accept="image/png,image/jpeg,image/webp,image/gif,video/mp4,video/webm,audio/mp3,audio/wav" required><!--imagefileformat client seitig begrenzen-->
                </div>
                <div class="button-field">
                     <button type="submit" name="submit">Upload</button>
                </div>
                <div class="button-field">
                    <button type="button" onclick="document.location='../index.php'">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
	<footer>
		
	</footer>
    <?php require_once "../controller/upload.php" ?>
</body>
</html>