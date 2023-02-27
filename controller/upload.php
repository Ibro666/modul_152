<?php
    $isPost = strtolower($_SERVER["REQUEST_METHOD"]) == "port";
    $hasFiles = isset($_FILES["datei"]) && count($_FILES["datei"]) > 0;
    if (!$isPost && !$hasFiles) {
        header("Location: ../index.php");
    }

    $dateiPfad = $_FILES["datei"]["tmp_name"];
    $fileSize = filesize($dateiPfad);

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type = finfo_file($finfo, $dateiPfad);

    $erlauteTypen = [
        "image/png" => "png", 
        "image/webp" => "webp", 
        "image/jpg" => "jpg"];

    if ($fileSize === 0) {
        echo "Datei ist leer";
        die();
    }

    if (!in_array($type, array_keys($erlauteTypen))) {
        echo "Ungültiger Dateityp";
        die();
    }

    $fileformat = $erlauteTypen[$type];

    // datei name durch die aktuelle zeit ersetzen und in den verzeichnis images speichern
    $zielPfad = __DIR__.'/'.time().'.'.$fileformat;

    if (!copy($dateiPfad, $zielPfad)) {
        echo "Konnte ".$dateiPfad." nicht nach ".$zielPfad." kopieren";
        die();
    }
    // mit unlink wird der datei aus dem tmp verzeichnis gelöscht.
    unlink($dateiPfad);

    echo $zielPfad." erfolgreich hochgeladen";