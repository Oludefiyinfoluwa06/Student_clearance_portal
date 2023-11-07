<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clearance_portal";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Error connecting to database". mysqli_connect_error());
    }

?>