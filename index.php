<?php
// index.php - The Control Page

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Page</title>
    <link rel="stylesheet" href="style.css">
    <!-- Optional: Include Bootstrap for better UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container text-center my-5">
    <h1 class="mb-4">Welcome to the Attendance Management System</h1>
    
    <div class="control-buttons">
        <a href="login.php" class="btn btn-primary btn-lg mb-3">User Login</a>
        <a href="admin_login.php" class="btn btn-primary btn-lg mb-3">Admin Login</a>
        <a href="register.php" class="btn btn-primary btn-lg mb-3">Register</a>
    </div>
    
</div>

<!-- Optional: Bootstrap JS for Animations -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
