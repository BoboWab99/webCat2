<?php

require_once "connect.php";


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
   if (mysqli_query($conn, $query)) {
      // go to login
      header('Location: login.php');
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
   <title>Register</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include_once("header.php"); ?>

   <H1>Input your details to register as a CUSTOMER or an AGENT</H1>
   <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" id="form" method="POST">
      <div class="form-field">
         <label for="accountType">Select account type:</label>
         <select name="account-type" id="accountType">
            <option value="1">Customer</option>
            <option value="2">Agent</option>
         </select>
      </div>

      <div class="form-field">
         <label for="username">Username:</label>
         <input type="text" name="username" id="username" placeholder="Enter Your Username">
      </div>

      <div class="form-field">
         <label for="email">Email:</label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email">
      </div>

      <div class="form-field">
         <label for="phoneNumber">Phone number (254...):</label>
         <input type="number" name="number" id="phoneNumber" min="10" placeholder="254xxx">
      </div>

      <div class="form-field">
         <label for="dob">Date of birth:</label>
         <input type="date" name="dob" id="dob" placeholder="Enter the date of birth">
      </div>

      <div class="form-field">
         <label for="password">Password:</label>
         <input type="password" name="password" id="password" placeholder="Enter the password">
      </div>

      <button type="submit">Submit</button>
      <button type="reset">Reset</button>
   </form>

   <br><br>

   <script src="register.js"></script>

</body>

</html>