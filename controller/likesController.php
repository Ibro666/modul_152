<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Like.php";

    if (!isset($_SESSION["user_id"])) {
        header("Location: view/login.php");
        return;
    }

    if (!isset($_GET["post_id"])){
        return;
    }

    try {
        $likesTable = new Like();
        $likesTable->insert($_SESSION["user_id"], (int)$_GET["post_id"]);
        
        
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }

    header("Location: index.php");