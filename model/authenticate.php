<?php
    require "database.php";
    require_once "Table.php";

    if (!isset($_SESSION["expiration"]) || $_SESSION["expiration"] < time()) {
        header("Location: index.php");
        die();
    }
    
    $_SESSION["expiration"] = time() + 3600;

    try {
        $userTable = new Table("users");
        $result = $userTable->select($_POST["username"]);

        if (!$result || $result === true) {
            $error = "<p>Benutzername ist nicht registriert!</p>";
            return;
        }
        
        if (!password_verify($_POST["password"], $result["password"])) {
            $error = "<p>falsches Passwort eingegeben</p>";
            return;
        }

        $_SESSION["user_id"] = $result["user_id"];
        header("Location: ../index.php");
    } catch (Exception $exception) {
        echo '<p class="error">Benutzername ist nicht registriert! ' . $exception->getMessage() . '</p>';
        $dbconnect->rollBack();
        die();
    }
