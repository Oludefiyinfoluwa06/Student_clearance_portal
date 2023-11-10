<?php
    include "./config/db_connect.php";

    $student_id = $firstname = $lastname = $email = $gender = $dob = $phone = $department = $intake = $schol_perc = $input_error = "";

    if (isset($_POST["add_student"])) {
        $student_id = $_POST["student_id"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $phone = $_POST["phone"];
        $department = $_POST["department"];
        $intake = $_POST["intake"];
        $schol_perc = $_POST["schol_perc"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if ($student_id == "" || $firstname == "" || $lastname == "" || $email == "" || $gender == "" || $dob == "" || $phone == "" || $department == "" || $intake == "" || $schol_perc == "" || $password == "") {
            $input_error = "Input fields cannot be empty";
        } else {
            $input_error = "";
        }

        if (empty($input_error)) {
            $sql = "SELECT student_id FROM students WHERE student_id = '$student_id'";
            $result1 = mysqli_query($conn, $sql);

            if ($result1) {
                $row = mysqli_fetch_array($result1);
                if ($row["student_id"] == $student_id) {
                    $input_error = "Student ID exists already";
                } else {
                    $query = "INSERT INTO students (student_id, firstname, lastname, email, gender, dob, phone, department, intake, schol_perc, password) VALUES ('$student_id', '$firstname', '$lastname', '$email', '$gender', '$dob', '$phone', '$department', '$intake', '$schol_perc', '$password')";
                    $result2 = mysqli_query($conn, $query);

                    if ($result2) {
                        header("Location: students.php");
                        exit();
                    } else {
                        $input_error = "There was an error adding student";
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url("../student/assets/img/lincoln.webp");
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            box-shadow: 4px 3px 8px #ccc;
            background: #fff;
        }

        nav img {
            width: 150px;
        }

        nav .button {
            padding: 7px 17px;
            background: #fff;
            box-shadow: 3px 3px 7px #ccc;
            border: none;
            border-radius: 50px;
            color: red;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        nav .button a {
            text-decoration: none;
            font-size: 20px;
            color: #dd1b22;
        }
        
        nav .button i {
            cursor: pointer;
            font-size: 20px;
            display: none;
        }

        nav .sections {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            list-style: none;
        }

        .sections a {
            text-decoration: none;
            color: black;
            text-transform: uppercase;
        }

        .sections a:hover {
            color: red;
            transition: .5s;
        }

        .add-students {
            padding: 30px;
        }

        .add-students h2, .add-students p {
            text-align: center;
            color: #fff;
        }

        .add-students form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(9px);
            color: #fff;
            border-radius: 10px;
        }

        form .input-group {
            width: 100%;
        }

        form .input-group.two .input-box, .input-group.three .input-box, .input-group.four .input-box {
            width: 48.8%;
        }

        .input-group.two, .input-group.three, .input-group.four {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            width: 100%;
            gap: 1rem;
        }
        
        input, select {
            width: 100%;
            margin-bottom: 13px;
            padding: 6px 2px;
            outline: none;
        }

        form .input-group label {
            font-size: 18px;
            margin-bottom: 8px;
        }

        form button {
            width: 100%;
            color: #fff;
            background: #dd1b22;
            border: 0;
            padding: 8px;
            border-radius: 7px;
            text-transform: uppercase;
            cursor: pointer;
        }

        @media screen and (max-width: 1270px) {
            form .input-group.two .input-box, .input-group.three .input-box, .input-group.four .input-box {
                width: 100%;
            }
            .input-group.two, .input-group.three, .input-group.four {
                gap: 0;
            }
        }

        @media screen and (max-width: 900px) {
            nav .sections {
                width: 100%;
                position: absolute;
                top: -100%;
                left: 0;
                background: #fff;
                padding: 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                transition: .5s;
            }
            nav .button i {
                display: block;
            }
            #close {
                display: none;
            }
            .add-students form {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav>
        <img src="https://img1.wsimg.com/isteam/ip/0d532241-dda1-42d3-9ca9-6c0bd972594a/Logo%20Trans-fde57a7.png/:/rs=w:814,h:160,cg:true,m/cr=w:814,h:160/qt=q:95" alt="Lincoln" />
        <ul class="sections">
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="lecturers.php">Lecturers</a></li>
            <li><a href="fees.php">Fees</a></li>
        </ul>
        <div class="button">
            <a href="logout.php" class="fa fa-sign-out" id="logout-icon" title="Logout"></a>
            <i class="fa fa-bars" id="menu"></i>
            <i class="fa fa-close" id="close"></i>
        </div>
    </nav>

    <div class="add-students">
        <h2>Add Students</h2>
        <p>Fill in the Students' Information</p>
        <form action="" method="post">
            <p style="margin: 8px; text-align: center; color: #dd1b22;"><?php echo $input_error ?></p>
            <div class="input-group one">
                <div class="input-box">
                    <label for="student_id">Student ID</label>
                    <input type="text" placeholder="Student ID" name="student_id" id="student_id" value="<?php htmlspecialchars($student_id) ?>">
                </div>
            </div>
            <div class="input-group two">
                <div class="input-box">
                    <label for="firstname">Firstname</label>
                    <input type="text" placeholder="Firstname" name="firstname" id="firstname" value="<?php htmlspecialchars($firstname) ?>">
                </div>
                <div class="input-box">
                    <label for="lastname">Lastname</label>
                    <input type="text" placeholder="Lastname" name="lastname" id="lastname" value="<?php htmlspecialchars($lastname) ?>">
                </div>
            </div>
            <div class="input-group three">
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Email Address" name="email" id="email" value="<?php htmlspecialchars($email) ?>">
                </div>
                <div class="input-box">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="input-group four">
                <div class="input-box">
                    <label for="dob">Date of birth</label>
                    <input type="date" placeholder="Date of Birth" name="dob" id="dob" value="<?php htmlspecialchars($dob) ?>">
                </div>
                <div class="input-box">
                    <label for="phone">Phone Number</label>
                    <input type="tel" placeholder="Phone Number" name="phone" id="phone" value="<?php htmlspecialchars($phone) ?>">
                </div>
            </div>
            <div class="input-group five">
                <div class="input-box">
                    <label for="department">Department</label>
                    <select name="department" id="department">
                        <option value="">Select Department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mass Communication">Mass Communication</option>
                        <option value="Banking Operations">Banking Operations</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Medicine">Medicine</option>
                        <option value="Psychology">Psychology</option>
                    </select>
                </div>
            </div>
            <div class="input-group six">
                <div class="input-box">
                    <label for="intake">Intake</label>
                    <select name="intake" id="intake">
                        <option value="">Select Intake</option>
                        <option value="November 2022">November 2022</option>
                        <option value="March 2023">March 2023</option>
                        <option value="July 2023">July 2023</option>
                        <option value="November 2023">November 2023</option>
                    </select>
                </div>
            </div>
            <div class="input-group seven">
                <div class="input-box">
                    <label for="schol_perc">Scholarship Percentage</label>
                    <input type="text" placeholder="Scholarship Percentage" name="schol_perc" id="schol_perc" value="<?php htmlspecialchars($schol_perc) ?>">
                </div>
            </div>
            <div class="input-group eight">
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password" id="password" value="<?php htmlspecialchars($password) ?>">
                </div>
            </div>
            <button name="add_student">Add Student</button>
        </form>
    </div>

    <p id="date" style="display: none;"></p>

<?php

    include "./template/footer.php";

?>