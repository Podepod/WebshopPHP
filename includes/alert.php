<?php
    if (isset($_GET["alert"])){
        $alert = htmlspecialchars($_GET["alert"]);
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong><?php echo($alert); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    } elseif (isset($_GET["success"])){
        $success = htmlspecialchars($_GET["success"]);
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-lg"></i>
        <strong><?php echo($success); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    }
?>