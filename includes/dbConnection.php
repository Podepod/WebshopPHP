<?php
    $servername = "zever_db";
    $username = "root";
    $password = "XzeX63xiFFtRWWYG6B4T";
    $database = "zeverinpakskesdb";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>