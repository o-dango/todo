<!-- Camilla Piskonen, 0451801
www-sovellukset -->

<?php
    session_start();
    require_once("utils.php");

    siteHeader();

    if ($_GET["p"] === "register") {
        require("register.php");
    }

    else if ($_GET["p"] === "login") {
        require("login.php");
    }

    else if ($_GET["p"] === "logout") {
        require("logout.php");
    }


    else {
        require("default.php");
    }

 ?>
