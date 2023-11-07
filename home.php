<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Clearance Portal</title>
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url("./student/assets/img/lincoln.webp");
        }
        .welcome-page {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(9px);
            padding: 30px;
            border-radius: 20px;
            color: #fff;
        }
        .buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            margin-top: 20px;
        }

        .buttons a {
            text-decoration: none;
            color: #fff;
            background: #dd1b22;
            padding: 7px 13px;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="welcome-page">
        <h1>Welcome</h1>
        <p>Login to your dashboard</p>
        <div class="buttons">
            <a href="./admin/login.php">Admin Login</a>
            <a href="./student/login.php">Student Login</a>
        </div>
    </div>
</body>
</html>