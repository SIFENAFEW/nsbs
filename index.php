<?php
include 'db_conn.php'; // Include database connection

// Fetch books from the database
$query = "SELECT * FROM books"; // Assuming 'books' is the table name
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to CSS file -->
    <title>Book Store</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="admin/admin_dashboard.php">Admin</a></li>
        </ul>
    </nav>

    <!-- Books Display Section -->
    <div class="books-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="book">
                
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Book Store. All rights reserved.</p>
        <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
    </footer>
</body>
</html>