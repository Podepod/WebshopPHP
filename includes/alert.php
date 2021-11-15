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
    }
?>