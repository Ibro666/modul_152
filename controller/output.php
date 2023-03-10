<?php
    // session_start();
    $_SESSION["expiration"] = time() + 3600;

    require "model/database.php";
    require_once "model/Posts.php";
    require_once "model/Like.php";

    $likeCount = 0;
    $licenseUrl = "";
    $licensIconA = "";
    $licensIconB = "";
    $licensIconC = "";
    $licensIcon = "";


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

            if ($value["licence"] == "c") {
                $licenseUrl = "";
                $licensIcon = "&copy;";
            } elseif ($value["licence"] == "cc-by") {
                $licenseUrl = "https://creativecommons.org/licenses/by/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">';
            } elseif ($value["licence"] == "cc-by-sa") {
                $licenseUrl = "https://creativecommons.org/licenses/by-sa/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">-<img src="../resources/icons/sa.svg">';
            } elseif ($value["licence"] == "cc-by-nc") {
                $licenseUrl = "https://creativecommons.org/licenses/by-nc/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">-<img src="../resources/icons/nc.svg">';
            } elseif ($value["licence"] == "cc-by-nc-sa") {
                $licenseUrl = "https://creativecommons.org/licenses/by-nc-sa/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">-<img src="../resources/icons/nc.svg">-<img src="../resources/icons/sa.svg">';
            } elseif ($value["licence"] == "cc-by-nd") {
                $licenseUrl = "https://creativecommons.org/licenses/by-nd/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">-<img src="../resources/icons/nd.svg">';
            } elseif ($value["licence"] == "cc-by-nc-nd") {
                $licenseUrl = "https://creativecommons.org/licenses/by-nc-nd/4.0/deed.de";
                $licensIcon = '<img src="../resources/icons/cc.svg"> <img src="../resources/icons/by.svg">-<img src="../resources/icons/nc.svg">-<img src="../resources/icons/nd.svg">';
            } elseif ($value["licence"] == "cc0") {
                $licenseUrl = "https://creativecommons.org/publicdomain/zero/1.0/deed.de";
                $licensIcon = "../resources/icons/pd.svg";
            }
            
            // das post-content wird gestaltet und zusammen mit dem likes und comments ausgegeben.
            if ($value["thumbnail"] == "0") {
                echo '<div class="move-content">';
			    echo    '<video src="' . $value["path"] . '" controls></video>';
		        echo '</div>';

                echo '<div class="post-data">';
                if (isset($_SESSION["username"])) {
                    echo	'<div class="like-btn">';
                    echo        '<form method="GET" action="likesController.php">';
                    echo            '<button type="submit" name="post_id" value="' . $value["post_id"] . '">Like ' . $likeCount . ' </button>';
                    echo        '</form>';
                    echo	'</div>';
                }
                echo	'<div class="metadata">';
                echo	    '<p><a href="' . $licenseUrl . '">' . $licensIcon . '</a> ' . $value["autor"] . '</p>';
                echo	'</div>';
                echo	'<div class="date">';
                echo		'<p>' . $value["date"] . '</p>';
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
            } elseif ($value["thumbnail"] == "1") {
                echo '<div class="audio-content">';
			    echo    '<audio src="' . $value["path"] . '" controls></audio>';
		        echo '</div>';

                echo '<div class="post-data">';
                if (isset($_SESSION["username"])) {
                    echo	'<div class="like-btn">';
                    echo        '<form method="GET" action="likesController.php">';
                    echo            '<button type="submit" name="post_id" value="' . $value["post_id"] . '">Like ' . $likeCount . ' </button>';
                    echo        '</form>';
                    echo	'</div>';
                }
                echo	'<div class="metadata">';
                echo		'<p><a href="' . $licenseUrl . '">' . $licensIcon . '</a> ' . $value["autor"] . '</p>';
                echo	'</div>';
                echo	'<div class="date">';
                echo		'<p>' . $value["date"] . '</p>';
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
            } else {
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
                    echo            '<button type="submit" name="post_id" value="' . $value["post_id"] . '">Like ' . $likeCount . ' </button>';
                    echo        '</form>';
                    echo	'</div>';
                }
                echo	'<div class="metadata">';
                echo		'<p><a href="' . $licenseUrl . '">' . $licensIcon . '</a> ' . $value["autor"] . '</p>';
                echo	'</div>';
                echo	'<div class="date">';
                echo		'<p>' . $value["date"] . '</p>';
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
        }

    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }
