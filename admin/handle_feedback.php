<?php 
session_start();

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: admin_login.php"); // Redirect to login page if not logged in or not an admin
//     exit();
// }

// Include database connection
include("../dbs/db_conn.php");

// Handle feedback management logic here (view, respond)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handle Feedback</title>
    <link rel="stylesheet" href="../signup.css">
</head>
<body>
    <div class="handle-feedback-container">
        <h2>Handle User Feedback</h2>
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
        <!-- Add feedback management functionality here -->
    </div>
</body>
</html>
