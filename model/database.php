<?php
    require_once "Table.php";

    $server = "mysql";
    $user = "root";
    $pass = "admin123";
    $dbname = "m152";

    try {
        $dbconnect = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
    } catch (Exception $exception) {
        $error = "Beim verbinden der Datenbank ist ein Fehler aufgetaucht " . $exception->getMessage();
        die();
    }