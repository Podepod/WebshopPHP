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
        
        <form class="form-floating mb-3">
            <input class="form-control me-2" type="text" name="search" id="search" value="">
            <label for="search">Zoek een product</label>
        </form>
    </div>
    <div id="products" class="container p-4">
    </div>

    <!-- search script -->
    <script src="./js/productSearch.js" type="application/javascript"></script>
</body>
</html>