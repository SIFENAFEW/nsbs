<?php 
include 'db_conn.php';

session_start(); 

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){ 
    header('location:login.php'); 
} 

if(isset($_POST['send'])){ 

    $title = mysqli_real_escape_string($conn, $_POST['title']); 
    $author = mysqli_real_escape_string($conn, $_POST['author']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $comment = mysqli_real_escape_string($conn, $_POST['comment']); 
    $genre = mysqli_real_escape_string($conn, $_POST['genre']); 

    $select_book = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE title = '$title' AND author = '$author' AND email = '$email'") or die('query failed'); 

    if(mysqli_num_rows($select_book) > 0){ 
        $message[] = 'This book is already in your wishlist!'; 
    }else{ 
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, title, author, email, comment, genre) VALUES('$user_id', '$title', '$author', '$email', '$comment', '$genre')") or die('query failed'); 
        $message[] = 'Book added to your wishlist successfully!'; 
    } 

} 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Wishlist</title> 

    <!-- font awesome cdn link --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 

    <!-- custom css file link --> 
    <link rel="stylesheet" href="wishlist.css"> 

</head> 
<body> 

<?php include 'header.php'; ?> 

<div class="heading"> 
    <h3>My Wishlist</h3> 
    <p> <a href="home.php">home</a> / wishlist </p> 
</div> 

<section class="wishlist"> 

    <form action="" method="post"> 
        <h3>Add a Book to Wishlist</h3> 
        <input type="text" name="title" required placeholder="What’s the magical book you have in mind?" class="box"> 
        <input type="text" name="author" required placeholder="Who’s the brilliant author?" class="box"> 
        <input type="email" name="email" required placeholder="Where can we send updates about your wish?" class="box"> 
        <textarea name="comment" class="box" placeholder="Tell us why this book should be added (optional)" cols="30" rows="10"></textarea> 

        <!-- Genre picker -->
        <select name="genre" class="box" required>
            <option value="" disabled selected>Pick a genre or mood</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Romance">Romance</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Mystery">Mystery</option>
            <option value="Thriller">Thriller</option>
            <option value="Non-fiction">Non-fiction</option>
            <option value="Uplifting">Uplifting</option>
            <option value="Cozy">Cozy</option>
        </select> 

        <!-- Fun Submit Button -->
        <input type="submit" value="Grant My Wish!" name="send" class="btn"> 
    </form> 

</section>

<?php include 'footer.php'; ?> 

<!-- custom js file link --> 
<script src="js/script.js"></script> 

</body> 
</html>
