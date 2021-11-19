<?php 
    session_start(); 
    if (!isset($_SESSION['klantID'])){
        header("Location: login.php?alert=Log je in om je winkelmandje te kunnen bekijken.");
    }
?>
<!DOCTYPE html>
<html lang="en">
<!-- TODO redirect naar login pagina als nog niet ingelogd -->
<?php
    $page = "Winkelmandje";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>
        <h1>Klant's winkelmandje</h1>

        <!-- form invoegen -->
        <ul class="list-group list-group-flush">
            <?php if (empty($_SESSION['winkelmandje'])) { ?>
                <li class="list-group-item">
                    <!-- als er niets in het winkelmandje zit -->
                    <h5>Er zit niets in je winkelmandje.</h5>
                    <p><a href="./index.php">Hier</a> kan je verder winkelen</p>
                </li>
            <!-- TODO mogelijks dit weghalen -->
            <input type="hidden" name="aantalVerschillendeItems" id="aantalVerschillendeItems" value="<?php echo($p); ?>">
            <?php 
                } else { 
                    include('./includes/dbConnection.php');
                    $winkelmandjeNr = 0;

                    foreach($_SESSION['winkelmandje'] as $product) {
                        $sql = "SELECT * FROM producten WHERE productID=".$product['id'];
                        $result = mysqli_query($conn, $sql);
                        $resultRows = mysqli_num_rows($result);
                        
                        if ($resultRows == 1){
                            $row = mysqli_fetch_assoc($result);
            ?>
                <li class="list-group-item list-group-item-action">
                    <!-- als er iets in het winkelmandje zit -->
                    <div class="row" id="winkelmandItem<?php echo($winkelmandjeNr); ?>">
                        <div class="col-3">
                            <img class="rounded img-fluid" src="./images/products/<?php echo($row['afbeeldingNaam']); ?>" alt="productFoto">
                        </div>
                        <div class="col-3">
                            <h3><?php echo($row['naam']); ?></h3>
                            <p class="text-wrap">
                                <?php echo($row['beschrijving']); ?>    
                            </p>
                        </div>
                        <div class="col-2">
                            <!-- TODO altijd 2 weken later -->
                            <p>Uiterst <i>dan</i> geleverd</p>
                        </div>
                        <div class="col-2">
                            <label for="aantal<?php echo($winkelmandjeNr); ?>">Aantal pakskes zever: </label>
                            <!-- TODO max = stock van dat item -->
                            <input 
                                class="form-control b-5 aantalItems" 
                                type="number" 
                                name="aantal<?php echo($winkelmandjeNr); ?>" 
                                id="aantal<?php echo($winkelmandjeNr); ?>" 
                                value="<?php echo($product['hoeveelheid']); ?>"
                                min="0" 
                                max="<?php echo($row['voorraad']); ?>"
                                data-bs-prijs="<?php echo($row['prijs']); ?>"
                                data-bs-textField="prijs<?php echo($winkelmandjeNr); ?>"
                            >
                        
                            <!-- TODO knop onderaan row zetten -->
                            <button class="btn btn-outline-danger mt-2">Verwijder</button>
                        </div>
                        <div class="col-2">
                            <p class="text-end mb-0"><b>€ <span id="prijs<?php echo($winkelmandjeNr); ?>"><?php echo($row['prijs']); ?></span></b></p> <!-- totale prijs dit product berekenen met script -->
                            <p class="text-end"><small>
                                € <?php echo($row['prijs']); ?>
                                <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Prijs per pakske zever."></i>
                            </small></p>
                        </div>
                    </div>
                </li>
            <?php $winkelmandjeNr++; }}} ?>
        </ul>
        <?php if (!empty($_SESSION['winkelmandje'])) { ?>
            <div class="alert alert-warning text-reset">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-2">
                        <!-- TODO vullen met juiste getallen (deels php, deels js) -->
                        <p class="mb-0">Totaal artikelen <span class="badge bg-secondary" id="totaalAantal">4</span></p>
                    </div>
                    <div class="col-2">
                        <p class="mb-0 text-end">€ <span id="totaal0">330,30</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-2">
                        <p class="mb-0 text-success"><b>Verzendkosten</b></p>
                    </div>
                    <div class="col-2">
                        <p class="mb-0 text-end text-success">
                            <b>Geen</b>
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Onze zever in pakskes wordt gratis naar u vestuurd!"></i>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-2">
                        <p class="mb-0"><b>Totaal</b></p>
                    </div>
                    <div class="col-2">
                        <p class="mb-0 text-end"><b>€ <span id="totaal1">330,30</span></b></p>
                    </div>
                </div>
            </div>
            <!-- bestel button -->
            <button class="btn btn-primary btn-lg float-end mb-5" type="submit">
                Bestellen
            </button>
        <?php } ?>
    </div>

    <!-- winkelmandje script -->
    <script src="./js/winkelmandje.js" type="application/javascript"></script>
</body>
</html>