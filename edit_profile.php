<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $target_file, $user_id);
        
        if ($stmt->execute()) {
            echo "<div class='success'>Profile picture updated successfully.</div>";
        } else {
            echo "<div class='error'>Error: " . $stmt->error . "</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='error'>Sorry, there was an error uploading your file.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Picture</title>
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

        .upload-container {
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

        input[type="file"] {
            display: block;
            margin: 20px auto;
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
            margin: 15px 0 0 0;
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

    <div class="upload-container">
        <h2>Edit Profile Picture</h2>

        <!-- Profile Picture Upload Form -->
        <form method="POST" action="edit_profile.php" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="profile_picture" required><br>
            <button type="submit">Upload</button>
        </form>

        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
