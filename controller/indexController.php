<?php
    session_start();
    $_SESSION["expiration"] = time() + 3600;

    if (isset($_SESSION["username"])) {
        $loginBtn = '<a href="controller/logout.php" class="logout-button">Abmelden</a>
                        <div class="dropdown-content">
                            <a href="profile.php">Profil</a>
                        </div>';
    } else {
        $loginBtn = '<a href="login.php" class="login-button">Anmelden</a>';
    }