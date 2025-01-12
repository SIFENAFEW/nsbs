<?php include("db_conn.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Book</title>
    <link rel="stylesheet" href="request.css">
</head>
<body>

<header>
    <h1>Request a Book</h1>
    <h2>Fill out the form below to request your favorite book!</h2>
</header>

<div class="request-container">
    <form action="request.php" method="POST">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required>

        <label for="request_details">Request Details:</label>
        <textarea id="request_details" name="request_details" required></textarea>

        <button type="submit">Submit Request</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $request_details = $_POST['request_details'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO requests (user_id, request_details, created_at) VALUES ('$user_id', '$request_details', '$created_at')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<p>Request submitted successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

</body>
</html>
