<?php
    if (isset($_POST['productVerwijderen']) && $_POST['productVerwijderen'] == "Verwijderen"){
        include('./dbConnection.php');
        
        $productID = htmlspecialchars($_POST['productID']);

        $sql = "UPDATE producten SET verwijderd=1 WHERE productID=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../producten.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $productID);
            mysqli_stmt_execute($stmt);
            header("Location: ../producten.php?success='$productNaam' werd succesvol verwijderd!");
            exit();
        }
    } elseif (isset($_POST['productVerwijderen']) && $_POST['productVerwijderen'] == "Terugzetten"){
        include('./dbConnection.php');
        
        $productID = htmlspecialchars($_POST['productID']);

        $sql = "UPDATE producten SET verwijderd=0 WHERE productID=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: ../producten.php?alert=Prepare statement failed.');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $productID);
            mysqli_stmt_execute($stmt);
            header("Location: ../producten.php?success='$productNaam' werd succesvol teruggezet!");
            exit();
        }
    } else {
        header('Location: ../producten.php?alert=Deze actie kan enkel via het admin paneel uitgevoerd worden.');
        exit();
    }
?>