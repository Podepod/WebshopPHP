<?php
    session_start();
    if (isset($_SESSION['klantID'])){
        header("Location: ../index.php?alert=Je bent al ingelogt.");
        exit();
    }

    if (!isset($_POST['email']) || !isset($_POST['password'])){
        header("Location: ../login.php?alert=Vul alle velden in!");
        exit();
    }

    $email = htmlspecialchars($_POST['email']);
    $pw = htmlspecialchars($_POST['password']);
    
    include('./dbConnection.php');

    $sql = "SELECT * FROM Klanten WHERE email=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('Location: ../login.php?alert=Prepare statement failed.');
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) != 1){
        header('Location: ../login.php?alert=Geen account met dit e-mail gevonden.');
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    if ($row['verwijderd'] == '1'){
        header('Location: ../login.php?alert=Dit account is verwijderd.');
        exit();
    }

    if (!password_verify($pw, $row['password'])){
        header('Location: ../login.php?alert=Fout password.');
        exit();
    }

    $_SESSION["klantID"] = $row['klantID'];
    $_SESSION["admin"] = $row['admin'];
    $_SESSION["naam"] = $row['naam'];
    $_SESSION["familieNaam"] = $row['familieNaam'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["winkelmandje"] = array();

    header("Location: ../index.php?success=U bent successvol ingelogd.");
    exit();
?>