<?php
	session_start();
    unset($_SESSION["username"], $_SESSION["user_id"]);
	header("Location: ../index.php");
    // session_destroy();
    die();
