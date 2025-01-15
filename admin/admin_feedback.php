<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

// Handle deletion of a message
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('Query failed');
    header('location:admin_feedback.php'); // Redirect back to this page
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Admin CSS File Link -->
    <link rel="stylesheet" href="admin_wishlist.css">
    <style>
        .return-btn {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s;
        }
        .return-btn:hover {
            background-color: #0056b3;
        }
        .messages {
            text-align: center;
        }
        .title {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<section class="messages">

    <h1 class="title">Messages</h1>

    <!-- Return to Home Button -->
    <a href="admin_page.php" class="return-btn">Return to Home</a>

    <div class="box-container">
        <?php
        // Fetch messages from the database
        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Query failed');
        if (mysqli_num_rows($select_message) > 0) {
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
        ?>
        <div class="box">
            <p> User ID : <span><?php echo $fetch_message['user_id']; ?></span> </p>
            <p> Name : <span><?php echo $fetch_message['name']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
            <p> Subject : <span><?php echo $fetch_message['subject']; ?></span> </p>
            <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
            <a href="admin_feedback.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete Message</a>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">You have no messages!</p>';
        }
        ?>
    </div>

</section>

</body>
</html>
