<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the fields are set and not empty
    if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['reason'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];

        $sql = "INSERT INTO leave_requests (user_id, start_date, end_date, reason) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $start_date, $end_date, $reason);

        if ($stmt->execute()) {
            echo "<div class='message success'>Leave request sent successfully.</div>";
        } else {
            echo "<div class='message error'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='message error'>Please fill in all fields.</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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
            padding: 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        input[type="date"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .message a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #218838;
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
        <h2>Request Leave</h2>
        <form method="POST" action="request_leave.php">
            Start Date: <input type="date" name="start_date" required><br>
            End Date: <input type="date" name="end_date" required><br>
            Reason: <textarea name="reason" required></textarea><br>
            <button type="submit">Request Leave</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
