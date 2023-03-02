<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if (!isset($_POST["submit"])) {
        return;
    }

    // prüefen ob es sich um einen imagefile handelt
    if (!isset($_FILES["image"])) {
        echo "Please uplaod an image file!";
        // return;
    }

    // alle informationen aus dem upload file holen 
    $fileInformation = $_FILES["image"];

    // upload file grösse serverseitig begrenzen
    if ($fileInformation["size"] > 5000000) {
        echo "The file is too big! The maxium file size is 50 MB!";
        return;
    }
    
    // verzeichnisse zur speicherung der upload files verzeuchen und berechtigungen vergeben
    // mkdir("../resources/uploads", 0777);
    // mkdir("../resources/thumbnails", 0777);

    // dateiformat der image aus dem gelesenen igame holen und mit dem png, jpg, und webp vergleichen wenn nicht übereinstimmt fehlermeldung ausgeben.
    $imageType = mime_content_type($fileInformation["tmp_name"]);
    if (!in_array($imageType, array("image/png" ,"image/jpeg", "image/webp"))) {
        echo "Dateiformat ist nicht akzeptabel";
        return;
    }
    
    // image in den vorgesehenen verzeichnis verschieben
    // move_uploaded_file($fileInformation["tmp_name"], "../uploads/" . microtime());

    // image umbennen und in den vorgesehenen verzeichnis verschieben | image name ist aktuelle zeit = microtime()
    $destinationFile = microtime();
    if (!move_uploaded_file($fileInformation["tmp_name"], "uploads/" . $destinationFile)) {
        $error = "Datei könnte nicht hochgeladen werden";
        return;
    }

    $image = null;
    if ($imageType == "image/png") {
        $image = imagecreatefrompng("uploads/" . $destinationFile);
    } elseif ($imageType == "image/jpeg") {
        $image = imagecreatefromjpeg("uploads/" . $destinationFile);
    } elseif ($imageType == "image/webp") {
        $image = imagecreatefromwebp("uploads/" . $destinationFile);
    }

    // image scalieren für einen thumbnail und speichern
    $scaledImage = imagescale($image, 128);

    imagewbmp($scaledImage, "uploads/thumbnails/" . $destinationFile, 0);