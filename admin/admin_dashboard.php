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
            <li><a href="teachers.php">Teachers</a></li>
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
    </div>

    <script>
        // get date
        const date = document.getElementById("date");

        const currentDate = new Date();

        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        };
        date.innerText = new Intl.DateTimeFormat('en-US', options).format(currentDate);

        // menu
        const menuIcon = document.getElementById("menu");
        const closeIcon = document.getElementById("close");
        const nav = document.querySelector(".sections");

        menuIcon.addEventListener("click", () => {
            nav.style.top = "74px";
            menuIcon.style.display = "none";
            closeIcon.style.display = "block";
        });

        closeIcon.addEventListener("click", () => {
            nav.style.top = "-100%";
            closeIcon.style.display = "none";
            menuIcon.style.display = "block";
        });
    </script>
</body>
</html>