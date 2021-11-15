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
        <form class="card mx-auto loginForm"> <!-- TODO id's en names van inputs veranderen -->
            <div class="card-header">
                <h4>Signup</h4>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Herhaal Password" required>
                    <label for="floatingPassword">Herhaal Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="123 Hoofdstraat" required>
                    <label for="floatingInput">Adres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Brussel" required>
                    <label for="floatingInput">Stad</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" placeholder="1000" required>
                    <label for="floatingInput">Postcode</label>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
            <div class="card-footer">
                <a href="./login.php" class="card-link">Ik heb al een account!</a>
            </div>
        </form>
    </div>
</body>
</html>