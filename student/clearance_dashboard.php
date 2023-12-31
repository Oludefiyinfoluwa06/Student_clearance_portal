<?php
    session_start();
    
    $student_id = $_SESSION["student_id"];

    if (!isset($student_id)) {
        header("Location: login.php");
    }

    include "./config/db_connect.php";

    $sql = "SELECT firstname, department, schol_perc FROM students WHERE student_id = '$student_id'";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $firstname = $row["firstname"];
    $department = $row["department"];
    $schol_perc = $row["schol_perc"];

    $sqli = "SELECT * FROM fees where department = '$department'";
    $resulti = mysqli_query($conn, $sqli);

    if ($resulti) {
        if (mysqli_num_rows($resulti) > 0) {
            $row = mysqli_fetch_assoc($resulti);
            $tuition = $row["tuition"];
            $miscellaneous = $row["miscellaneous"];
            $operational_dues = $row["operational_dues"];
        } else {
            $tuition = "N/A";
            $miscellaneous = "N/A";
            $operational_dues = "N/A";
        }
    }

    include "./template/header.php";

?>

    <div class="dashboard">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <div class="breadcrumb-text">
                <p id="date"></p>
                <div class="welcome-text">
                    <h1>Welcome back, <?php echo $firstname ?>!</h1>
                    <p>Get cleared to proceed with your course registration</p>
                </div>
            </div>
            <img src="./assets/img/student.png" alt="Students">
        </div>

        <!-- Fees -->
        <div class="student-fees">
            <h1 class="">Fees</h1>
            <div class="fees">
                <div class="sch-fees hidden">
                    <i class="fa fa-money"></i>
                    <h2 style="margin-top: 14px; margin-bottom: 7px;">#<?php echo $tuition ?></h2>
                    <p>Tuition fee</p>
                </div>
                <div class="sch-fees hidden">
                    <i class="fa fa-money"></i>
                    <h2 style="margin-top: 14px; margin-bottom: 7px;">#<?php echo $miscellaneous ?></h2>
                    <p>Miscellaneous fee</p>
                </div>
                <div class="sch-fees hidden">
                    <i class="fa fa-money"></i>
                    <h2 style="margin-top: 14px; margin-bottom: 7px;">#<?php echo $operational_dues ?></h2>
                    <p>Operational Dues</p>
                </div>
                <div class="sch-fees hidden">
                    <i class="fa fa-money"></i>
                    <h2 style="margin-top: 14px; margin-bottom: 7px;">#<?php echo (intval($tuition) - (intval($tuition) * (intval($schol_perc) / 100))) ?></h2>
                    <p>Tuition after scholarship</p>
                </div>
            </div>
        </div>

        <!-- Courses -->
        <div class="courses">
            <div class="course-title">
                <h1>Enrolled Courses</h1>
                <a href="courses.php">See all</a>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column; margin-top: 20px;">
                <p>You have not registered for any course yet!</p>
                <a href="course_reg.php" style="margin-top: 10px;">Register now</a>
            </div>
        </div>

    </div>

<?php

    include "./template/footer.php";

?>