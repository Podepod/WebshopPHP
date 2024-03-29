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
    $page = "Producten";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>

        <button 
            type="submit" 
            class="btn float-end btn-outline-success" 
            data-bs-toggle="modal"  
            data-bs-target="#productModal"
            data-bs-formAction="create"
        >
            Product toevoegen knop
        </button>
        <h4>Producten</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Productnaam</th>
                    <th>Prijs</th>
                    <th>Voorraad</th>
                    <th>Afbeelding</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "SELECT * FROM producten WHERE verwijderd=0";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        $i = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr <?php if($row['voorraad'] == 0) echo('class="table-danger"'); ?>> <!-- enkel als voorraad 0 is: class="table-danger" --> 
                        <td><?php echo($row['productID']); ?></td>
                        <td><?php echo($row['naam']); ?></td>
                        <td>€ <?php echo($row['prijs']); ?></td> <!-- tot 2 na de komma (altijd) -->
                        <td><?php echo($row['voorraad']); ?></td>
                        <td><?php echo($row['afbeeldingNaam']); ?></td> <!-- afbeeldingen opgeslaan in ./images/products/ met deze naam dan -->
                        <td>
                            <button 
                                type="submit" 
                                class="btn btn-outline-<?php if($row['voorraad'] == 0) echo('danger"'); else echo('warning'); ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#productModal" 
                                data-bs-formAction="edit"
                                data-bs-productID="<?php echo($row['productID']); ?>"
                                data-bs-productName="<?php echo($row['naam']); ?>"
                                data-bs-productDescription="<?php echo($row['beschrijving']); ?>"
                                data-bs-productPrice="<?php echo($row['prijs']); ?>"
                                data-bs-productStock="<?php echo($row['voorraad']); ?>"
                                data-bs-productImage="<?php echo($row['afbeeldingNaam']); ?>"
                            >
                                Wijzig product
                            </button>
                        </td> <!-- opent modal? -->
                        <td>
                            <form action="./includes/delete_product.php" method="POST">
                                <input type="hidden" name="productID" value="<?php echo($row['productID']); ?>">
                                <button type="submit" name="productVerwijderen" value="Verwijderen" class="btn btn-outline-danger">Verwijder product</button>
                            </form>
                        </td>
                    </tr>
                <?php
                            $i++;
                        }
                    } else {
                        echo("Geen producten gevonden.");
                    }    

                ?>
            </tbody>
        </table>

        <h4>Verwijderde producten</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Productnaam</th>
                    <th>Prijs</th>
                    <th>Voorraad</th>
                    <th>Afbeelding</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "SELECT * FROM producten WHERE verwijderd=1";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        $i = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr class="text-secondary<?php if($row['voorraad'] == 0) echo('table-danger'); ?>"> <!-- enkel als voorraad 0 is: class="table-danger" --> 
                        <td><?php echo($row['productID']); ?></td>
                        <td><?php echo($row['naam']); ?></td>
                        <td>€ <?php echo($row['prijs']); ?></td> <!-- tot 2 na de komma (altijd) -->
                        <td><?php echo($row['voorraad']); ?></td>
                        <td><?php echo($row['afbeeldingNaam']); ?></td> <!-- afbeeldingen opgeslaan in ./images/products/ met deze naam dan -->
                        <td>
                            <button 
                                type="submit" 
                                class="btn btn-outline-<?php if($row['voorraad'] == 0) echo('danger"'); else echo('warning'); ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#productModal" 
                                data-bs-formAction="edit"
                                data-bs-productID="<?php echo($row['productID']); ?>"
                                data-bs-productName="<?php echo($row['naam']); ?>"
                                data-bs-productDescription="<?php echo($row['beschrijving']); ?>"
                                data-bs-productPrice="<?php echo($row['prijs']); ?>"
                                data-bs-productStock="<?php echo($row['voorraad']); ?>"
                                data-bs-productImage="<?php echo($row['afbeeldingNaam']); ?>"
                            >
                                Wijzig product
                            </button>
                        </td> <!-- opent modal? -->
                        <td>
                            <form action="./includes/delete_product.php" method="POST">
                                <input type="hidden" name="productID" value="<?php echo($row['productID']); ?>">
                                <button type="submit" name="productVerwijderen" value="Terugzetten" class="btn btn-outline-success">Zet product terug</button>
                            </form>
                        </td>
                    </tr>
                <?php
                            $i++;
                        }
                    } else {
                        echo("Geen producten gevonden.");
                    }    

                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productFormModal" action="./includes/productForm.php" method="post">
                        <input type="hidden" name="formAction" id="formAction">
                        <div class="mb-3">
                            <label for="productID" class="col-form-label">ProductID:</label>
                            <input type="number" class="form-control" id="productID" name="productID" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="col-form-label">Productnaam:</label>
                            <input type="text" class="form-control" id="productName" name="productName">
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="col-form-label">Product beschrijving:</label>
                            <textarea class="form-control" name="productDescription" id="productDescription" name="productDescription" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="col-form-label">Prijs:</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="col-form-label">Voorraad:</label>
                            <input type="number" class="form-control" id="productStock" name="productStock">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="col-form-label">Afbeelding:</label>
                            <input type="text" class="form-control" id="productImage" name="productImage">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input id="productAanpassenSubmit" name="productAanpassenSubmit" type="submit" class="btn btn-primary" form="productFormModal">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal script -->
    <script src="./js/ProductModals.js" type="application/javascript"></script>
</body>
</html>