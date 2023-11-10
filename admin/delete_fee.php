<?php
    include "./config/db_connect.php";

    $sql1 = "SELECT department FROM fees";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result);
    $department = $row["department"];

    $sql = "DELETE FROM fees WHERE department = '$department'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: fees.php?deleteSuccessful");
    } else {
        header("Location: fees.php?deleteError");
    }
?>