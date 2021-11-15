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
        <?php for ($i = 0; $i < 4; $i++){ ?>
            <div class="row">
                <?php for ($j = 0; $j < 3; $j++){ ?> 
                    <div class="col-sm-4">
                        <div class="card">
                            <img src="./images/placeholder.jpg" class="card-img-top" alt="product image">
                            <div class="card-body">
                                <h5 class="card-title">Product title</h5>
                                <p class="card-text">Product description</p>
                                <a href="#" class="btn btn-primary">Voeg toe aan winkelmandje</a>
                                <p class="card-text"><small class="text-muted">€ 330,30</small></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <br />
        <?php } ?>
    </div>
</body>
</html>