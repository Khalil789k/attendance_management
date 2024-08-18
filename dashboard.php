<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            width: 400px;
        }

        h2 {
            color: #444;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5a5a5a;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #444;
        }

        a {
            display: block;
            color: #5a5a5a;
            text-decoration: none;
            font-size: 18px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            background-color: #eaeaea;
        }

        a:hover {
            background-color: #d0d0d0;
        }

        a:active {
            background-color: #b0b0b0;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h2>User Dashboard</h2>
        <p>Welcome</p>

        <!-- Buttons for User Actions -->
        <form method="POST" action="mark_attendance.php">
            <button type="submit">Mark Attendance</button>
        </form>

        <form method="POST" action="request_leave.php">
            <button type="submit">Mark Leave</button>
        </form>

        <a href="view_attendance.php">View Attendance</a>
        <a href="edit_profile.php">Edit Profile Picture</a>
        <a href="logout.php">Logout</a>
        <a href="index.php" class="btn btn-outline-light">Back to Control Page</a>
    </div>

</body>
</html>
