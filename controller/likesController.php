<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Like.php";

    // fals benutzer nicht angemaldet ist wird er in die anmelde-seite weitergeleitet
    if (!isset($_SESSION["user_id"])) {
        header("Location: view/login.php");
        return;
    }

    // fals es sich um keinen post handelt wird der skript unterbrochen
    if (!isset($_GET["post_id"])){
        return;
    }

    // beim klicken der like-button wird ein eintrag in die datenbank gemacht 
    try {
        $likesTable = new Like();
        // damit es nicht mehrere male das selbe eintrag entstechen kann wird der datenbank überprüft ob es schon den eintrag beinhaltet, wenn wird der vorgang abgebrochen
        $likesTable->insert($_SESSION["user_id"], (int)$_GET["post_id"]);
        header("Location: index.php");
        
    } catch (Exception $exception) {
        header("Location: index.php");
        $dbconnect->rollBack();
        die();
    }

    