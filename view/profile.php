<?php
    $error = "";
    $message = "";

    require "controller/profileEdit.php";
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
    <title>Profile</title>
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
                <h1>Personalien</h1>
            </div>
            <form method="POST">
                <div class="out-message">
                    <?php echo $message?>
                </div>
                <div class="input-field">
                    <label for="username">Benutzername:</label>
                    <input type="text" name="username" maxlength="250" value="<?php echo $username ?>" required>
                </div>
                <div class="input-field">
                    <label for="first-name">Vorname:</label>
                    <input type="text" name="first-name" maxlength="250" value="<?php echo $firstname; ?>" required>
                </div>
                <div class="input-field">
                    <label for="last-name">Nachname:</label>
                    <input type="text" name="last-name" maxlength="250" placeholder="<?php echo $lastname; ?>" required>
                </div>
                <div class="input-field">
                    <label for="email">E-Mail:</label>
                    <input type="email" name="email" maxlength="400" required placeholder="<?php echo $email; ?>">
                </div>
                <div class="input-field">
                    <label for="password">aktuelle Passwort:</label>
                    <input type="password" name="password" maxlength="400" required placeholder="*****">
                </div>
                <div class="input-field">
                    <label for="newpass">Neupasswort:</label>
                    <input type="password" name="newpass" maxlength="400" required placeholder="*****">
                </div>
                <div class="button-controls">
                    <button type="submit" name="submit">Änderungen speichern</button>
                </div>
                <div class="button-controls">
                    <button type="button" onclick="document.location='index.php'">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>