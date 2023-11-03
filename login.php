<?php
    session_start();

    if (isset($_SESSION["student_id"])) {
        header("Location: clearance_dashboard.php");
    }

    include "./config/db_connect.php";

    $student_id = $password = $input_error = "";

    if (isset($_POST["login"])) {
        $student_id = $_POST["student_id"];
        $password = $_POST["password"];

        if ($student_id == "" || $password == "") {
            $input_error = "Input fields cannot be empty";
        } else {
            $input_error = "";
        }

        if (empty($input_error)) {
            $sql = "SELECT student_id, password FROM students WHERE student_id = '$student_id'";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["student_id"] = $row["student_id"];
                        header("location: clearance_dashboard.php");
                    } else {
                        $input_error = "Incorrect password";
                    }
                } else {
                    $input_error = "Account does not exist";
                }
            } else {
                $input_error = "Server error";
            }
        }
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
            <h1>Student Login</h1>
            <p>Login to the portal to continue your clearance process</p>
        </div>
        <form action="" method="post">
            <p style="text-align: center; color: red; margin-bottom: 20px;"><?php echo $input_error; ?></p>
            <div class="form-fields">
                <div class="input-field">
                    <label for="student_id">Student ID</label>
                    <input type="text" name="student_id" id="student_id" placeholder="Enter your Student ID" value="<?php echo htmlspecialchars($student_id) ?>" />
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your Password" value="<?php echo htmlspecialchars($password) ?>" />
                </div>
            </div>
            <button type="submit" name="login" style=" margin-bottom: 10px;">Login</button>
            <a href="edit_password.php">Change Password</a>
        </form>
    </div>
</body>
</html>