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

        <!-- php if admin -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php if ($page == "Producten" || $page == "Klanten") echo 'active'; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin Panel
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./producten.php"><i class="bi bi-view-list"></i> Producten</a></li>
            <li><a class="dropdown-item" href="./klanten.php"><i class="bi bi-people"></i> Klanten</a></li>
          </ul>
        </li>
        <!-- php end if -->
      </ul>
      <ul class="navbar-nav justify-content-end">
        <!-- php if logged in -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle <?php if ($page == "Winkelmandje") echo 'active'; ?> href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart"></i>

            <!-- TODO enkel als er iets in winkelmandje zit, dit late zien -->
            <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-primary">
              99+
              <span class="visually-hidden">Producten in winkelmandje</span>
            </span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- TODO fill with products in winkelmandje -->
            <?php for ($i = 0; $i < 6; $i++) { ?>
              <li>
                <p class="dropdown-item mb-0">
                  Product<?php echo($i); ?> 
                  <small class="text-secondary">€330.30</small> <!-- prijs per item -->
                  <span class="badge rounded-pill bg-primary float-end"><?php echo($i); ?></span>
                </p>
              </li>
            <?php } ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./winkelmandje.php"><i class="bi bi-cart"></i> Ga naar je winkelmandje</a></li>
          </ul>
        </li>
      <!-- php end if -->
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php if ($page == "Login" || $page == "Signup") echo 'active'; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- TODO Als nog niet logged in: ipv "Uitloggen" -> "Inloggen" -->
            <li><a class="dropdown-item" href="./logout.php"><i class="bi bi-box-arrow-right"></i> Uitloggen</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex"> <!-- TODO miss dees int midden zetten zoals bol.com -->
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>