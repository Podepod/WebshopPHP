<?php
    session_start();

    if (isset($_SESSION["klantID"])) {
        if (isset($_POST['winkelmand-item-toevoegen'])){
            $productID = htmlspecialchars($_POST['productID']);
            $productNaam = htmlspecialchars($_POST['productNaam']);
            $productPrijs = htmlspecialchars($_POST['productPrijs']);
            $hoeveelheid = htmlspecialchars($_POST['winkelmand-item-hoeveelheid']);
    
            $inWinkelmandje = false;

            for ($i = 0; $i < count($_SESSION['winkelmandje']); $i++) {
                if ($_SESSION['winkelmandje'][$i]['id'] == $productID){
                    $_SESSION['winkelmandje'][$i]['hoeveelheid'] += $hoeveelheid;
                    header('Location: ../index.php');
                    $inWinkelmandje = true;
                }
            }

            if (!$inWinkelmandje){
                $winkelmandItem = array(
                    'id' => $productID,
                    'naam' => $productNaam,
                    'prijs' => $productPrijs,
                    'hoeveelheid' => $hoeveelheid
                );

                array_push($_SESSION['winkelmandje'], $winkelmandItem);
                header('Location: ../index.php');
                exit();
            }
        } else {
            header('Location: ../index.php?alert=Deze actie kan enkel via de bijhorende knop uitgevoerd worden.');
            exit();
        }
    } else {
        # TODO redirect naar login?
        header('Location: ../index.php?alert=Je kan enkel iets aan je winkelmandje toevoegen als je bent ingelogt.');
        exit();
    }
?>