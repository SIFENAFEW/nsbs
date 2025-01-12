<?php 
session_start();


// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: admin_login.php"); // Redirect to login page if not logged in or not an admin
//     exit();
// }

include("../dbs/db_conn.php");

if (isset($_GET['user_id'])) {
    $delete_id = $_GET['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
    } else {
        echo "<script>alert('Error deleting user: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}


header("Location: manage_users.php");
exit();
?>