<?php 
session_start();

// Include database connection
include("db_conn.php");

// Fetch existing books
$result = $conn->query("SELECT * FROM books"); // Assuming the table name is 'books'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Uploaded Books</h2>
        <ul>
            <?php while ($book = $result->fetch_assoc()): ?>
                <li>
                    <strong><?php echo htmlspecialchars($book['title']); ?></strong>
                    <p><?php echo htmlspecialchars($book['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($book['pdf']); ?>" target="_blank">View PDF</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
