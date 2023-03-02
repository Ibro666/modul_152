<?php
	session_start();
	header("Location: ../index.php");
    unset($_SESSION["username"]);
    // session_destroy();
    die();