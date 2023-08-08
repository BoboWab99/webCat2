<?php

session_start();

if (isset($_SESSION['auth_user'])) {
   unset($_SESSION['auth_user']);
   header('Location: login.php');
   exit();
} else {
   $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "javascript:history.back()";
   echo "An error occurred! <a href='$previous_page'>Go back!</a>";
}

?>