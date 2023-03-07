<?php
    require "../model/database.php";

    if (!isset($_POST["submit"])) {
        return;
    }

    if (!isset($_POST["username"]) || empty($_POST["username"])) {
		$error = "<p>Bitte geben Sie eine gültige E-mail ein.</p>";
		return;
	}
    
	if (strlen($_POST["username"]) > 250) {
		$error = "<p>Benutzername darf nicht länger als 250 Zeichen sein!</p>";
        return;
	}

	if (!isset($_POST["password"]) || empty($_POST["password"])) {
		$error = "<p>Bitte geben Sie ein Passwort ein</p>";
		return;
	}

    if (strlen($_POST["password"]) > 400) {
		$error = "<p>Password darf nicht länger als 400 Zeichen sein!</p>";
        return;
	}

    if ($_POST["password"] != $_POST["repeat-pass"]) {
        $error = "<p>Passwörter sind nicht identisch!</p>";
        return;
    }

    try {
        $userTable = new Table("users");
        $userTable->insert($_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));

        $message = "<p>Registration war erfolgreich</p>";
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }

    session_start();
    $_SESSION["expiration"] = time() + 3600;