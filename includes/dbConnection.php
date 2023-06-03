<?php
    $servername = "zever_db";
    $username = "Lode";
    $password = "sowpFK8hg7Dh8iVF7LTG";
    $database = "ZeverInPakskesDB";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>