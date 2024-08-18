<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$date = date('Y-m-d');

// Check if attendance is already marked
$sql = "SELECT * FROM attendance WHERE user_id = ? AND date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Mark attendance
    $sql = "INSERT INTO attendance (user_id, date, status) VALUES (?, ?, 'Present')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $date);
    
    if ($stmt->execute()) {
        $message = "Attendance marked successfully.";
        $message_class = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $message_class = "error";
    }
} else {
    $message = "You have already marked your attendance for today.";
    $message_class = "info";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            width: 90%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .message {
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .message.info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
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
        <h2>Mark Attendance</h2>
        <div class="message <?php echo $message_class; ?>">
            <?php echo $message; ?>
        </div>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
