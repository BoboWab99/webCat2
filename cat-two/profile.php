<?php

require_once "connect.php";

session_start();


// details of logged in / authorized user
$auth_user = null;

if (!isset($_SESSION['auth_user'])) {
   header('Location: login.php');
   exit();
} else {
   $auth_user = $_SESSION['auth_user'];
}


// update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // get form data
   $new_account_type = $_POST['account-type'];
   $new_username = $_POST['username'];
   $new_email = $_POST['email'];
   $new_tel = $_POST['number'];
   $new_dob = $_POST['dob'];
   $old_password = $_POST['old-password'];   // to be compared against saved password
   $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   if (!password_verify($old_password, $auth_user['password'])) {
      $_SESSION['password_error'] = "Old password does NOT match our records!!!";
      header("Refresh:0");
      exit();
   } else {
      // save to database
      $user_id = $auth_user['id'];        // *** added this line
      $query  = "UPDATE `user`";
      $query .= " SET `account_type`='$new_account_type', `username`='$new_username', `email`='$new_email',";
      $query .= " `phone`='$new_tel', `dob`='$new_dob', `password`='$new_password'";
      $query .= " WHERE id = $user_id";   // *** and this line

      $conn = getConnection();

      if (mysqli_query($conn, $query)) {
         // update $auth_user values
         $_SESSION['auth_user'] = array(
            'id' => $auth_user['id'],  // same id as before
            'account_type' => $new_account_type,
            'username' => $new_username,
            'email' => $new_email,
            'phone' => $new_tel,
            'dob' => $new_dob,
            'password' => $new_password,
         );
         // destroy previous $auth_user data
         unset($auth_user);
         // refresh page
         $_SESSION['success_message'] = "Profile updated successfully!";
         header('Refresh:0');
         exit();
      } else {
         echo "Error: " . $query . "<br>" . mysqli_error($conn);
      }
      // close connection,
      mysqli_close($conn);
   }
}


// --- END LOGIC ---
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>GoldOak | My Profile</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include_once("header.php"); ?>

   <h1>Profile</h1>

   <form id="form" method="POST">
      <h4>You can edit and save profile changes!</h4>

      <?php
      if (isset($_SESSION['password_error'])) {
         echo "<p style='color: #dc3545'>" . $_SESSION['password_error'] . "</p>";
         unset($_SESSION['password_error']);
      }
      if (isset($_SESSION['success_message'])) {
         echo "<p style='color: #12b212'>" . $_SESSION['success_message'] . "</p>";
         unset($_SESSION['success_message']);
      }
      ?>

      <div class="form-field">
         <label for="accountType">Select account type:</label>
         <select name="account-type" id="accountType">
            <option value="1" <?php if ($auth_user['account_type'] == 1) echo "selected" ?>>Customer</option>
            <option value="2" <?php if ($auth_user['account_type'] == 2) echo "selected" ?>>Agent</option>
         </select>
      </div>

      <div class="form-field">
         <label for="username">Username:</label>
         <input type="text" name="username" id="username" placeholder="Enter Your Username" value="<?php echo $auth_user['username'] ?>">
      </div>

      <div class="form-field">
         <label for="email">Email:</label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $auth_user['email'] ?>">
         <label class="form-hint" for="email">Eg: name@example.com</label>
      </div>

      <div class="form-field">
         <label for="phoneNumber">Phone number (254...):</label>
         <input type="number" name="number" id="phoneNumber" min="10" placeholder="254xxx" value="<?php echo $auth_user['phone'] ?>">
         <label class="form-hint" for="phoneNumber">Eg: 254712345678</label>
      </div>

      <div class="form-field">
         <label for="dob">Date of birth:</label>
         <input type="date" name="dob" id="dob" placeholder="Enter the date of birth" value="<?php echo $auth_user['dob'] ?>">
      </div>

      <div class="form-field">
         <label for="password">Old Password:</label>
         <input type="password" name="old-password" id="OldPassword" placeholder="Enter the old password">
      </div>

      <div class="form-field">
         <label for="password">New Password:</label>
         <input type="password" name="password" id="password" placeholder="Enter the new password">
         <label class="form-hint" for="password">Uppercase & numbers only, at least 8 characters</label>
      </div>

      <button type="submit">Update</button>
   </form>

   <br><br>

   <script src="register.js"></script>

</body>

</html>