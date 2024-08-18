<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    $sql = "UPDATE leave_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $request_id);

    if ($stmt->execute()) {
        echo "<div class='message success'>Leave request status updated successfully.</div>";
    } else {
        echo "<div class='message error'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Leave Status</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
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
            max-width: 600px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #444;
            margin-bottom: 20px;
            font-size: 24px;
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

        a {
            display: inline-block;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #495057;
        }

        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
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
        <h2>Update Leave Request Status</h2>
        <form method="POST" action="update_leave_status.php">
            <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request_id); ?>">
            <select name="status" required>
                <option value="" disabled selected>Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
            <button type="submit">Update Status</button>
        </form>
        <a href="manage_leave_requests.php">Back to Manage Leave Requests</a>
    </div>

</body>
</html>
