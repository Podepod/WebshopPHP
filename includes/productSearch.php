<?php 
    include("./dbConnection.php");
    if (isset($_POST["search"]) && $_POST["search"] != ""){
        $sql = "SELECT * FROM producten WHERE verwijderd=0 AND naam LIKE ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Prepare statement failed");
            exit();
        }
        $search = "%".$_POST["search"]."%";

        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
    } else {
        $sql = "SELECT * FROM producten WHERE verwijderd=0";
        $result = mysqli_query($conn, $sql);
    }

    $resultRows = mysqli_num_rows($result);
    if ($resultRows > 0){
        $i = 0;
        
        while($row = mysqli_fetch_assoc($result)){
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

        if ($i % 3 != 0){
?>
    </div>
<?php
        }
    } else {
        echo("Deze zever verkopen zelfs wij niet.");
    }    
?>