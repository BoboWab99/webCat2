<?php

// start session if it isn't started
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE ) {
   session_start();
}

$is_user_logged_in = isset($_SESSION['auth_user']);

?>

<nav>
   <div class="left">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="general.php">General</a>
      <a href="medical.php">Medical</a>
   </div>
   <div class="right">
      <?php
      if ($is_user_logged_in) {
         echo "<b style='color: white'>@". $_SESSION['auth_user']['username'] ."</b>";
         echo "<a href='logout.php'>Logout</a>";
      } else {
         echo "<a href='register.php'>Register</a>";
         echo "<a href='login.php'>Login</a>";
      }
      ?>
   </div>
</nav>