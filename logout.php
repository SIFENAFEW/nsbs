<?php 
session_start();
session_destroy();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="signup-container">
        <h2>You have been logged out</h2>
        <p>Thank you for using our service. You can <a href="login.php">login again</a> anytime.</p>
    </div>
</body>
</html>
