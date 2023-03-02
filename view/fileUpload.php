<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File-Upload</title>
</head>
<body>
    <h1>File-Upload</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"><!--Client seitige datei grössen limitierung-->
        <input type="file"  name="image" accept="image/png,image/jpeg,image/webp"><!--imagefileformat client seitig begrenzen-->
        <button type="submit" name="submit">Sumbit</button>
    </form>

    <?php require_once "../controller/upload.php" ?>
</body>
</html>