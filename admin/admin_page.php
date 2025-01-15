<?php

session_start();

// Check if admin session variables are set
if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_email']) || !isset($_SESSION['admin_id'])) {
    // Redirect to login page if not set
    header('Location: login.php');
    exit();
}

// Admin page content here...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .admin-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
        }
        ul li a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        ul li a:hover {
            text-decoration: underline;
        }
        .logout {
            display: block;
            margin: 20px auto;
            text-align: center;
            color: #fff;
            background: #dc3545;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            width: 150px;
        }
        .logout:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="admin-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h2> 
        <p style="text-align: center; color: #666;">What would you like to do today?</p>
        <ul>
            <li><a href="manage_books.php">Manage Book Listings</a></li>
            <li><a href="manage_users.php">Manage User Accounts</a></li>
            <li><a href="data_recovery.php">Data Recovery</a></li>
            <li><a href="admin_feedback.php">Admin Feedback</a></li>
            <li><a href="admin_wishlist.php">Admin Wishlist</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
