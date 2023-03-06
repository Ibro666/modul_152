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
        $likesArray = $likesTable->select();
 
        // damit es nicht mehrere male das selbe eintrag entstechen kann wird der datenbank überprüft ob es schon den eintrag beinhaltet, wenn wird der vorgang abgebrochen
        foreach ($likesArray as $key => $value) {
            if ($value["post_id"] == $_GET["post_id"]) {
                header("Location: index.php");
                return; 
            }
        }

        // wenn der datenbank den eintrag nicht beinhaltet, wird ein neueintrag gemacht
        $likesTable = new Like();
        $likesTable->insert($_SESSION["user_id"], (int)$_GET["post_id"]);
        
        
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }

    header("Location: index.php");