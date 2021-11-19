<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
    $page = "Shop";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>
        
        <?php 
            include("./includes/dbConnection.php"); 
            $sql = "SELECT * FROM producten";
            $result = mysqli_query($conn, $sql);
            $resultRows = mysqli_num_rows($result);
            if ($resultRows > 0){
                $i = 0;
                
                while($row = mysqli_fetch_assoc($result)){
                    if ($row['verwijderd'] != 1){
                        if ($i % 3 == 0){
        ?>
            <div class="row mb-3">
        <?php                    
                    }
        ?>
                <div class="col-sm-4">
                    <div class="card">
                        <img src="./images/products/<?php echo($row['afbeeldingNaam']); ?>" class="card-img-top" alt="product afbeelding">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo($row['naam']); if ($row['voorraad'] <= 0) echo (' <span class="badge bg-danger">Uitverkocht</span>'); ?></h5>
                            <p class="card-text"><?php echo($row['beschrijving']); ?></p>
                            <form class="input-group mb-3" action="./includes/add_winkelmandje.php" method="POST">
                                <input type="hidden" name="productID" value="<?php echo($row['productID']); ?>">
                                <input type="hidden" name="productNaam" value="<?php echo($row['naam']); ?>">
                                <input type="hidden" name="productPrijs" value="<?php echo($row['prijs']); ?>">

                                <input 
                                    type="number" 
                                    class="form-control"
                                    min="1"
                                    max="<?php echo($row['voorraad']); ?>"
                                    value="<?php if($row['voorraad'] <= 0) echo('0'); else echo('1'); ?>"
                                    aria-describedby="button-toevoegen<?php echo($i); ?>"
                                    name="winkelmand-item-hoeveelheid"
                                >
                                <button 
                                    class="btn btn-primary <?php if($row['voorraad'] <= 0) echo('disabled'); ?>" 
                                    type="submit" 
                                    <?php if($row['voorraad'] <= 0) echo('aria-disabled="true"'); ?> 
                                    id="button-toevoegen<?php echo($i); ?>"
                                    name="winkelmand-item-toevoegen"
                                    value=""
                                >
                                    Voeg toe aan winkelmandje
                                </button>
                            </form>
                            <p class="card-text"><small class="text-muted">€ <?php echo($row['prijs']); ?></small></p>
                        </div>
                    </div>
                </div>
        <?php
                        if (($i + 1) % 3 == 0){
        ?>
            </div>
        <?php
                        }
                        $i++;
                    }
                }

                if ($i % 3 != 0){
        ?>
            </div>
        <?php
                }
            } else {
                //header('Location: ./index.php/?alert=Geen producten gevonden'); // TODO alert laten werken
                echo("Geen producten gevonden.");
            }    
        ?>
    </div>
</body>
</html>