<?php
    session_start();
    if (isset($_SESSION['klantID'])){
        header("Location: ../index.php?alert=Je bent al ingelogt.");
        exit();
    }

    if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['password2']) || !isset($_POST['straat']) || !isset($_POST['nummer']) || !isset($_POST['stad']) ||!isset($_POST['postcode'])){
        header("Location: ../signup.php?alert=Vul alle velden in!");
        exit();
    }

    $email = htmlspecialchars($_POST['email']);
    $pw1 = htmlspecialchars($_POST['password']);
    $pw2 = htmlspecialchars($_POST['password2']);
    $naam = htmlspecialchars($_POST['naam']);
    $familieNaam = htmlspecialchars($_POST['familieNaam']);
    $geboorteDatum = htmlspecialchars($_POST['geboorte']);

    $straatnaam = htmlspecialchars($_POST['straat']);
    $straatnummer = htmlspecialchars($_POST['nummer']);
    $dorpsnaam = htmlspecialchars($_POST['stad']);
    $postcode = htmlspecialchars($_POST['postcode']);

    echo($straatnaam . "</br>");
    echo($straatnummer . "</br>");
    echo($dorpsnaam . "</br>");
    echo($postcode . "</br>");
    
    include('./dbConnection.php');

    echo("Start statement 1</br>");

    $sql = "SELECT * FROM Klanten WHERE email=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('Location: ../signup.php?alert=Prepare statement failed.');
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) >= 1){
        header('Location: ../signup.php?alert=Er bestaat al een account met deze e-mail.');
        exit();
    }

    if ($pw1 != $pw2){
        header('Location: ../signup.php?alert=Het password moet twee keer hetzelfde zijn.');
        exit();
    }

    $hashedPW = password_hash($pw1, PASSWORD_DEFAULT);

    echo("Start statement 2</br>");

    mysqli_stmt_close($stmt);
    $sql = "SELECT adresID FROM adressen WHERE straatnaam=? AND postcode=? AND dorpsnaam=? AND straatnummer=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('Location: ../signup.php?alert=Prepare statement failed.');
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "ssss", $straatnaam, $postcode, $dorpsnaam, $straatnummer);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowNum = mysqli_num_rows($result);

    if ($rowNum >= 1){
        $row = mysqli_fetch_assoc($result);
        $adresID = $row['adresID'];
    } else {
        echo("Start statement 3</br>");
        mysqli_stmt_close($stmt);
        $sql = "INSERT INTO Adressen (straatnaam, postcode, dorpsnaam, straatnummer) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../signup.php?alert=Prepare statement2 failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $straatnaam, $postcode, $dorpsnaam, $straatnummer);
            mysqli_stmt_execute($stmt);
            $adresID = mysqli_insert_id($conn);
        }
    }

    echo($adresID . "</br>");

    echo($geboorteDatum . "</br>");

    // TODO insert klant
    echo("Start statement 4</br>");
    mysqli_stmt_close($stmt);
    $sql = "INSERT INTO Klanten (naam, familieNaam, email, password, geboorteDatum, adresID) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('Location: ../signup.php?alert=Prepare statement3 failed.');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ssssss", $naam, $familieNaam, $email, $hashedPW, $geboorteDatum, $adresID);
        mysqli_stmt_execute($stmt);

        echo(mysqli_insert_id($conn) . "</br>");
        
        $_SESSION["klantID"] = mysqli_insert_id($conn);
        $_SESSION["naam"] = $naam;
        $_SESSION["familieNaam"] = $familieNaam;
        $_SESSION["email"] = $email;
        $_SESSION["winkelmandje"] = array();
        
        header('Location: ../index.php?success=Klant account succesvol aangemaakt en ingelogd.');
        exit();
    }
?>