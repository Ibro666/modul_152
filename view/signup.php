<?php
    $error = "";
    $message = "";

    require "../controller/registration.php";
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
    <title>Registrierung</title>
</head>
<header>
    <div>
        <?php echo $error?>
    </div>
</header>
<body>
    <div class="display-container">
        <div class="display-content">
            <div class="title-login">
                <h1>Registrierung</h1>
            </div>
            <form method="POST">
                <div class="input-field">
                    <label for="username">Benutzername:</label>
                    <input type="text" name="username" maxlength="250">
                </div>
                <div class="input-field">
                    <label for="password">Passwort:</label>
                    <input type="password" name="password" maxlength="400">
                </div>
                <div class="input-field">
                    <label for="repeat-pass">Passwort bestätigen:</label>
                    <input type="password" name="repeat-pass" maxlength="400">
                </div>
                <div>
                    <button type="submit" name="submit">Registrieren</button>
                </div>
                <div>
                    <button type="button" onclick="document.location='login.php'">Abbrechen</button>
                </div>
                <div class="out-message">
                    <?php echo $message?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>