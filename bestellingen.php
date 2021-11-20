<?php 
    session_start(); 
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
        header("Location: index.php?alert=Enkel de webshopbeheerder kan deze pagina bekijken.");
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
                    <th>KlantID</th>
                    <th>bestellingTijd</th>
                    <th>betaald</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include("./includes/dbConnection.php"); 
                    $sql = "SELECT * FROM bestellingen";
                    $result = mysqli_query($conn, $sql);
                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0){
                        $i = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr> <!-- enkel als voorraad 0 is: class="table-danger" --> 
                        <td><?php echo($row['bestellingID']); ?></td>
                        <td><?php echo($row['klantID']); ?></td>
                        <td>€ <?php echo($row['bestellingTijd']); ?></td> <!-- tot 2 na de komma (altijd) -->
                        <td><?php echo($row['betaald']); ?></td>
                    </tr>
                <?php
                            $i++;
                        }
                    } else {
                        //header('Location: ./index.php/?alert=Geen producten gevonden'); // TODO alert laten werken
                        echo("Geen bestellingen gevonden.");
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
                            <input type="text" class="form-control" id="productImage" name="productImage" readonly>
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