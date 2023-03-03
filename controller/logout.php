<?php
	session_start();
	header("Location: ../index.php");
    unset($_SESSION["username"], $_SESSION["user_id"]);
    // session_destroy();
    die();