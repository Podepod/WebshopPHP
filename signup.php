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
        <form class="card mx-auto loginForm" action="./includes/signup.php" method="POST">
            <div class="card-header">
                <h4>Signup</h4>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" name="naam" class="form-control" id="naam" placeholder="Lode" required>
                    <label for="naam">Naam</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="familieNaam" class="form-control" id="familieNaam" placeholder="Gilis" required>
                    <label for="familieNaam">Familienaam</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="geboorte" class="form-control" id="geboorte" placeholder="06/11/2000" required>
                    <label for="geboorte">Geboortedatum</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                    <label for="email">E-mail adres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Herhaal Password" required>
                    <label for="password2">Herhaal Password</label>
                </div>
                <div class="row m-0 mb-3">
                    <div class="form-floating p-0 col-8">
                        <input type="text" name="straat" class="form-control" id="straat" placeholder="123 Hoofdstraat" required>
                        <label for="straat">Straatnaam</label>
                    </div>
                    <div class="form-floating p-0 col-4">
                        <input type="text" name="nummer" class="form-control" id="nummer" placeholder="20A" required>
                        <label for="nummer">Nummer</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="stad" class="form-control" id="floatingInput" placeholder="Brussel" required>
                    <label for="floatingInput">Stad</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="postcode" class="form-control" id="floatingInput" placeholder="1000" required>
                    <label for="floatingInput">Postcode</label>
                </div>
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
            <div class="card-footer">
                <a href="./login.php" class="card-link">Ik heb al een account!</a>
            </div>
        </form>
    </div>
</body>
</html>