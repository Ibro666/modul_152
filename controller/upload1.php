<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if (!isset($_POST["submit"])) {
        return;
    }

    if (!isset($_FILES["image"])) {
        echo "Please uplaod an image file!";
        // return;
    }

    $fileInformation = $_FILES["image"];
    print_r($fileInformation);
    if ($fileInformation["size"] > 5000000) {
        echo "The file is too big! The maxium file size is 50 MB!";
        return;
    }
    
    // mkdir("", 0777);

    $imageType = mime_content_type($fileInformation["tmp_name"]);
    if (!in_array($imageType, array("image/png" ,"image/jpeg", "image/webp"))) {
        echo "Dateiformat ist nicht akzeptabel";
        return;
    }

    // move_uploaded_file($fileInformation["tmp_name"], "../uploads/" . microtime());

    $destinationFile = microtime();
    if (!move_uploaded_file($fileInformation["tmp_name"], "../uploads/" . $destinationFile)) {
        echo "Datei könnte nicht hochgeladen werden";
        return;
    }

    $image = null;
    if ($imageType == "image/png") {
        $image = imagecreatefrompng("../uploads/" . $destinationFile);
    } elseif ($imageType == "image/jpeg") {
        $image = imagecreatefromjpeg("../uploads/" . $destinationFile);
    } elseif ($imageType == "image/webp") {
        $image = imagecreatefromwebp("../uploads/" . $destinationFile);
    }

    $scaledImage = imagescale($image, 128);

    imagewbmp($scaledImage, "../uploads/thumbnails/" . $destinationFile, 0);