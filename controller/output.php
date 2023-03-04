<?php
    // session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Posts.php";

    try {
        $table = new Posts("posts");
        $result = $table->select();

        foreach ($result as $key => $value) {
            echo '<div class="picture-content">';
            echo	'<picture>';
            echo		'<source srcset="' . $value["thumbnail"] . '" media="(max-width: 800px)">';
            echo		'<img src="' . $value["path"] . '" loading="lazy" onload="loadFullImage(event);">';
            echo	'</picture>';
            echo '</div>';
            echo '<div class="post-data">';
            echo    '<form method="GET" action="likesController.php">';
            echo	    '<div class="like-btn">';
            // echo            '<a href="likesController.php?post_id=' . $value["post_id"] . '">Like</a>';
            echo            '<button type="submit" name="post_id" value="' . $value["post_id"] . '">Like</button>';
            echo	    '</div>';
            echo    '</form>';
            echo	'<div class="metadata">';
            echo		'<p>autor</p>';
            echo	'</div>';
            echo '</div>';
            echo '<div class="coment-content">';
            echo	'<textarea name="coment" id="coment" cols="30" rows="10" placeholder="Kommentar"></textarea>';
            echo	'<button type="submit" name="post-coment">Senden</button>';
            echo '</div>';
        }

        // $postfile = $result["path"];
        // $thumbnail = $result["thumbnail"];
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }
