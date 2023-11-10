<?php

    include "./config/db_connect.php";

    $department1 = $t_amount1 = $m_amount1 = $o_amount1 = $input_error = "";

    if (isset($_POST["add_fees"])) {
        $department1 = $_POST["department"];
        $t_amount1 = $_POST["t_amount"];
        $m_amount1 = $_POST["m_amount"];
        $o_amount1 = $_POST["o_amount"];

        if ($department1 == "" || $t_amount1 == "" || $m_amount1 == "" || $o_amount1 == "") {
            $input_error = "Input fields cannot be empty";
        } else {
            $input_error = "";
        }

        if (empty($input_error)) {
            $sql = "INSERT INTO fees (department, tuition, miscellaneous, operational_dues) VALUES ('$department1', '$t_amount1', '$m_amount1', '$o_amount1')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: fees.php");
                exit();
            } else {
                $input_error = "Error adding fees";
            }
        }
    }

    $sqli = "SELECT * FROM fees ORDER BY department ASC";
    $query = mysqli_query($conn, $sqli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees</title>
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

        .fees {
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
            padding: 30px;
            height: 200px;
        }

        .breadcrumb .breadcrumb-text {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            margin-left: 30px;
        }

        .fees .add-view-fees {
            display: flex;
            justify-content: flex-start;
            gap: 2rem;
            margin-top: 30px;
        }

        .add-view-fees form {
            flex-basis: 40%;
            padding: 20px;
            padding-top: 0;
        }

        .add-view-fees form .input-box {
            width: 100%;
        }

        form .input-box input, form .input-box select {
            width: 100%;
            margin-bottom: 10px;
            margin-top: 5px;
            padding: 5px 0;
            outline: none;
        }

        form button {
            width: 100%;
            background: #dd1b22;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-transform: uppercase;
            padding: 10px;
            cursor: pointer;
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

        .view-fees {
            width: 100%;
            overflow-x: scroll;
            overflow-y: hidden;
        }
        
        .view-fees::-webkit-scrollbar {
            height: 8px;
        }

        .view-fees::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 50px;
        }

        .view-clearances button {
            width: 100%;
            color: #fff;
            text-transform: uppercase;
            padding: 10px;
            background: #dd1b22;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
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
            .fees .add-view-fees {
                justify-content: center;
                flex-wrap: wrap;
            }
            .fees .add-view-fees form {
                flex-basis: 100%;
            }
            .fees .add-view-fees .view-fees {
                flex-basis: 100%;
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

    <div class="fees">
        <div class="breadcrumb">
            <div class="welcome-text">
                <h1>Fees</h1>
                <p>Add correct fees for different departments and check cleared students</p>
            </div>
        </div>

        <div class="add-view-fees">
            <form action="" method="post">
                <h2 style="margin-bottom: 10px;">Add Fees</h2>
                <p style="color: #dd1b22;"><?php $input_error ?></p>
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
                <div class="input-box">
                    <label for="t_amount">Tuition Amount</label>
                    <input type="text" name="t_amount" id="t_amount" value="<?php ?>">
                </div>
                <div class="input-box">
                    <label for="m_amount">Miscellaneous Amount</label>
                    <input type="text" name="m_amount" id="m_amount" value="<?php ?>">
                </div>
                <div class="input-box">
                    <label for="o_amount">Operational Dues</label>
                    <input type="text" name="o_amount" id="o_amount" value="<?php ?>">
                </div>
                <button name="add_fees">Add Fees</button>
            </form>
            <div class="view-fees">
                <table>
                    <thead>
                        <th>Department</th>
                        <th>Tuition Fee (Naira)</th>
                        <th>Miscellaneous (Naira)</th>
                        <th>Operational Dues (Naira)</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($query) > 0) { 
                            while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?php echo $row["department"] ?></td>
                                    <td><?php echo $row["tuition"] ?></td>
                                    <td><?php echo $row["miscellaneous"] ?></td>
                                    <td><?php echo $row["operational_dues"] ?></td>
                                    <td><a style="color: #000; text-decoration: none;" title="Delete" href="delete_fee.php?id=<?php echo $row["department"] ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endwhile;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="cleared_students.php" class="view-clearances"><button>View Cleared Students</button></a>
    </div>

    <p id="date" style="display: none;"></p>

<?php

    include "./template/footer.php";

?>