<?php

include '../dbs/db_conn.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_wishlist.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="wishlist">

   <h1 class="title">Book Wishlist</h1>

   <div class="filter-container">
      <form action="" method="GET" class="filter-form">
         <label for="sort">Sort By:</label>
         <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">Select</option>
            <option value="title" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'title') echo 'selected'; ?>>Title</option>
            <option value="author" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'author') echo 'selected'; ?>>Author</option>
            <option value="user_id" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'user_id') echo 'selected'; ?>>User ID</option>
         </select>
      </form>
   </div>

   <div class="box-container">
   <?php
      $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
      $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` ORDER BY $sort") or die('query failed');
      
      if(mysqli_num_rows($select_wishlist) > 0){
         while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
   ?>
   <div class="box">
      <p><strong>User ID:</strong> <span><?php echo $fetch_wishlist['user_id']; ?></span></p>
      <p><strong>Book Title:</strong> <span><?php echo $fetch_wishlist['title']; ?></span></p>
      <p><strong>Author:</strong> <span><?php echo $fetch_wishlist['author']; ?></span></p>
      <p><strong>Email:</strong> <span><?php echo $fetch_wishlist['email']; ?></span></p>
      <p><strong>Genre:</strong> <span><?php echo $fetch_wishlist['genre']; ?></span></p>
      <p><strong>Comment:</strong> <span><?php echo $fetch_wishlist['comment']; ?></span></p>
      <a href="admin_wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" onclick="return confirm('Delete this book from wishlist?');" class="delete-btn">Delete Book</a>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No books in the wishlist!</p>';
      }
   ?>
   </div>

</section>

<!-- custom admin js file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
