<?php session_start(); ?>
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
            <li class="list-group-item">
                <!-- als er niets in het winkelmandje zit -->
                <h5>Er zit niets in je winkelmandje.</h5>
                <p><a href="./index.php">Hier</a> kan je verder winkelen</p>
            </li>
            <!-- TODO mogelijks dit weghalen -->
            <input type="hidden" name="aantalVerschillendeItems" id="aantalVerschillendeItems" value="6">
            <?php for($i = 0; $i < 6; $i++){ ?>
                <li class="list-group-item list-group-item-action">
                    <!-- als er iets in het winkelmandje zit -->
                    <div class="row" id="winkelmandItem<?php echo($i); ?>">
                        <div class="col-3">
                            <img class="rounded img-fluid" src="./images/placeholder.jpg" alt="productFoto">
                        </div>
                        <div class="col-3">
                            <h3>ProductNaam</h3>
                            <p class="text-wrap">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum, mollitia unde rem repellat, provident officiis aliquid non doloribus reprehenderit quasi at dignissimos voluptates ab itaque expedita earum nesciunt aliquam tempora.
                            </p>
                        </div>
                        <div class="col-2">
                            <p>Uiterst <i>dan</i> geleverd</p>
                        </div>
                        <div class="col-2">
                            <label for="aantal<?php echo($i); ?>">Aantal pakskes zever: </label>
                            <!-- TODO max = stock van dat item -->
                            <input 
                                class="form-control b-5 aantalItems" 
                                type="number" 
                                name="aantal<?php echo($i); ?>" 
                                id="aantal<?php echo($i); ?>" 
                                value="2" 
                                min="0" 
                                max="12"
                                data-bs-prijs="330.30"
                                data-bs-textField="prijs<?php echo($i); ?>"
                            >
                        
                            <!-- TODO knop onderaan row zetten -->
                            <button class="btn btn-outline-danger mt-2">Verwijder</button>
                        </div>
                        <div class="col-2">
                            <p class="text-end"><b>€ <span id="prijs<?php echo($i); ?>">330.30</span></b></p> <!-- totale prijs dit product berekenen met script -->
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>

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
                    <p class="mb-0 text-end text-success"><b>Geen</b></p>
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
    </div>

    <!-- winkelmandje script -->
    <script src="./js/winkelmandje.js" type="application/javascript"></script>
</body>
</html>