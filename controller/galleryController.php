<?php
    require "model/database.php";
    require_once "model/Posts.php";

    $licenseUrl = "";
    $licensIcon = "";
    $metadata;

    try {
        $newTable = new Posts("posts");
        $result = $newTable->select();

        foreach ($result as $key => $value) {

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

            echo '<div class="gallery-item" onclick="showLightbox(' . $key . ');">';
            if ($value["thumbnail"] == "0.svg") {
                echo '<picture id="' . $value["path"] . '">';
                echo    '<img  id="0" src="../resources/icons/0.svg">';
                echo '</picture>';
            } elseif ($value["thumbnail"] == "1.svg") {
                echo '<picture id="' . $value["path"] . '">';
                echo    '<img id="1" src="../resources/icons/1.svg">';
		        echo '</picture>';
            } else {
                echo '<picture id="' . $value["path"] . '">';
                // echo    '<source srcset="' . $value["thumbnail"] . '" media="(max-width: 800px)">';
                echo    '<img id="2" src="' . $value["thumbnail"] . '" alt="">';
                echo '</picture>';
            }
            echo '</div>';

            $metadata[] =
                    array(
                        "id"=>$key,
                        "url"=>$licenseUrl,
                        "icon"=>$licensIcon,
                        "autor"=>$value["autor"]
                    );
        }

        $file = fopen("test.json", "w") or die("Datei könnte nicht erstellt werden");
        fwrite($file, json_encode($metadata));
        fclose($file);

    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support!</p>";
        $dbconnect->rollBack();
        die();
    }