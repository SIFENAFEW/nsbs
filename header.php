<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="header-1">
        <div class="flex">
            <a href="home.php" class="logo">NONSENSE BOOK-STORE</a>
            <p>
                <a href="login.php">Login</a> | <a href="register.php">Register</a>
            </p>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <nav class="navbar">
                <div class="nav-links">
                    <a href="home.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="shop.php">Shop</a>
                    <a href="contact.php">Contact</a>
                    <a href="orders.php">Orders</a>
                    <a href="wishlist.php">Wishlist</a>
                    <a href="feedback.php">Feedback</a>
                    <a href="book_listing.php">Book Listing</a>
                </div>
                <a href="logout.php" class="logout">Logout</a>
            </nav>
            <div class="hamburger" onclick="toggleMenu()" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMenu() {
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('active');
    }
</script>

</body>
</html>