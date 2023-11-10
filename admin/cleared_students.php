<?php

    include "./config/db_connect.php";

    $sql = "SELECT * FROM semester_clearance";
    $result = mysqli_query($conn, $sql);

    $scount_query = "SELECT COUNT(*) as total_scl FROM semester_clearance";
    $scount_result = mysqli_query($conn, $scount_query);

    if ($scount_result) {
        $stotal_count = mysqli_fetch_assoc($scount_result)['total_scl'];
    } else {
        $stotal_count = "Error fetching total count";
    }

    $ecount_query = "SELECT COUNT(*) as total_ecl FROM exam_clearance";
    $ecount_result = mysqli_query($conn, $ecount_query);

    if ($ecount_result) {
        $etotal_count = mysqli_fetch_assoc($ecount_result)['total_ecl'];
    } else {
        $etotal_count = "Error fetching total count";
    }

    $sqli = "SELECT * FROM exam_clearance";
    $resulti = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleared Students</title>
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

        .clearance-dash {
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

        .breadcrumb .welcome-text {
            padding: 20px;
        }

        .view-clearance {
            margin-top: 20px;
        }

        .clearance {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        .student-clearance {
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 15px;
        }

        .student-clearance p {
            padding: 8px 10px 0 10px;
            text-transform: uppercase;
            text-align: center;
        }

        .student-clearance img {
            width: 300px;
            height: 250px;
            border-radius: 0 0 15px 15px;
            margin-bottom: -5.5px;
            margin-top: 10px;
        }

        .cleared-students {
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 30px;
            cursor: pointer;
        }

        .scl-count, .ecl-count {
            background: #dd1b22;
            padding: 7px 13px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            border: 2px solid #dd1b22;
        }

        .ecl-count {
            background: white;
            color: #dd1b22;
        }

        .scl-count:hover, .ecl-count:hover {
            background: #dd1b22;
            color: #fff;
            transition: .5s;
        }

        #ecl {
            display: none;
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

    <div class="clearance-dash">
        <div class="breadcrumb">
            <div class="welcome-text">
                <h1>Clearance Dashboard</h1>
                <p>Check out students that have cleared themselves for the semester</p>
            </div>
        </div>

        <div class="cleared-students">
            <div class="scl-count">
                <div class="count">
                    <h2>Semester Clearance (total)</h2>
                    <h2><?php echo $stotal_count ?></h2>
                </div>
            </div>
            <div class="ecl-count">
                <div class="count">
                    <h2>Exam Clearance (total)</h2>
                    <h2><?php echo $etotal_count ?></h2>
                </div>
            </div>
        </div>

        <div class="view-clearance" id="scl">
            <h2 style="text-align: center; margin-bottom: 20px;">Students cleared for the semester</h2>    
            <div class="clearance">
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="student-clearance">
                            <p><?php echo $row["fullname"] ?></p>
                            <p><?php echo $row["department"] ?></p>
                            <p><?php echo $row["intake"] ?></p>
                            <img src="../student/<?php echo $row["sch_fees"] ?>" alt="School fees receipt">
                        </div>
                    <?php endwhile;
                } else { ?>
                    <p>No student is cleared yet</p>
                <?php } ?>
            </div>
        </div>

        <div class="view-clearance" id="ecl">
            <h2 style="text-align: center; margin-bottom: 20px;">Students cleared for the exam</h2>    
            <div class="clearance">
                <?php if (mysqli_num_rows($resulti) > 0) {
                    while ($row = mysqli_fetch_assoc($resulti)): ?>
                        <div class="student-clearance">
                            <p><?php echo $row["fullname"] ?></p>
                            <p><?php echo $row["department"] ?></p>
                            <p><?php echo $row["intake"] ?></p>
                            <img src="../student/<?php echo $row["sch_fees"] ?>" alt="School fees receipt">
                            <img src="../student/<?php echo $row["op_dues"] ?>" alt="School fees receipt">
                        </div>
                    <?php endwhile;
                } else { ?>
                    <p>No student is cleared yet</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <p id="date" style="display: none;"></p>

    <script>
        // View Cleared Students
        document.querySelector('.ecl-count').addEventListener('click', () => {
            document.querySelector('.scl-count').style.background = "white";
            document.querySelector('.scl-count').style.color = "#dd1b22";
            document.querySelector('.ecl-count').style.background = "#dd1b22";
            document.querySelector('.ecl-count').style.color = "white";
            document.getElementById('scl').style.display = "none";
            document.getElementById('ecl').style.display = "block";
        });
        
        document.querySelector('.scl-count').addEventListener('click', () => {
            document.querySelector('.ecl-count').style.background = "white";
            document.querySelector('.ecl-count').style.color = "#dd1b22";
            document.querySelector('.scl-count').style.background = "#dd1b22";
            document.querySelector('.scl-count').style.color = "white";
            document.getElementById('scl').style.display = "block";
            document.getElementById('ecl').style.display = "none";
        });
    </script>

<?php

    include "./template/footer.php";

?>