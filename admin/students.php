<?php 
    session_start();
    
    $username = $_SESSION["username"];

    if (!isset($username)) {
        header("Location: login.php");
    }

    include "./config/db_connect.php";

    $sql = "SELECT * FROM students ORDER BY department ASC";
    $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
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

        .students {
            padding: 30px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .sort-by {
            padding: 7px 17px;
            background: #fff;
            box-shadow: 3px 3px 7px #ccc;
            border: none;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: row;
            gap: 0.3rem;
        }

        .table-titles {
            border: 1px solid #ccc;
            position: absolute;
            top: 143px;
            left: 89%;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(9px);
            color: #000;
            display: none;
            border-radius: 10px;
        }

        .table-titles p {
            padding: 8px;
            cursor: pointer;
            color: #333;
        }

        .table-titles p:hover {
            color: #000;
        }

        .table-titles p:not(:last-child) {
            border-bottom: 1px solid #ccc;
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

        #hide-titles, #show-titles {
            cursor: pointer;
        }

        #hide-titles {
            margin-left: 2px;
            display: none;
        }

        .add-students button {
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

    <div class="students">
        <div class="header">
            <h2>All Students</h2>
        </div>
        <div id="student-table">
            <table>
                <thead>
                    <!-- <th>S/N</th> -->
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Intake</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <!-- <td><?php echo $row["id"] ?></td> -->
                            <td><?php echo $row["lastname"] . " " . $row["firstname"] ?></td>
                            <td><?php echo $row["student_id"] ?></td>
                            <td><?php echo $row["gender"] ?></td>
                            <td><?php echo $row["department"] ?></td>
                            <td><?php echo $row["intake"] ?></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="add_students.php" class="add-students"><button>Add students</button></a>
        </div>
    </div>
    
</body>
</html>