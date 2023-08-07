
<?php

session_start();

$is_user_logged_in = false;

if (isset($_SESSION['user_id'])) {
   $is_user_logged_in = true;
}

?>

<nav>
   <div class="left">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="general.php">General</a>
      <a href="medical.php">Medical</a>
   </div>
   <div class="right">
      <a href="register.php">Register</a>
      <?php if ($is_user_logged_in) {
         echo "<a href='logout.php'>Logout</a>";
      } else {
         echo "<a href='login.php'>Login</a>";
      }
      ?>
   </div>
</nav>

<br> <br> <br>