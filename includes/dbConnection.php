<?php
    $servername = "localhost";
    $username = "Webuser";
    $password = "Lab2021";
    $database = "ZeverInPakskesDB";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>