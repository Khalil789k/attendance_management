<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT users.username, attendance.date, attendance.status 
        FROM attendance 
        JOIN users ON attendance.user_id = users.id 
        ORDER BY attendance.date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Attendance Records</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #343a40;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .record {
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .record:nth-child(even) {
            background-color: #f1f3f5;
        }

        .record span {
            font-size: 16px;
            color: #495057;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #343a40;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>All Attendance Records</h2>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="record">
                <span>Username: <?php echo htmlspecialchars($row['username']); ?></span>
                <span>Date: <?php echo htmlspecialchars($row['date']); ?></span>
                <span>Status: <?php echo htmlspecialchars($row['status']); ?></span>
            </div>
        <?php endwhile; ?>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
