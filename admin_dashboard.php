<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            width: 400px;
        }

        h2 {
            color: #4a4a4a;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
        }

        a {
            display: block;
            color: #555;
            text-decoration: none;
            font-size: 20px;
            margin: 15px 0;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            background-color: #e0e0e0;
        }

        a:hover {
            background-color: #c0c0c0;
            color: #333;
        }

        a:active {
            background-color: #a0a0a0;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <a href="view_all_records.php">View All Records</a>
        <a href="manage_leave_requests.php">Manage Leave Requests</a>
        <a href="generate_report.php">Generate Reports</a>
        <a href="grading_system.php">Grading System</a>
        <a href="logout.php">Logout</a>
        <a href="index.php" class="btn btn-outline-light">Back to Control Page</a>
    </div>

</body>
</html>
