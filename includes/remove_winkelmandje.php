<?php
    session_start();

    if (isset($_SESSION["klantID"])) {
        if (isset($_POST['winkelmand-item-verwijderen'])){
            $productID = htmlspecialchars($_POST['productID']);
    
            $inWinkelmandje = false;

            for ($i = 0; $i < count($_SESSION['winkelmandje']); $i++) {
                if ($_SESSION['winkelmandje'][$i]['id'] == $productID){
                    array_splice($_SESSION['winkelmandje'], $i, 1);
                    header('Location: ../winkelmandje.php?success=Het pakske zever werd uit je winkelmandje verwijderd.');
                    exit();
                }
            }

            if (!$inWinkelmandje){
                header('Location: ../winkelmandje.php?alert=Dit pakske zever zit niet in het winkelmandje.');
                exit();
            }
        } else {
            header('Location: ../winkelmandje.php?alert=Deze actie kan enkel via de bijhorende knop uitgevoerd worden.');
            exit();
        }
    } else {
        header('Location: ../index.php?alert=Je kan enkel iets uit je winkelmandje verwijderen als je bent ingelogt.');
        exit();
    }
?>