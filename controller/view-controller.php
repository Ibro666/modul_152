<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    if (isset($_SESSION["username"])) {
        $loginBtn = '<a href="controller/logout.php" class="logout-button">Abmelden</a>';
    } else {
        $loginBtn = '<a href="view/login.php" class="login-button">Anmelden</a>';
    }

    