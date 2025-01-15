<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user_id 
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT); 

    // Check if user_id is valid and exists
    $sql = "SELECT id FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { 
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Deletion successful
            header("Location: manage_users.php?success=1"); 
            exit();
        } else {
            // Handle deletion error
            echo "Error deleting user.";
        }
    } else {
        // Handle invalid user_id
        echo "Invalid user ID.";
    }
} else {
    // Redirect to manage_users.php if not a POST request
    header("Location: manage_users.php");
    exit();
}

$conn->close();
?>