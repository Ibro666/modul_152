<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Comment.php";


    if (!isset($_GET["post-comment"])) {
        header("Location: view/login.php");
        return;
    }

    // beim klicken der comment-btn wird der kommentar in die datenbank eingetragen
    try {
        $newTable = new Comment();
        $newTable->insert((int)$_GET["post-comment"], $_SESSION["user_id"], $_GET["comment"]);
        
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }

    header("Location: index.php");