<?php
    if (!isset($_POST["submit"])) {
        return;
    } else {
        session_start();
        $_SESSION["expiration"] = time() + 3600;
    }

    if (!isset($_POST["username"]) || empty($_POST["username"])) {
        $error = "<p>Bitte die Benutzername eingeben.</p>";
        return;
    } else {
        $_SESSION["username"] = $_POST["username"];
    }

    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        $error = "<p>Bitte Passwort eingeben.</p>";
        return;
    }

    require_once "../model/authenticate.php";

    require "view-controller.php";
