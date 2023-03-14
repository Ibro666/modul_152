<?php 
	$loginBtn = "";
	$error = "";

    require_once "controller/upload.php";
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
    <script src="../controller/lazy-loader.js"></script>
    <title>File-Upload</title>
</head>
<header>
    <div>
        <?php echo $error?>
    </div>
</header>
<body>
    <div class="column">
        <div class="window-middle-part">
            <div class="title-login"><h1>File-Upload</h1></div>
            <form method="POST" id="file-upload" enctype="multipart/form-data">
                <div class="file-input-field">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"><!--Client seitige datei grössen limitierung-->
                    <input type="file"  name="file" accept="image/png,image/jpeg,image/webp,image/gif,video/mp4,video/webm,audio/*" required><!--imagefileformat client seitig begrenzen-->
                </div>
                <div class="text-field">
                    <div class="src-info-content">
                        <div class="licenses-dropdown">
                            <select name="licences" id="licences" form="file-upload" required>
                                <option selected disabled>Lizenz wählen</option>
                                <option value="c">&copy;</option>
                                <option value="cc-by">CC BY</option>
                                <option value="cc-by-sa">CC BY-SA</option>
                                <option value="cc-by-nc">CC BY-NC</option>
                                <option value="cc-by-nc-sa">CC BY-NC-SA</option>
                                <option value="cc-by-nd">CC BY-ND</option>
                                <option value="cc-by-nc-nd">CC BY-NC-ND</option>
                                <option value="cc0">Public Domain</option>
                            </select>
                            <div>
                                <input type="text" name="autor">
                            </div>
                            <div class="url-field">
                                <input type="url" name="url">
                            </div>
                        </div>
                    </div>
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
</body>
</html>