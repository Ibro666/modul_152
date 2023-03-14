<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $path = "";
    $thmubPath = "";

    require "model/database.php";
    require_once "model/Posts.php";

    if (!isset($_POST["submit"])) {
        return;
    }

    // prüefen ob es sich um einen imagefile handelt
    if (!isset($_FILES["file"])) {
        $error = "<p>Fügen Sie ein Datei hinzu!</p>";
        return;
    }

    // image name ist aktuelle zeit = microtime()
    $destinationFile = microtime();

    // alle informationen aus dem upload file holen 
    $fileInformation = $_FILES["file"];

    // upload file grösse serverseitig begrenzen
    if ($fileInformation["size"] > 5000000) {
        $error = "<p>Ausgewehlte Datei ist zugross! Maximale Dateigrösse beträgt 50 MB!</p>";
        return;
    }
    
    // verzeichnisse zur speicherung der upload files verzeuchen und berechtigungen vergeben
    // mkdir("../resources/uploads", 0777);
    // mkdir("../resources/uploads/thumbnails", 0777);
    // mkdir("../resources/uploads/compresions", 0777);

    // dateiformat der image aus dem gelesenen image holen und mit dem png, jpg, und webp vergleichen wenn nicht übereinstimmt fehlermeldung ausgeben.
    $imageType = mime_content_type($fileInformation["tmp_name"]);
    
    if (!in_array($imageType, array("image/png" ,"image/jpeg", "image/webp", "image/gif", "video/mp4", "video/webm", "audio/mp3", "audio/mpeg", "audio/wav"))) {
        $error = "<p>Das ausgewählte Dateiformat wird nicht unterstützt</p>";
        return;
    }

    if ($imageType == "video/mp4" || $imageType == "video/webm") {
        if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/videos/" . $destinationFile)) {
            $error = "<p>Datei könnte nicht hochgeladen werden</p>";
            return;
        }

        $path = "resources/uploads/videos/";
        $thmubPath = "0.svg";
    }

    if ($imageType == "audio/mp3" || $imageType == "audio/wav" || $imageType == "audio/mpeg") {
        if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/audios/" . $destinationFile)) {
            $error = "<p>Datei könnte nicht hochgeladen werden</p>";
            return;
        }

        $path = "resources/uploads/audios/";
        $thmubPath = "1.svg";
    }
    // image in den vorgesehenen verzeichnis verschieben
    // move_uploaded_file($fileInformation["tmp_name"], "../uploads/" . microtime());

    // image umbennen und in den vorgesehenen verzeichnis verschieben
    
    if ($imageType == "image/png" || $imageType == "image/jpeg" || $imageType == "image/webp" || $imageType == "image/gif") {
    if (!move_uploaded_file($fileInformation["tmp_name"], "resources/uploads/" . $destinationFile)) {
        $error = "<p>Datei könnte nicht hochgeladen werden</p>";
        return;
    }

    $path = "resources/uploads/";

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

    // imagepng($scaledImage, "resources/uploads/thumbnails/" . $destinationFile, 0);
    // if (filesize('test_img.webp') % 2 == 1) {
    //     file_put_contents('test_img.webp', "\0", FILE_APPEND);
    // }

    imagepalettetotruecolor($image);
    imagealphablending($image, true);
    imagesavealpha($image, true);
print_r($image);
    imagewebp($image, "resources/uploads/compresions/" . $destinationFile, 0);
    $thmubPath = "resources/uploads/thumbnails/" . $destinationFile;
    }

    if (!isset($_POST["licences"])) {
        $error = "<p>Bitte ein Lizenz angeben!</p>";
        return;
    }
   
    // die pfäder der gespeicherten medien in die datenbank eintragen
    try {
        $table = new Posts("posts");
        $table->insert($destinationFile, $thmubPath, $path.$destinationFile, $_POST["licences"], $_POST["autor"], $_POST["url"], date("d.m.Y"));
    } catch (Exception $exception) {
        $error = "<p>Bei der Verbindung ist ein Fehler aufgetretten, melden Sie sich bei der Support! " . $exception->getMessage() . "</p>";
        $dbconnect->rollBack();
        die();
    }

    header("Location: ../index.php");