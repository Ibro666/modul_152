<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "model/database.php";
    require_once "model/Posts.php";

    if (!isset($_POST["submit"])) {
        return;
    }

    // prüefen ob es sich um einen imagefile handelt
    if (!isset($_FILES["file"])) {
        $error = "Fügen Sie ein Datei hinzu!";
        return;
    }

    // alle informationen aus dem upload file holen 
    $fileInformation = $_FILES["file"];

    // upload file grösse serverseitig begrenzen
    if ($fileInformation["size"] > 5000000) {
        $error = "Ausgewehlte Datei ist zugross! Maximale Dateigrösse beträgt 50 MB!";
        return;
    }
    
    // verzeichnisse zur speicherung der upload files verzeuchen und berechtigungen vergeben
    // mkdir("../resources/uploads", 0777);
    // mkdir("../resources/uploads/thumbnails", 0777);
    // mkdir("../resources/uploads/compresions", 0777);

    // dateiformat der image aus dem gelesenen image holen und mit dem png, jpg, und webp vergleichen wenn nicht übereinstimmt fehlermeldung ausgeben.
    $imageType = mime_content_type($fileInformation["tmp_name"]);
    if (!in_array($imageType, array("image/png" ,"image/jpeg", "image/webp", "image/gif", "video/mp4", "video/webm", "audio/mp3", "audio/wav"))) {
        $error = "Das ausgewählte Dateiformat wird nicht unterstützt";
        return;
    }

    if ($imageType == "video/mp4" || $imageType == "video/webm") {
        if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/videos/" . $fileInformation["name"])) {
            $error = "Datei könnte nicht hochgeladen werden";
        }
    }

    if ($imageType == "audio/mp3" || $imageType == "audio/wav") {
        if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/audios/" . $fileInformation["name"])) {
            $error = "Datei könnte nicht hochgeladen werden";
        }
    }
    // image in den vorgesehenen verzeichnis verschieben
    // move_uploaded_file($fileInformation["tmp_name"], "../uploads/" . microtime());

    // image umbennen und in den vorgesehenen verzeichnis verschieben | image name ist aktuelle zeit = microtime()
    $destinationFile = microtime();
    if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/" . $destinationFile)) {
        $error = "Datei könnte nicht hochgeladen werden";
        return;
    }

    // hoch geladene datei mit entsprechenden dateiformat speichern
    $image = null;
    if ($imageType == "image/png") {
        $image = imagecreatefrompng("resources/uploads/" . $destinationFile);
    } elseif ($imageType == "image/jpeg") {
        $image = imagecreatefromjpeg("resources/uploads/" . $destinationFile);
    } elseif ($imageType == "image/webp") {
        $image = imagecreatefromwebp("resources/uploads/" . $destinationFile);
    } elseif ($imageType == "image/gif") {
        $image = imagecreatefromgif("resources/uploads/" . $destinationFile);
    }

    // image scalieren für einen thumbnail und mit dem dateiformat webp als 0% kompresion speichern
    $scaledImage = imagescale($image, 128);

    // ob_start();
    // imagewebp($scaledImage, "resources/uploads/thumbnails/" . $destinationFile, 0);
    // if (ob_get_length() % 2 == 1) {
    // echo "\0";
    // }
    // ob_end_flush();

    imagepng($scaledImage, "resources/uploads/thumbnails/" . $destinationFile, 0);
    // if (filesize('test_img.webp') % 2 == 1) {
    //     file_put_contents('test_img.webp', "\0", FILE_APPEND);
    // }

    // imagewebp($image, "resources/uploads/compresions/" . $destinationFile, 0);

    // die pfäder der gespeicherten medien in die datenbank eintragen
    try {
        $table = new Posts("posts");
        $table->insert($destinationFile, "resources/uploads/thumbnails/".$destinationFile, "resources/uploads/".$destinationFile);
    } catch (Exception $exception) {
        $error = "<p>Benutzername ist nicht registriert! " . $exception->getMessage() . "</p>";
        $dbconnect->rollBack();
        die();
    }
