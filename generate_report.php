<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $username = $_POST['username'];

    $sql = "SELECT attendance.date, attendance.status 
            FROM attendance 
            JOIN users ON attendance.user_id = users.id 
            WHERE users.username = ? AND attendance.date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $from_date, $to_date);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Attendance Report for $username</h2>";
    echo "<table>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['date']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
              </tr>";
    }
    echo "</table>";

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
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

        .report-container {
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

        form {
            margin-bottom: 20px;
            text-align: left;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
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
            margin-top: 20px;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            background-color: #eaeaea;
        }

        a:hover {
            background-color: #d0d0d0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="report-container">
        <h2>Generate Attendance Report</h2>

        <!-- Report Generation Form -->
        <form method="POST" action="generate_report.php">
            Username: <input type="text" name="username" required><br>
            From Date: <input type="date" name="from_date" required><br>
            To Date: <input type="date" name="to_date" required><br>
            <button type="submit">Generate Report</button>
        </form>

        <!-- Report Table will be displayed here if a report is generated -->

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
