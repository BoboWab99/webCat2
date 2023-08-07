<?php

require_once "connect.php";

// get id of logged in user
$user_id = null;

if (!isset($_SESSION['user_id'])) {
   header('Location: login.php');
   exit();

} else {
   $user_id = $_SESSION['user_id'];

   // check data from db
   $query = "SELECT * FROM `user`";
   $query .= "WHERE `id` = '{$user_id}' LIMIT 1;";

   $conn = getConnection();
   $result = mysqli_query($conn, $query);
   $account_type = $username = $email = $phone = $dob = $password = null;

   if ($result) {
      if (mysqli_num_rows($result) > 0) {
         $data = mysqli_fetch_assoc($result);

         $account_type = $data['account_type'];
         $username = $data['username'];
         $email = $data['email'];
         $phone = $data['phone'];
         $dob = $data['dob'];
         $password = $data['password'];
      } else {
         // refresh page
         header("Location: login.php");
         exit();
      }
   } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
   }

   // close connection,
   mysqli_close($conn);
}


// update profile

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // get & validate data
   $accountType = $_POST['account-type'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $tel = $_POST['number'];
   $dob = $_POST['dob'];
   $password = $_POST['password'];

   // save to database
   $query = "INSERT INTO `user` (`account_type`, `username`, `email`, `phone`, `dob`, `password`)";
   $query .= "VALUES ('{$accountType}', '{$username}', '{$email}', '{$tel}', '{$dob}', '{$password}');";

   $conn = getConnection();
   if (mysqli_query(
      $conn,
      $query
   )) {
      // go to login
      header('Location: ../login.php');
      exit();
   } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
   }

   // close connection,
   mysqli_close($conn);
}

?>


<!-- END LOGIC -->


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include_once("header.php"); ?>

   <H1>Profile</H1>

   <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" id="form" method="POST">
      <h4>You can edit and save profile changes!</h4>

      <div class="form-field">
         <label for="accountType">Select account type:</label>
         <select name="account-type" id="accountType">
            <option value="1" <?php if ($account_type == 1) {
                                 echo 'selected';
                              } ?>>Customer</option>
            <option value="2" <?php if ($account_type == 2) {
                                 echo 'selected';
                              } ?>>Agent</option>
         </select>
      </div>
      <div class="form-field">
         <label for="username">Username:</label>
         <input type="text" name="username" id="username" placeholder="Enter Your Username" value="<?php echo $username ?>">
      </div>
      <div class="form-field">
         <label for="email">Email:</label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $email ?>">
      </div>
      <div class="form-field">
         <label for="phoneNumber">Phone number (254...):</label>
         <input type="number" name="number" id="phoneNumber" min="10" placeholder="254xxx" value="<?php echo $phone ?>">
      </div>
      <div class="form-field">
         <label for="dob">Date of birth:</label>
         <input type="date" name="dob" id="dob" placeholder="Enter the date of birth" value="<?php echo $dob ?>">
      </div>
      <div class="form-field">
         <label for="password">Password:</label>
         <input type="password" name="password" id="password" placeholder="Enter the password" value="<?php echo $password ?>">
      </div>
      <button type="submit">Update</button>
   </form>

   <br><br>


</body>

</html>