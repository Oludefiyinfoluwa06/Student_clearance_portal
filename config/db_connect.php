<?php

    $servername = "sql9.freemysqlhosting.net";
    $username = "sql9659205";
    $password = "cr5ryrXrwT";
    $dbname = "sql9659205";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Error connecting to database". mysqli_connect_error());
    }

?>