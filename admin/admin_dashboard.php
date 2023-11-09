<?php
    session_start();
    
    $username = $_SESSION["username"];

    if (!isset($username)) {
        header("Location: login.php");
    }

    include "./config/db_connect.php";

    $sql = "SELECT username FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $username = $row["username"];
        }
    }

    $sql1 = "SELECT * FROM students ORDER BY created_at ASC LIMIT 5";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "SELECT * FROM lecturers ORDER BY created_at ASC LIMIT 5";
    $result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
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

        .dashboard {
            padding: 30px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap-reverse;
            background: #dd1b22;
            color: white;
            border-radius: 20px;
            padding: 20px 0;
        }

        .breadcrumb .breadcrumb-text {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            margin-left: 30px;
        }

        .head-count {
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            margin-top: 30px;
            cursor: pointer;
        }

        .student-count, .lecturers-count {
            background: #dd1b22;
            padding: 7px 13px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            border: 2px solid #dd1b22;
        }

        .lecturers-count {
            background: white;
            color: #dd1b22;
        }

        .student-count:hover, .lecturers-count:hover {
            background: #dd1b22;
            color: #fff;
            transition: .5s;
        }

        #student-table {
            width: 100%;
            overflow-x: scroll;
            overflow-y: hidden;
        }
        
        #student-table::-webkit-scrollbar {
            height: 8px;
        }

        #student-table::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 50px;
        }

        #student-table table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        thead th {
            background-color: #dd1b22;
            color: #fff;
            font-weight: bold;
            text-align: left;
            padding: 10px;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        tbody tr:hover {
            background-color: #ffedee;
            cursor: pointer;
        }

        .see-all button {
            margin-top: 20px;
            width: 100%;
            padding: 8px;
            color: #fff;
            background: #dd1b22;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .lecturers {
            display: none;
        }

        .no-lect-text {
            font-size: 30px;
            margin-top: 10px;
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

    <div class="dashboard">
        <div class="breadcrumb">
            <div class="breadcrumb-text">
                <p id="date"></p>
                <div class="welcome-text">
                    <h1>Welcome back, <?php echo $username ?>!</h1>
                    <p>Check out recent activities in your dashboard</p>
                </div>
            </div>
        </div>

        <div class="head-count">
            <div class="student-count">
                <div class="count">
                    <h2>Total Students</h2>
                    <h2>
                        <?php if (mysqli_num_rows($result1) == 0) {
                            echo 0;
                        } else {
                            echo "null";
                        } ?>
                    </h2>
                </div>
            </div>
            <div class="lecturers-count">
                <div class="count">
                    <h2>Total Lecturers</h2>
                    <h2>
                        <?php if (mysqli_num_rows($result2) == 0) {
                            echo 0;
                        } else {
                            echo "";
                        } ?>
                    </h2>
                </div>
            </div>
        </div>

        <div id="student-table">
            <table>
                <thead>
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Intake</th>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result1)): ?>
                        <tr>
                            <td><?php echo $row["lastname"] . " " . $row["firstname"] ?></td>
                            <td><?php echo $row["student_id"] ?></td>
                            <td><?php echo $row["gender"] ?></td>
                            <td><?php echo $row["department"] ?></td>
                            <td><?php echo $row["intake"] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="students.php" class="see-all"><button>See all</button></a>
        </div>

        <div class="lecturers">
            <?php if (mysqli_num_rows($result2) == 0) { ?>
                <p class="no-lect-text">There are no lecturers yet</p>
            <?php } else { ?>
            <div id="lecturers-table">
                <table>
                    <thead>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result2)): ?>
                            <tr>
                                <td><?php echo $row["lastname"] . " " . $row["firstname"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["phone"] ?></td>
                                <td><?php echo $row["gender"] ?></td>
                                <td><?php echo $row["dob"] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <a href="lecturers.php" class="see-all"><button>See all</button></a>
            </div>
            <?php } ?>
        </div>

    </div>

    <script>
        // View Students and Lecturers
        document.querySelector('.lecturers-count').addEventListener('click', () => {
            document.querySelector('.student-count').style.background = "white";
            document.querySelector('.student-count').style.color = "#dd1b22";
            document.querySelector('.lecturers-count').style.background = "#dd1b22";
            document.querySelector('.lecturers-count').style.color = "white";
            document.getElementById('student-table').style.display = "none";
            document.querySelector('.lecturers').style.display = "block";
        });
        
        document.querySelector('.student-count').addEventListener('click', () => {
            document.querySelector('.lecturers-count').style.background = "white";
            document.querySelector('.lecturers-count').style.color = "#dd1b22";
            document.querySelector('.student-count').style.background = "#dd1b22";
            document.querySelector('.student-count').style.color = "white";
            document.getElementById('student-table').style.display = "block";
            document.querySelector('.lecturers').style.display = "none";
        });
    </script>

<?php

    include "./template/footer.php";

?>