<?php 
session_start();

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: login.php"); // Redirect to login page if not logged in or not an admin
//     exit();
// }

// Include database connection
include("db_conn.php");

// Handle adding a new book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Handle file upload
    if (isset($_FILES['book_file']) && $_FILES['book_file']['error'] == 0) {
        $file_tmp = $_FILES['book_file']['tmp_name'];
        $file_name = $_FILES['book_file']['name'];
        $file_path = "uploads/" . basename($file_name); // Define the path to save the file

        // Check if the uploads directory exists, if not create it
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Handle image upload
            if (isset($_FILES['book_image']) && $_FILES['book_image']['error'] == 0) {
                $image_tmp = $_FILES['book_image']['tmp_name'];
                $image_name = $_FILES['book_image']['name'];
                $image_path = "uploads/images/" . basename($image_name); // Define the path to save the image

                // Check if the images directory exists, if not create it
                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0755, true);
                }

                // Move the uploaded image to the designated directory
                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Insert book details into the books table
                    $stmt = $conn->prepare("INSERT INTO books (title, pdf, description, book_image) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $title, $file_path, $description, $image_path);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "<script>alert('Failed to upload image.');</script>";
                }
            }
        } else {
            echo "<script>alert('Failed to upload file.');</script>";
        }
    } else {
        echo "<script>alert('No file uploaded or there was an error: " . $_FILES['book_file']['error'] . "');</script>";
    }
}

// Handle deleting a book
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch existing books
$result = $conn->query("SELECT * FROM books"); // Assuming the table name is 'books'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="manage-books-container">
        <h2>Manage Book Listings</h2>
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>

        <h3>Add New Book</h3>
        <form action="manage_books.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Book Title" required>
            <textarea name="description" placeholder="Book Description" required></textarea>
            <input type="file" name="book_file" accept=".pdf" required>
            <input type="file" name="book_image" accept="image/*" required>
            <input type="submit" name="add_book" value="Add Book">
        </form>

        <h3>Existing Books</h3>
        <ul>
            <?php while ($book = $result->fetch_assoc()): ?>
                <li>
                    <strong><?php echo htmlspecialchars($book['title']); ?></strong>
                    <p><?php echo htmlspecialchars($book['description']); ?></p>
                    <img src="<?php echo htmlspecialchars($book['book_image']); ?>" alt="Book Image" style="width:100px;height:auto;">
                    <a href="<?php echo htmlspecialchars($book['pdf']); ?>" target="_blank">View PDF</a>
                    <a href="manage_books.php?delete_id=<?php echo $book['book_id']; ?>" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
