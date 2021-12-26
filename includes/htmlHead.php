<?php
    $winkelNaam = "Zever In Pakskes";
    $online = false;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title><?php echo("$winkelNaam | $page"); ?></title>

    <!-- online --> 
    <?php if($online){ ?>
        <!-- Bootstrap --> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- offline -->
    <?php } else { ?>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <script src="./bootstrap/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="./bootstrap/icons-1.7.2/font/bootstrap-icons.css">
        
        <!-- jQuery -->
        <script src="./bootstrap/jquery-3.6.0.min.js"></script>
    <?php } ?>
    
    <!-- Own CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>