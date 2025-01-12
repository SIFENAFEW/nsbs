<?php 
session_start();

// Include database connection
include("db_conn.php");

// Include header
include("header.php");

// Fetch existing books
$result = $conn->query("SELECT * FROM books"); // Assuming the table name is 'books'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books</title>
    <link rel="stylesheet" href="browse.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Available Books</h2>
        <div class="books-list">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book-container">
                    <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
                    <a href="<?php echo htmlspecialchars($book['pdf']); ?>" target="_blank" class="book-pdf">View PDF</a>
                    <div class="book-description"><?php echo htmlspecialchars($book['description']); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
