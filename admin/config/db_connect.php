<?php

    $servername = "localhost";
    $name = "root";
    $password = "";
    $dbname = "clearance_portal";

    $conn = mysqli_connect($servername, $name, $password, $dbname);

    if (!$conn) {
        die("Error connecting to database". mysqli_connect_error());
    }

?>