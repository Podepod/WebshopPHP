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
    $page = "Klanten";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>
        <h4>Klanten</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Adres</th>
                    <th>Geboorte Datum</th>
                    <th>Registratie Datum</th>
                    <th colspan="2">Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "
                        SELECT k.klantID, CONCAT(k.naam, ' ', k.familieNaam) as 'volledigeNaam', k.email, CONCAT(a.straatnaam, ' ', a.straatnummer, ', ', a.postcode, ' ', a.dorpsnaam) as 'adres', k.geboorteDatum, k.registratieTijd, k.admin FROM klanten k
                        INNER JOIN adressen a
                        ON k.adresID = a.adresID
                        WHERE k.verwijderd = '0';
                    ";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        $i = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr <?php if($row['admin'] == 1) echo('class="table-primary"') ?>>
                        <td><?php echo($row['klantID']); ?></td>
                        <td><?php echo($row['volledigeNaam']); ?></td>
                        <td><?php echo($row['email']); ?></td>
                        <td><?php echo($row['adres']); ?></td>
                        <td><?php echo($row['geboorteDatum']); ?></td>
                        <td><?php echo($row['registratieTijd']); ?></td>
                        <td>
                            <?php if($row['admin'] == 1){ ?>
                                <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <input type="hidden" name="actie" value="toggle">
                                    <input type="hidden" name="to" value="klant">
                                    <input type="hidden" name="klantID" value="<?php echo($row['klantID']); ?>">
                                    <button type="submit" class="btn btn-outline-info" <?php if ($row['klantID'] == $_SESSION['klantID']) echo('disabled') ?>>Maak gewone klant</button>
                                </form>
                            <?php } else { ?>
                                <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <input type="hidden" name="actie" value="toggle">
                                    <input type="hidden" name="to" value="admin">
                                    <input type="hidden" name="klantID" value="<?php echo($row['klantID']); ?>">
                                    <button type="submit" class="btn btn-outline-success">Maak administrator</button>
                                </form>
                            <?php } ?>
                        </td> <!-- of verwijder admin als account al admin is -->
                        <td>
                            <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                <input type="hidden" name="actie" value="verwijder">
                                <input type="hidden" name="klantID" value="<?php echo($row['klantID']); ?>">
                                <button type="submit" class="btn btn-outline-<?php if ($row['admin'] == 1) echo('secondary'); else echo('danger'); ?>" <?php if ($row['admin'] == 1) echo('disabled') ?>>Verwijder account</button>
                            </form>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo("Geen klanten gevonden.");
                    } 
                ?>
            </tbody>
        </table>

        <h4>Verwijderde Klanten</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Adres</th>
                    <th>Geboorte Datum</th>
                    <th>Registratie Datum</th>
                    <th colspan="2">Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "
                        SELECT k.klantID, CONCAT(k.naam, ' ', k.familieNaam) as 'volledigeNaam', k.email, CONCAT(a.straatnaam, ' ', a.straatnummer, ', ', a.postcode, ' ', a.dorpsnaam) as 'adres', k.geboorteDatum, k.registratieTijd, k.admin FROM klanten k
                        INNER JOIN adressen a
                        ON k.adresID = a.adresID
                        WHERE k.verwijderd = '1';
                    ";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        $i = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr class="text-secondary<?php if($row['admin'] == 1) echo(' table-primary'); ?>">
                        <td><?php echo($row['klantID']); ?></td>
                        <td><?php echo($row['volledigeNaam']); ?></td>
                        <td><?php echo($row['email']); ?></td>
                        <td><?php echo($row['adres']); ?></td>
                        <td><?php echo($row['geboorteDatum']); ?></td>
                        <td><?php echo($row['registratieTijd']); ?></td>
                        <td>
                            <?php if($row['admin'] == 1){ ?>
                                <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <button type="submit" class="btn btn-outline-info" disabled>Maak gewone klant</button>
                                </form>
                            <?php } else { ?>
                                <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <button type="submit" class="btn btn-outline-success" disabled>Maak administrator</button>
                                </form>
                            <?php } ?>
                        </td> <!-- of verwijder admin als account al admin is -->
                        <td>
                            <form action="./includes/klantenForm.php" method="POST"> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                <input type="hidden" name="actie" value="terugzetten">
                                <input type="hidden" name="klantID" value="<?php echo($row['klantID']); ?>">
                                <button type="submit" class="btn btn-outline-<?php if ($row['admin'] == 1) echo('secondary'); else echo('danger'); ?>">Zet account terug</button>
                            </form>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo("Geen klanten gevonden.");
                    } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>