<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Comment.php";

    // prüfen ob der Benutzer angemeldet ist 
    if (!isset($_GET["post-comment"])) {
        header("Location: login.php");
        return;
    }

    // serverseitig prüfen ob der kommentar feld leer ist
    if (empty($_GET["comment"])) {
        $error = '<p>Kommentarfeld darf nicht leer sein</p>';
        header("Location: index.php");
    }

    // beim klicken der comment-btn wird der kommentar in die datenbank eingetragen
    try {
        $newTable = new Comment();
        $newTable->insert((int)$_GET["post-comment"], $_SESSION["user_id"], $_GET["comment"]);
        
    } catch (Exception $exception) {
        echo '<p class="error">Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>';
        $dbconnect->rollBack(); 
        die($error);
    }

    header("Location: index.php");