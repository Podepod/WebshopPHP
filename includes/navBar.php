<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"><?php echo($winkelNaam); ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"> <!-- TODO mogelijks dees wegdoen, enkel shopname -->
          <a class="nav-link <?php if($page == "Shop") echo 'active'; ?>" aria-current="page" href="./index.php">Shop</a> 
        </li>

        <?php
          if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if ($page == "Producten" || $page == "Klanten") echo 'active'; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin Panel
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./producten.php"><i class="bi bi-view-list"></i> Producten</a></li>
              <li><a class="dropdown-item" href="./klanten.php"><i class="bi bi-people"></i> Klanten</a></li>
              <li><a class="dropdown-item" href="./bestellingen.php"><i class="bi bi-box-seam"></i> Bestellingen</a></li>
            </ul>
          </li>
        <?php
          }
        ?>
      </ul>
      <ul class="navbar-nav justify-content-end">
        <?php
          if (isset($_SESSION["klantID"])){
        ?>
          <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle <?php if ($page == "Winkelmandje") echo 'active'; ?> href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-cart"></i>

              <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-primary">
                <?php
                  $p = 0;
                  $t = 0;
                  foreach($_SESSION['winkelmandje'] as $product) {
                    $p += $product['hoeveelheid'];
                    $t += $product['hoeveelheid'] * $product['prijs'];
                  }
                  echo($p);
                ?>
                <span class="visually-hidden">Producten in winkelmandje</span>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <!-- TODO fill with products in winkelmandje -->
              <?php if (empty($_SESSION['winkelmandje'])) { ?>
                <p class="dropdown-item mb-0">
                  Uw winkelmandje is momenteel leeg.
                </p>
              <?php } else { foreach($_SESSION['winkelmandje'] as $product) { ?>
                <li>
                  <p class="dropdown-item mb-0">
                    <span class="badge rounded-pill bg-primary"><?php echo($product['hoeveelheid']); ?></span>
                    <?php echo($product['naam']) ?>
                    <small class="text-secondary">€ <?php echo($product['prijs']) ?></small> <!-- prijs per item -->
                  </p>
                </li>
              <?php }} ?>
              <li><hr class="dropdown-divider"></li>
              <li><p class="dropdown-item mb-0">
                <span class="badge rounded-pill bg-primary">Totaal</span> 
                <small class="text-secondary">€ <?php echo($t); ?></small>
              <li><hr class="dropdown-divider"></li>              
              <li><a class="dropdown-item" href="./winkelmandje.php"><i class="bi bi-cart"></i> Ga naar je winkelmandje</a></li>
            </ul>
          </li>
        <?php
          }
        ?>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php if ($page == "Login" || $page == "Signup") echo 'active'; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <?php
              if (isset($_SESSION["klantID"])){
            ?>
              <li><p class="dropdown-item mb-0">
                <i class="bi bi-envelope"></i>
                <?php echo($_SESSION["email"]); ?>
              </p></li>
              <li><p class="dropdown-item mb-0">
                <i class="bi bi-person"></i>
                <?php echo($_SESSION['naam'] . " " . $_SESSION['familieNaam']); ?>
              </p></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./includes/logout.php"><i class="bi bi-box-arrow-right"></i> Uitloggen</a></li>
            <?php
              } else {
            ?>
              <li><a class="dropdown-item" href="./login.php"><i class="bi bi-box-arrow-in-right"></i> Inloggen</a></li>
            <?php
              }
            ?>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>