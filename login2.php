<?php
// filepath: /C:/Users/Negasi/AppData/Local/GitHubDesktop/app-3.4.9/go install -v github.com/alpkeskin/mosint/v3/cmd/mosint@latest/nsbs/login2.php
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NonsenseBookStore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from database
    $sql = "SELECT * FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            echo "Login successful.";
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Invalid credentials.";
    }

    $stmt->close();
}

$conn->close();
?>