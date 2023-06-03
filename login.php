<?php 
    session_start(); 
    if (isset($_SESSION['klantID'])){
        header("Location: ./index.php?alert=Je bent al ingelogt.");
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
        <form class="card mx-auto loginForm" action="./includes/login.php" method="POST">
            <div class="card-header">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                    <label for="email">E-mail adres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
            <div class="card-footer">
                <a href="?alert=Jammer, volgende keer beter! 😕" class="card-link">Wachtwoord vergeten?</a>
                <a href="./signup.php" class="card-link">Ik heb nog geen account?</a>
            </div>
        </form>
    </div>
</body>
</html>