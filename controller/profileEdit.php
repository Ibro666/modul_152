<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";

    $username = "";
    $firstname = "";
    $lastname = "";
    $email = "";
    
    try {
        $userTable = new Table("users");
        $result = $userTable->selectProfile($_SESSION["user_id"]);

        $username = $result["username"];
        $firstname = $result["firstname"];
        $lastname = $result["lastname"];
        $email = $result["email"];

        if (!isset($_POST["submit"])) {
            return;
        }

        if (!isset($_POST["username"]) || empty($_POST["username"])) {
            $error = "<p>Bitte geben Sie ein Benutzername ein.</p>";
            return;
        }
        
        if (strlen($_POST["username"]) > 250) {
            $error = "<p>Benutzername darf nicht länger als 250 Zeichen sein!</p>";
            return;
        }

        if (strlen($_POST["first-name"]) > 250 || strlen($_POST["last-name"]) > 250) {
            $error = "<p>Name darf nicht länger als 250 Zeichen sein!</p>";
            return;
        }

        if (!isset($_POST["first-name"]) || empty($_POST["first-name"]) || !isset($_POST["last-name"]) || empty($_POST["last-name"])) {
            $error = "<p>Bitte geben Sie Ihre Namen ein.</p>";
            return;
        }

        if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $error = "<p>Bitte geben Sie ein Email ein.</p>";
            return;
        }

        if (strlen($_POST["email"]) > 400) {
            $error = "<p>Email darf nicht länger als 400 Zeichen sein!</p>";
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

        if (password_verify($_POST["password"], $result["password"])) {
            $userTable->update($_POST["first-name"], $_POST["last-name"], $_POST["username"], $_POST["email"], password_hash($_POST["newpass"], PASSWORD_DEFAULT), $_SESSION["user_id"]);

            $message = "<p>Änderungen wurden erfolgrei gespeichenrt!</p>";
        } else {
            $error = "<p>Ein falsches Passwort eingegeben!</p>";
            return;
        }
    } catch (Exception $exception) {
        echo '<p class="error">Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>';
        $dbconnect->rollBack();
        die();
    }