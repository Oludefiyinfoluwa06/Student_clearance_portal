<?php

    include "./config/db_connect.php";

    $input_error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);
        $prev_password = mysqli_real_escape_string($conn, $_POST["prev_password"]);
        $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);

        $sql = "SELECT password FROM students WHERE student_id = '$student_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $password = $row['password'];

            if (password_verify($prev_password, $password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE students SET password = '$hashed_password' WHERE student_id = '$student_id'";

                if (mysqli_query($conn, $update_sql)) {
                    header("Location: clearance_dashboard.php");
                } else {
                    $input_error = "Error updating password. Please try again.";
                }
            } else {
                $input_error = "Previous password is incorrect.";
            }
        } else {
            $input_error = "Student ID not found.";
        }
    } else {
        $input_error = "";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .body {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .body .info {
            text-align: center;
        }

        .info h1 {
            text-transform: uppercase;
        }

        .body form {
            border-radius: 10px;
            box-shadow: 4px 4px 30px #ccc,
                        -4px -4px 30px #ccc;
            padding: 20px;
            margin-top: 25px;
        }

        form .form-fields {
            width: 100%;
        }

        .form-fields .input-field {
            width: 100%;
        }

        .input-field label {
            font-size: 20px;
        }

        .input-field input {
            width: 100%;
            border: none;
            border-bottom: 1px solid black;
            margin: 10px 0;
            font-size: 16px;
            padding: 4px 0;
            outline: none;
        }

        .input-field:last-child {
            margin-top: 20px;
        }

        form button {
            background: red;
            width: 100%;
            border: none;
            color: white;
            border-radius: 50px;
            padding: 10px;
            text-transform: uppercase;
            margin-top: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="body">
        <div class="info">
            <h1>Change Password</h1>
        </div>
        <form action="" method="post">
            <p style="text-align: center; color: red; margin-bottom: 20px;"><?php echo $input_error; ?></p>
            <div class="form-fields">
                <div class="input-field">
                    <label for="student_id">Student ID</label>
                    <input type="text" name="student_id" id="student_id" placeholder="Enter your Student ID" />
                </div>
                <div class="input-field">
                    <label for="prev_password">Previous password</label>
                    <input type="password" name="prev_password" id="prev_password" placeholder="Enter previous Password" />
                </div>
                <div class="input-field">
                    <label for="new_password">New password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new Password" />
                </div>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>