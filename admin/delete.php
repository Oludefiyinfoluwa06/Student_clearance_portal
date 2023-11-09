<?php
    include "./config/db_connect.php";

    $sql1 = "SELECT student_id FROM students";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result);
    $student_id = $row["student_id"];

    $sql = "DELETE FROM students WHERE student_id = '$student_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: students.php?deleteSuccessful");
    } else {
        header("Location: students.php?deleteError");
    }
?>