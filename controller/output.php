<?php
    // session_start();
    $_SESSION["expiration"] = time() + 3600;

    $likeCount = 0;

    require "model/database.php";
    require_once "model/Posts.php";
    require_once "model/Like.php";

    try {
        $table = new Posts("posts");
        $result = $table->select();

        // beim laden der hauptseite werden alle einträge aus dem datenbank gelesen
        foreach ($result as $key => $value) {
            // zu jedem post werden auch anzahl der likes geladen
            $likesArray = $table->selectLikeCount($value["post_id"]);

            foreach ($likesArray as $key => $postId) {
                $likeCount = $postId;
            } 

            // kommentare zu den einzelnen posts aus geben
            $commentArray = $table->selectComments($value["post_id"]);

            // solange datenbank kommentare beinhaltet werden sie ausgegeben
            if (!empty($commentArray)) {
                foreach ($commentArray as $key => $arraValue) {
                    $comments =  '<p>' . $arraValue . '</p>';
                }
            } else {
                $comments = "";
            }
            
            // das post-content wird gestaltet und zusammen mit dem likes und comments ausgegeben.
            echo '<div class="picture-content">';
            echo	'<picture>';
            echo		'<source srcset="' . $value["path"] . '" media="(max-width: 800px)">';
            echo		'<img src="' . $value["path"] . '" loading="lazy" onload="loadFullImage(event);">';
            echo	'</picture>';
            echo '</div>';
            echo '<div class="post-data">';
            if (isset($_SESSION["username"])) {
                echo	'<div class="like-btn">';
                echo        '<form method="GET" action="likesController.php">';
                // echo            '<a href="likesController.php?post_id=' . $value["post_id"] . '">Like</a>';
                echo            '<button type="submit" name="post_id" value="' . $value["post_id"] . '">Like ' . $likeCount . ' </button>';
                echo        '</form>';
                echo	'</div>';
            }
            echo	'<div class="metadata">';
            echo		'<p>autor</p>';
            echo	'</div>';
            echo '</div>';
            if (isset($_SESSION["username"])) {
                echo '<div class="coment-content">';
                echo    '<form method="GET" action="commentController.php">';
                echo	    '<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Kommentar"></textarea>';
                echo        '<div>';
                echo            $comments;
                echo        '</div>';
                echo	    '<button type="submit" name="post-comment" value="' . $value["post_id"] . '">Senden</button>';
                echo    '</form>';
                echo '</div>';
            }
        }

    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }
