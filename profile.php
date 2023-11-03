<?php
    session_start();
    $student_id = $_SESSION["student_id"];

    include "./config/db_connect.php";
    
    $sql = "SELECT student_id, firstname, lastname, gender, dob, email, phone, department, intake FROM students WHERE student_id = '$student_id'";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $student_id = $row["student_id"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $gender = $row["gender"];
            $dob = $row["dob"];
            $email = $row["email"];
            $phone = $row["phone"];
            $department = $row["department"];
            $intake = $row["intake"];
        }
    }

    include "./template/header.php";

?>

    <div class="profile-container">
        <p id="date" style="display: none;"></p>
        <h1>Student Profile</h1>

        <div class="profile">
            <div class="profile-info">
                <p>Student ID</p>
                <p><?php echo $student_id ?></p>
            </div>
            <div class="profile-info">
                <p>Firstname</p>
                <p><?php echo $firstname ?></p>
            </div>
            <div class="profile-info">
                <p>Lastname</p>
                <p><?php echo $lastname ?></p>
            </div>
            <div class="profile-info">
                <p>Gender</p>
                <p><?php echo $gender ?></p>
            </div>
            <div class="profile-info">
                <p>Date of Birth</p>
                <p><?php echo $dob ?></p>
            </div>
            <div class="profile-info">
                <p>Email Address</p>
                <p><?php echo $email ?></p>
            </div>
            <div class="profile-info">
                <p>Phone Number</p>
                <p><?php echo $phone ?></p>
            </div>
            <div class="profile-info">
                <p>Department</p>
                <p><?php echo $department ?></p>
            </div>
            <div class="profile-info">
                <p>Intake</p>
                <p><?php echo $intake ?></p>
            </div>
        </div>

        <a href="edit_profile.php"><button class="btn">Edit Profile</button></a>
        <a href="logout.php"><button class="btn">Logout</button></a>
    </div>

<?php

    include "./template/footer.php";

?>