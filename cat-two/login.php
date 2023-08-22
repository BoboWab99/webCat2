<?php

require_once "connect.php";

session_start();

$is_user_logged_in = isset($_SESSION['auth_user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // get form data
   $email = $_POST['email'];
   $password = $_POST['password'];

   // check data from db
   $query = "SELECT * FROM `user`";
   $query .= "WHERE `email` = '$email' LIMIT 1;";

   $conn = getConnection();
   $result = mysqli_query($conn, $query);

   if ($result) {
      if (mysqli_num_rows($result) > 0) {
         $data = mysqli_fetch_assoc($result);
         $hashed_password = $data['password'];

         if (password_verify($password, $hashed_password)) {
            // save user info in session
            $_SESSION['auth_user'] = array(
               'id' => $data['id'],
               'account_type' => $data['account_type'],
               'username' => $data['username'],
               'email' => $data['email'],
               'phone' => $data['phone'],
               'dob' => $data['dob'],
               'password' => $data['password'],
            );
            // go to home page
            header('Location: index.php');
            exit();
         } else {
            // refresh page
            $_SESSION['login_error'] = "Incorrect password!!!";
            header("Refresh:0");
            exit();
         }
      } else {
         // refresh page
         $_SESSION['login_error'] = "Email does not match our records!!!";
         header("Refresh:0");
         exit();
      }
   } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
   }

   // close connection,
   mysqli_close($conn);
}


// --- END LOGIC ---
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>GoldOak | Login</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include_once("header.php"); ?>

   <h1>Login</h1>

   <form id="form" method="POST">
      <?php
      if (isset($_SESSION['login_error'])) {
         echo "<p style='color: #dc3545'>" . $_SESSION['login_error'] . "</p>";
         unset($_SESSION['login_error']);
      }
      if ($is_user_logged_in) {
         echo "<p style='color: #12b212'><b>You're already logged in!!!</b></p>";
      }
      ?>

      <div class="form-field">
         <label for="email">Email: <small><i>(required)</i></small></label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email" pattern="\S+@\S+\.\S+" required autofocus>
         <label class="form-hint" for="email">Eg: name@example.com</label>
      </div>

      <div class="form-field">
         <label for="password">Password: <small><i>(required)</i></small></label>
         <input type="password" name="password" id="password" placeholder="Enter the password" pattern="[0-9A-Z]{8,}" required>
         <label class="form-hint" for="password">Uppercase & numbers only, at least 8 characters</label>
      </div>

      <button type="submit" <?php if ($is_user_logged_in) echo 'disabled' ?>>Submit</button>
   </form>

   <br><br>


</body>

</html>