<?php
    include "./config/db_connect.php";

    $input_error_one = $input_error_two = "";

    if (isset($_POST["sem_cl"])) {
        $sem_fullname = $_POST["sem_fullname"];
        $sem_department = $_POST["sem_department"];
        $sem_intake = $_POST["sem_intake"];
        $sch_fees = $_FILES["sch_fees"]["tmp_name"];
        $sch_fees_destination = "uploads/semester_clearance/" . basename($_FILES["sch_fees"]["name"]);

        if ($sem_fullname == "" || $sem_department == "" || $sem_intake == "" || empty($sch_fees)) {
            $input_error_one = "Input fields cannot be empty";
        }

        if(empty($input_error_one)) {
            if (move_uploaded_file($_FILES["sch_fees"]["tmp_name"], $sch_fees_destination)) {
                $sql = "INSERT INTO semester_clearance (fullname, department, intake, sch_fees) VALUES ('$sem_fullname', '$sem_department', '$sem_intake', '$sch_fees_destination')";
                
                if (mysqli_query($conn, $sql)) {
                    header("Location: clearance_dashboard.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the file.";
            }
        }
    }

    if (isset($_POST["exam_cl"])) {
        $ex_fullname = $_POST["fullname"];
        $ex_department = $_POST["department"];
        $ex_intake = $_POST["intake"];
        $sch_fees = $_FILES["sch_fees"]["tmp_name"];
        $op_dues = $_FILES["op_dues"]["tmp_name"];

        $sch_fees_destination = "uploads/exam_clearance/" . basename($_FILES["sch_fees"]["name"]);
        $op_dues_destination = "uploads/exam_clearance/" . basename($_FILES["op_dues"]["name"]);

        if ($ex_fullname == "" || $ex_department == "" || $ex_intake == "" || empty($sch_fees) || empty($op_dues)) {
            $input_error_two = "Input fields cannot be empty";
        }

        if (empty($input_error_two)) {
            // Move the uploaded files to the designated folder
            if (move_uploaded_file($_FILES["sch_fees"]["tmp_name"], $sch_fees_destination) && move_uploaded_file($_FILES["op_dues"]["tmp_name"], $op_dues_destination)) {
                $sqli = "INSERT INTO exam_clearance (fullname, department, intake, sch_fees, op_dues) VALUES ('$ex_fullname', '$ex_department', '$ex_intake', '$sch_fees_destination', '$op_dues_destination')";

                if (mysqli_query($conn, $sqli)) {
                    header("Location: clearance_dashboard.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the files.";
            }
        }
    }

    include "./template/header.php";
    
?>
    
    <div class="clearance-form">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <div class="breadcrumb-text">
                <p id="date" style="display: none;"></p>
                <div class="welcome-text">
                    <h1>Get cleared to proceed</h1>
                    <p>Start your clearance process</p>
                </div>
            </div>
            <img src="./assets/img/clearance.png" alt="Clearance">
        </div>

        <!-- Clearance Form -->
        <div class="form">
            <div class="form-titles">
                <h3 class="scf active">Semester Clearance</h3>
                <h3 class="ecf">Exam Clearance</h3>
            </div>
            <div class="forms">
                <form action="" method="post" class="semester-clearance" enctype="multipart/form-data">
                    <p style="text-align: center; color: red;"><?php echo $input_error_one ?></p>
                    <div class="form-fields">
                        <div class="form-input">
                            <label for="sem_fullname">Full Name</label>
                            <input type="text" name="sem_fullname">
                        </div>
                        <div class="form-input">
                            <label for="sem_department">Department</label>
                            <input type="text" name="sem_department">
                        </div>
                        <div class="form-input">
                            <label for="sem_intake">Intake</label>
                            <input type="text" name="sem_intake">
                        </div>
                        <div class="form-input">
                            <label for="sch_fees">School Fees</label>
                            <input type="file" name="sch_fees">
                        </div>
                    </div>
                    <button name="sem_cl">Get cleared</button>
                </form>
                <form action="" method="post" class="exam-clearance hidden-form" enctype="multipart/form-data">
                    <p style="text-align: center; color: red;"><?php echo $input_error_two ?></p>
                    <div class="form-fields">
                        <div class="form-input">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname">
                        </div>
                        <div class="form-input">
                            <label for="department">Department</label>
                            <input type="text" name="department">
                        </div>
                        <div class="form-input">
                            <label for="intake">Intake</label>
                            <input type="text" name="intake">
                        </div>
                        <div class="form-input">
                            <label for="sch_fees">School Fees</label>
                            <input type="file" name="sch_fees">
                        </div>
                        <div class="form-input">
                            <label for="op_dues">Operational Dues</label>
                            <input type="file" name="op_dues">
                        </div>
                    </div>
                    <button name="exam_cl">Get cleared</button>
                </form>
            </div>
        </div>
    </div>

<?php
    
    include "./template/footer.php";

?>