<?php
    session_start();
    $student_id = $_SESSION["student_id"];

    include "./config/db_connect.php";

    $sqli = "SELECT student_id, firstname, lastname, gender, dob, email, phone, department, intake FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $sqli);
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

    if (isset($_POST["update_profile"])) {
        $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $department = mysqli_real_escape_string($conn, $_POST["department"]);
        $intake = mysqli_real_escape_string($conn, $_POST["intake"]);

        $sqli = "UPDATE students SET firstname = '$firstname', lastname = '$lastname', gender = '$gender', dob = '$dob', email = '$email', phone = '$phone', department = '$department', intake = '$intake' WHERE student_id = '$student_id'";

        $query = mysqli_query($conn, $sqli);

        if ($query) {
            header("Location: profile.php?status=successful");
            exit();
        } else {
            header("Location: profile.php?status=error");
            exit();
        }
    }

    include "./template/header.php";
?>

    <form action="" method="post">
        <div class="form-fields">
            <div class="input-field">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $firstname ?>" />
            </div>
            <div class="input-field">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname ?>" />
            </div>
            <div class="input-field">
                <label for="gender">Gender</label>
                <input type="text" name="gender" id="gender" value="<?php echo $gender ?>" />
            </div>
            <div class="input-field">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="<?php echo $dob ?>" />
            </div>
            <div class="input-field">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>" />
            </div>
            <div class="input-field">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" />
            </div>
            <div class="input-field">
                <label for="department">Department</label>
                <input type="text" name="department" id="department" value="<?php echo $department ?>" />
            </div>
            <div class="input-field">
                <label for="intake">Intake</label>
                <input type="text" name="intake" id="intake" value="<?php echo $intake ?>" />
            </div>
        </div>
        <button type="submit" name="update_profile">Update Profile</button>
    </form>
    <p id="date" style="display: none;"></p>

<?php
    include "./template/footer.php";
?>
