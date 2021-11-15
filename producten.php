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
                <?php for($i = 0; $i < 7; $i++){ ?>
                    <tr <?php if($i == 4) echo('class="table-danger"') ?>> <!-- enkel als stock 0 is: class="table-danger" --> 
                        <td><?php echo($i); ?></td>
                        <td>Product<?php echo($i); ?></td> 
                        <td>330.30</td> <!-- tot 2 na de komma (altijd) -->
                        <td>12</td>
                        <td>productnaam.png</td> <!-- afbeeldingen opgeslaan in ./images/products/ met deze naam dan -->
                        <td>
                            <button 
                                type="submit" 
                                class="btn btn-outline-<?php if($i == 4) echo('danger"'); else echo('warning'); ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#productModal" 
                                data-bs-formAction="edit"
                                data-bs-productID="<?php echo($i); ?>"
                                data-bs-productName="Product<?php echo($i); ?>"
                                data-bs-productPrice="330.30"
                                data-bs-productStock="12"
                                data-bs-productImage="Afbeelding"
                            >
                                Wijzig product
                            </button>
                        </td> <!-- opent modal? -->
                        <td>
                            <form action=""> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                <button type="submit" class="btn btn-outline-danger">Verwijder product</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button 
            type="submit" 
            class="btn float-end btn-outline-success" 
            data-bs-toggle="modal"  
            data-bs-target="#productModal"
            data-bs-formAction="create"
        >
            Product toevoegen knop
        </button>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="formAction" id="formAction">
                        <div class="mb-3">
                            <label for="productID" class="col-form-label">productID:</label>
                            <input type="number" class="form-control" id="productID" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="col-form-label">productNaam:</label>
                            <input type="text" class="form-control" id="productName">
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="col-form-label">Prijs:</label>
                            <input type="number" class="form-control" id="productPrice">
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="col-form-label">Voorraad:</label>
                            <input type="number" class="form-control" id="productStock">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="col-form-label">Afbeelding:</label>
                            <input type="text" class="form-control" id="productImage">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Verstuur</button> <!-- moet form versturen -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal script -->
    <script src="./js/ProductModals.js" type="application/javascript"></script>
</body>
</html>