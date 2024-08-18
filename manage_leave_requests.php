<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT leave_requests.id, users.username, leave_requests.start_date, leave_requests.end_date, leave_requests.reason, leave_requests.status 
        FROM leave_requests 
        JOIN users ON leave_requests.user_id = users.id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leave Requests</title>
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 30px;
            border-radius: 8px;
            width: 80%;
            max-width: 900px;
            text-align: left;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #e67e22;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
        }

        .leave-request {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .leave-request:last-child {
            border-bottom: none;
        }

        .leave-request p {
            margin: 0 0 10px;
            font-size: 16px;
            color: #555;
        }

        form {
            display: inline-block;
            margin: 0;
        }

        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #bdc3c7;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        select:focus {
            border-color: #e67e22;
            box-shadow: 0 0 5px rgba(230, 126, 34, 0.3);
            outline: none;
        }

        button {
            padding: 8px 12px;
            background-color: #e67e22;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #d35400;
        }

        button:active {
            background-color: #c0392b;
            transform: scale(0.98);
        }

        a {
            display: block;
            margin-top: 20px;
            color: #e67e22;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #d35400;
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
        <h2>Manage Leave Requests</h2>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="leave-request">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                <p><strong>Start Date:</strong> <?php echo htmlspecialchars($row['start_date']); ?></p>
                <p><strong>End Date:</strong> <?php echo htmlspecialchars($row['end_date']); ?></p>
                <p><strong>Reason:</strong> <?php echo htmlspecialchars($row['reason']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>

                <form method="POST" action="update_leave_status.php">
                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <select name="status">
                        <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Approved" <?php echo $row['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                        <option value="Rejected" <?php echo $row['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                    <button type="submit">Update Status</button>
                </form>
            </div>
        <?php endwhile; ?>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
