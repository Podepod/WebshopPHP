<?php 
    session_start(); 
    if (isset($_SESSION['klantID'])){
        header("Location: index.php?alert=Je bent al ingelogt.");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $page = "Signup";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>

        <div id="formAlert">
            
        </div>

        <!-- action="./includes/signup.php" -->
        <form class="card mx-auto loginForm" action="./includes/signup.php" method="POST" onsubmit="return checkSignin(this)" novalidate >
            <div class="card-header">
                <h4>Signup</h4>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" name="naam" class="form-control" id="naam" placeholder="">
                    <label for="naam">Naam</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="familieNaam" class="form-control" id="familieNaam" placeholder="">
                    <label for="familieNaam">Familienaam</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="geboorte" class="form-control" id="geboorte" placeholder="">
                    <label for="geboorte">Geboortedatum</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                    <label for="email">E-mail adres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="">
                    <label for="password2">Herhaal Password</label>
                </div>
                <div class="row m-0 mb-3">
                    <div class="form-floating p-0 col-8">
                        <input type="text" name="straat" class="form-control" id="straat" placeholder="">
                        <label for="straat">Straatnaam</label>
                    </div>
                    <div class="form-floating p-0 col-4">
                        <input type="text" name="nummer" class="form-control" id="nummer" placeholder="">
                        <label for="nummer">Nummer</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="stad" class="form-control" id="stad" placeholder="">
                    <label for="floatingInput">Stad</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="postcode" class="form-control" id="postcode" placeholder="">
                    <label for="floatingInput">Postcode</label>
                </div>
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
            <div class="card-footer">
                <a href="./login.php" class="card-link">Ik heb al een account!</a>
            </div>
        </form>
    </div>
    <script src="./js/formCheck.js"></script>
</body>
</html>