<?php 
session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: admin_login.php"); // Redirect to login page if not logged in or not an admin
//     exit();
// }
include("../dbs/db_conn.php");
// ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="admin-container">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="manage_books.php">Manage Book Listings</a></li>
            <li><a href="manage_users.php">Manage User Accounts</a></li>
            <li><a href="data_recovery.php">Data Recovery</a></li>
            <li><a href="handle_feedback.php">Handle Feedback</a></li>
        </ul>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
