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
    $page = "Login";
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
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3"> <!-- TODO als email niet bestaat class+= "is-invalid" -->
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">E-mail adres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
            <div class="card-footer">
                <a href="?alert=Jammer, volgende keer beter! 😕" class="card-link">Wachtwoord vergeten?</a>
                <a href="./signup.php" class="card-link">Ik heb nog geen account?</a>
                <a href="./includes/login.php" class="card-link">Tijdelijke Session Login</a>
            </div>
        </form>
    </div>
</body>
</html>