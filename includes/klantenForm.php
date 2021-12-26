<?php
    session_start(); 
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != '1'){
        header("Location: ./index.php?alert=Je moet ingelogd zijn met een administrator account om deze actie te voltooien.");
        exit();
    }

    if (!isset($_POST['actie'])){
        header('Location: ../klanten.php?alert=Er werd geen actie meegegeven.');
        exit();
    }

    if (!isset($_POST['klantID'])){
        header('Location: ../klanten.php?alert=Er moet een klantID gespecificeerd worden vooraleer deze gewijzigd kan worden.');
        exit();
    }

    include('./dbConnection.php');

    if ($_POST['actie'] == "toggle"){
        if (!isset($_POST['to']) || ($_POST['to'] != 'admin' AND $_POST['to'] != 'klant')){
            header('Location: ../klanten.php?alert=Er moet gespecificeerd worden naar wat de klant moet veranderen.');
            exit();
        }

        if ($_POST['to'] == 'admin') $to = '1';
        else $to = '0';

        $sql = "UPDATE Klanten SET admin=? WHERE klantID=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../klanten.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $to, htmlspecialchars($_POST['klantID']));
            mysqli_stmt_execute($stmt);
            header("Location: ../klanten.php?success=Klant ". htmlspecialchars($_POST['klantID']) ." werd succesvol aangepast!");
            exit();
        }

    } elseif ($_POST['actie'] == "verwijder"){
        $sql = "UPDATE Klanten SET verwijderd=1 WHERE klantID=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../klanten.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($_POST['klantID']));
            mysqli_stmt_execute($stmt);
            header("Location: ../klanten.php?success=Klant '". htmlspecialchars($_POST['klantID']) ."' werd succesvol verwijderd!");
            exit();
        }
    } elseif ($_POST['actie'] == "terugzetten"){
        $sql = "UPDATE Klanten SET verwijderd=0 WHERE klantID=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../klanten.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($_POST['klantID']));
            mysqli_stmt_execute($stmt);
            header("Location: ../klanten.php?success=Klant '". htmlspecialchars($_POST['klantID']) ."' werd succesvol teruggezet!");
            exit();
        }
    }

    header("Location: ../klanten.php?alert=Er gebeurde niets.");
    exit();
?>