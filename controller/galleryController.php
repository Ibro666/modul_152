<?php
    require "model/database.php";
    require_once "model/Posts.php";

    try {
        $newTable = new Posts("posts");
        $result = $newTable->select();

        foreach ($result as $key => $value) {
            echo    '<div class="gallery-item" onclick="showLightbox(' . $key . ');">';
            echo        '<picture id="' . $value["path"] . '">';
            echo		    '<source srcset="' . $value["thumbnail"] . '" media="(max-width: 800px)">';
            echo            '<img src="' . $value["thumbnail"] . '" alt="Alle"">';
            echo        '</picture>';
            echo    '</div>';
        }

    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }