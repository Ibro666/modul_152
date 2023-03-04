<?php
    require "output.php";
    
    if (isset($_GET)){
        var_dump($_GET);
    }
    try {
        $likesTable = new Like();
        $likesTable->insert($_SESSION["user_id"], $_GET);
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }   
    return;