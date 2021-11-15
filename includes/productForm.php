<?php
    if (isset($_POST['productAanpassenSubmit']) && $_POST['productAanpassenSubmit'] == "Wijzigen"){
        include('./dbConnection.php');

        $productID = htmlspecialchars($_POST['productID']);
        $productNaam = htmlspecialchars($_POST['productName']);
        $productBeschrijving = htmlspecialchars($_POST['productDescription']);
        $productPrijs = htmlspecialchars($_POST['productPrice']);
        $productVoorraad = htmlspecialchars($_POST['productStock']);

        $sql = "UPDATE producten SET naam=?, beschrijving=?, prijs=?, voorraad=? WHERE productID=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../producten.php?alert=Prepare statement failed.');
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $productNaam, $productBeschrijving, $productPrijs, $productVoorraad, $productID);
            mysqli_stmt_execute($stmt);
            header("Location: ../producten.php?success='$productNaam' werd succesvol gewijzigd!");
        }
    } elseif (isset($_POST['productAanpassenSubmit']) && $_POST['productAanpassenSubmit'] == "Toevoegen"){
        include('./dbConnection.php');

        $productNaam = htmlspecialchars($_POST['productName']);
        $productBeschrijving = htmlspecialchars($_POST['productDescription']);
        $productPrijs = htmlspecialchars($_POST['productPrice']);
        $productVoorraad = htmlspecialchars($_POST['productStock']);

        $sql = "INSERT INTO producten (naam, beschrijving, prijs, voorraad) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../producten.php?alert=Prepare statement failed.');
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $productNaam, $productBeschrijving, $productPrijs, $productVoorraad);
            mysqli_stmt_execute($stmt);
            header("Location: ../producten.php?success='$productNaam' werd succesvol toegevoegd!");
        }
    } else {
        header('Location: ../producten.php?alert=Deze actie kan enkel via het admin paneel uitgevoerd worden.');
    }
?>