<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Portal</title>
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
            /* width: 100%; */
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
        }

        nav .button i {
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
            padding-top: 20px;
        }

        .breadcrumb .breadcrumb-text {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            margin-left: 30px;
        }

        .breadcrumb img {
            width: 300px;
        }

        .welcome-text h1 {
            font-size: 38px;
            margin-bottom: 6px;
        }

        .student-fees {
            margin-top: 30px;
        }

        .fees {
            display: flex;
            align-items: center;
            justify-content: start;
            flex-wrap: wrap;
            margin-top: 15px;
            gap: 3rem;
        }

        .hidden {
            opacity: 0;
            filter: blur(3px);
            transform: translateX(-100%);
            transition: all 3s;
        }

        .show {
            opacity: 1;
            filter: blur(0);
            transform: translateX(0);
        }

        .sch-fees.hidden:nth-child(2) {
            transition-delay:300ms;
        }

        .sch-fees.hidden:nth-child(3) {
            transition-delay: 600ms;
        }

        .sch-fees.hidden:nth-child(4) {
            transition-delay: 900ms;
        }

        .fees .sch-fees {
            width: 250px;
            height: 250px;
            border-radius: 20px;
            box-shadow: 4px 4px 30px #ccc,
                        -4px -4px 30px #ccc;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: 0.5s;
        }

        /* .fees .sch-fees:hover {
            border: 2px solid #dd1b22;
            transform: scale(1.1);
            cursor: pointer;
        } */

        .fees .sch-fees i {
            font-size: 80px;
            margin-top: 40px;
            color: #dd1b22;
        }

        .courses {
            margin-top: 30px;
        }

        .courses .course-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-container {
            width: 100%;
            padding: 30px;
        }

        .profile-container h1 {
            text-align: center;
        }

        .profile-container .profile {
            width: 100%;
            border: 2px solid #ddd;
            margin-top: 20px;
            border-radius: 20px;
        }

        .profile .profile-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        .profile .profile-info:not(:last-child) {
            border-bottom: 2px solid #ddd;
        }

        .profile .profile-info p:first-child {
            font-weight: bold;
            text-transform: uppercase;
        }

        .profile-container .btn {
            margin-top: 13px;
            width: 100%;
            padding: 10px;
            outline: none;
            border: none;
            border-radius: 50px;
            background: #dd1b22;
            color: white;
            text-transform: uppercase;
            cursor: pointer
        }

        form {
            border-radius: 10px;
            box-shadow: 4px 4px 30px #ccc,
                        -4px -4px 30px #ccc;
            padding: 30px;
            margin: 25px auto;
            width: 90%;
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

        .input-field input, select {
            width: 100%;
            border: none;
            border-bottom: 1px solid black;
            margin: 10px 0;
            font-size: 16px;
            padding: 4px 0;
            outline: none;
        }

        /* .input-field:last-child {
            margin-top: 20px;
        } */

        form button {
            background: #dd1b22;
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

        .clearance-form {
            padding: 30px;
        }

        .clearance-form .form {
            width: 100%;
            margin-top: 30px;
            border: 2px solid #ccc;
            border-radius: 20px;
        }

        .form .form-titles {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form .form-titles h3 {
            width: 100%;
            padding: 20px;
            border-bottom: 2px solid #ccc;
            text-align: center;
            text-transform: uppercase;
            cursor: pointer;
            transition: .5s;
        }
        
        .form-titles h3:hover {
            background: #dd1b22;
            color: #fff;
        }
        
        .form-titles h3.active {
            background: #dd1b22;
            color: #fff;
        }

        .form .form-titles h3:first-child {
            border-right: 1px solid #ccc;
            border-radius: 18px 0 0 0;
        }
        
        .form .form-titles h3:last-child {
            border-left: 1px solid #ccc;
            border-radius: 0 18px 0 0;
        }

        .form .forms {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hidden-form {
            display: none;
        }

        .semester-clearance .form-fields {
            width: 100%;
        }

        .form-fields input {
            width: 100%;
            margin: 7px 0;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            padding: 5px 0;
        }

        .course-reg, .student-courses {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: calc(100vh - 80px);
            width: 500px;
            margin: auto;
            text-align: center;
        }

        .course-reg h1, .student-courses h1 {
            margin-top: 30px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        @media screen and (max-width: 900px) {
            #close {
                display: none;
            }
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
            .breadcrumb {
                justify-content: center;
                padding: 30px;
                text-align: center;
            }
            .breadcrumb h1 {
                font-size: 30px;
            }
            .breadcrumb .breadcrumb-text {
                margin: 0;
            }
            .breadcrumb img {
                display: none;
            }
            .fees {
                justify-content: center;
            }
            
            .form .form-titles h3 {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 400px) {
            .form .form-titles h3 {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <img src="https://img1.wsimg.com/isteam/ip/0d532241-dda1-42d3-9ca9-6c0bd972594a/Logo%20Trans-fde57a7.png/:/rs=w:814,h:160,cg:true,m/cr=w:814,h:160/qt=q:95" alt="Lincoln" />
        <ul class="sections">
            <li><a href="clearance_dashboard.php">Dashboard</a></li>
            <li><a href="clearance_form.php">Clearance</a></li>
            <li><a href="course_reg.php">Course Registration</a></li>
            <li><a href="courses.php">Courses</a></li>
        </ul>
        <div class="button">
            <a href="profile.php" class="fa fa-user" id="profile-icon" title="Profile"></a>
            <i class="fa fa-bars" id="menu"></i>
            <i class="fa fa-close" id="close"></i>
        </div>
    </nav>
