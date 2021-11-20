<?php
    session_start();

    if (isset($_POST['aantalVerschillendeItems']) && $_POST['aantalVerschillendeItems'] > 0){
        include('./dbConnection.php');

        $aantalVerschillendeItems = htmlspecialchars($_POST['aantalVerschillendeItems']);
        $klantID = htmlspecialchars($_POST['klantID']);

        $productIDs = array();
        $hoeveelheden = array();

        for ($i = 0; $i < $aantalVerschillendeItems; $i++){
            array_push($productIDs, htmlspecialchars($_POST['productID'.$i]));
            array_push($hoeveelheden, htmlspecialchars($_POST['aantal'.$i]));
        }

        // bestelling maken
        /* klantID, tijd, betaald (=1) */
        $bestelTijd = date("Y-m-d H:i:s"); // YYYY-MM-DD HH:MM:SS
        
        $sql = "INSERT INTO bestellingen (klantID, bestellingTijd, betaald) VALUES (?, ?, 1);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../winkelmandje.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $klantID, $bestelTijd);
            mysqli_stmt_execute($stmt);
            // producten aan bestelling linken
            /* bestellingID (vinden met tijd?), productID, hoeveelheid */
            $sql = "SELECT bestellingID FROM bestellingen WHERE bestellingTijd='".$bestelTijd."'";
            var_dump($sql);
            $result = mysqli_query($conn, $sql);
            $resultRows = mysqli_num_rows($result);
            var_dump($resultRows);
            if ($resultRows == 1){
                $row = mysqli_fetch_assoc($result);
                $bestellingID = $row['bestellingID'];

                for ($i = 0; $i < count($productIDs); $i++){
                    $sql = "INSERT INTO bestellingproducten (bestellingID, productID, hoeveelheid) VALUES (?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header('Location: ../winkelmandje.php?alert=Prepare statement 2 failed.');
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sss", $bestellingID, $productIDs[$i], $hoeveelheden[$i]);
                        mysqli_stmt_execute($stmt);
                    }
                }

                $_SESSION["winkelmandje"] = array();

                header("Location: ../index.php?success=Uw bestelling werd succesvol geplaatst!");
                exit();
            }
            header("Location: ../winkelmandje.php?alert=Er was een fout bij het plaatsen van uw bestelling.");
            exit();
        }
    } else {
        
    }
?>