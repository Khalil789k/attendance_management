<?php
include('db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grade_A = $_POST['grade_A'];
    $grade_B = $_POST['grade_B'];
    $grade_C = $_POST['grade_C'];
    $grade_D = $_POST['grade_D'];

    $sql = "UPDATE grading SET grade_A = ?, grade_B = ?, grade_C = ?, grade_D = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $grade_A, $grade_B, $grade_C, $grade_D);

    if ($stmt->execute()) {
        echo "<div class='success'>Grading system updated successfully.</div>";
    } else {
        echo "<div class='error'>Error: " . $stmt->error . "</div>";
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
    <title>Grading System</title>
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

        .grading-container {
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

        input[type="number"] {
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

        .success {
            color: #27ae60;
            margin-bottom: 20px;
        }

        .error {
            color: #e74c3c;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="grading-container">
        <h2>Grading System</h2>

        <!-- Grading System Form -->
        <form method="POST" action="grading_system.php">
            A Grade (Days >=): <input type="number" name="grade_A" required><br>
            B Grade (Days >=): <input type="number" name="grade_B" required><br>
            C Grade (Days >=): <input type="number" name="grade_C" required><br>
            D Grade (Days >=): <input type="number" name="grade_D" required><br>
            <button type="submit">Update Grading System</button>
        </form>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
