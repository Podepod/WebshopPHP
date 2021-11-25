<?php 
    session_start(); 
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
        header("Location: index.php?alert=Enkel de webshopbeheerder kan deze pagina bekijken.");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $page = "Bestellingen";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>
        <h4>Bestellingen</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Klant</th>
                    <th>Bezorgadres</th>
                    <th>Bestelling Tijd</th>
                    <th>Totaal</th>
                    <th>Betaald?</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "
                        SELECT b.bestellingID, CONCAT(k.naam, ' ', k.familieNaam) as 'klant', CONCAT(a.straatnaam, ' ', a.straatnummer, ', ', a.postcode, ' ', a.dorpsnaam) as 'bezorgadres', b.bestellingTijd, sum(p.prijs * bp.hoeveelheid) as 'totaal', b.betaald
                        FROM bestellingen b
                            INNER JOIN bestellingproducten bp
                            ON b.bestellingID = bp.bestellingID
                                INNER JOIN producten p
                                ON bp.productID = p.productID
                            INNER JOIN klanten k
                            ON b.klantID = k.klantID
                                INNER JOIN adressen a
                                ON k.adresID = a.adresID
                        GROUP BY b.bestellingID
                        ORDER BY b.bestellingTijd DESC;
                    ";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo($row['bestellingID']); ?></td>
                        <td><?php echo($row['klant']); ?></td>
                        <td><?php echo($row['bezorgadres']); ?></td>
                        <td><?php echo($row['bestellingTijd']); ?></td>
                        <td>€ <?php echo($row['totaal']); ?></td>
                        <td><?php if ($row['betaald'] == 1) echo("Ja"); else echo("Nee"); ?></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table class="table table-light table-hover">
                                <thead>
                                    <th>ProductID</th>
                                    <th>Naam</th>
                                    <th>Prijs / pakske zever</th>
                                    <th>Hoeveelheid</th>
                                    <th>Totaal</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        include("./includes/dbConnection.php"); 
                                        $sql2 = "
                                            SELECT p.productID, p.naam, p.prijs, bp.hoeveelheid, p.prijs * bp.hoeveelheid as 'totaal'
                                            FROM bestellingproducten bp
                                                INNER JOIN producten p
                                                ON bp.productID = p.productID
                                            WHERE bp.bestellingID = " . $row['bestellingID'] . "
                                            ORDER BY totaal DESC;
                                        ";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $resultRows2 = mysqli_num_rows($result2);
                                        if ($resultRows2 > 0){
                                            while($row2 = mysqli_fetch_assoc($result2)){
                                    ?>
                                    <tr>
                                        <td><?php echo($row2['productID']); ?></td>
                                        <td><?php echo($row2['naam']); ?></td>
                                        <td><?php echo($row2['prijs']); ?></td>
                                        <td><?php echo($row2['hoeveelheid']); ?></td>
                                        <td><?php echo($row2['totaal']); ?></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo("Geen bestellingen gevonden.");
                    }    

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>