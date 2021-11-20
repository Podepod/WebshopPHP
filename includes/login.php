<?php
    session_start();

    if (isset($_SESSION["loggedIn"]) && isset($_SESSION["email"]) && $_SESSION["loggedIn"] == True){
        header("Location: ../index.php");
        exit();
    }

    // TODO ontvang email en password van login form
    // TODO check user in database

    $_SESSION["klantID"] = 0;
    $_SESSION["admin"] = 1;
    $_SESSION["naam"] = "Lode";
    $_SESSION["familieNaam"] = "Gilis";
    $_SESSION["email"] = "lode.gilis@gmail.com";
    $_SESSION["winkelmandje"] = array();
    //$_SESSION["loggedIn"] = True;

    header("Location: ../index.php");
    exit();
?>