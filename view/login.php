<?php 
    $error = "";

    require "../controller/login.php";
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
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <title>Login</title>
</head>
<header>
    <div>
        <?php echo $error?>
    </div>
</header>
<body>
    <div class="column">
        <!--<div class="window-left-part"></div>-->
        <div class="window-middle-part">
            <div class="title-login"><h1>Anmeldung</h1></div>
            <form method="POST">
                <div class="text-field">
                    <input type="text" name="username" placeholder="Benutzername" required>
                </div>
                <div class="text-field">
                    <input type="password" name="password" placeholder="Passwort" required>
                </div>
                <div class="button-field">
                    <button type="submit" name="submit">Anmelden</button>
                </div>
                <div class="button-field">
                    <button type="button" onclick="document.location='../controller/logout.php'">Abbrechen</button>
                </div>
                <div class="link-field">
                    <a href="signup.php">registrieren</a>
                </div>
            </form>
        </div>
        <!--<div class="window-right-part"></div>-->
    </div>
</body>
</html>