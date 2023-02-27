<?php
    if (isset($_SESSION["expiration"])) {
        $loginBtn = '<a href="controller/logout.php" class="logout-button">Abmelden</a>';
    } else {
        $loginBtn = '<a href="view/login.php" class="login-button">Anmelden</a>';
    }