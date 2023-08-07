<?php

require_once "connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // get & validate data
   // $username = test_input($_POST['username']);
   $email = $_POST['email'];
   $password = $_POST['password'];

   // check data from db
   $query = "SELECT `id` FROM `user`";
   $query .= "WHERE `email` = '{$email}' AND `password` = '{$password}' LIMIT 1;";

   $conn = getConnection();
   $result = mysqli_query($conn, $query);

   if ($result) {
      if (mysqli_num_rows($result) > 0) {
         $data = mysqli_fetch_assoc($result);

         // save user id in session
         $_SESSION['user_id'] = $data['id'];

         // go to profile
         header('Location: profile.php');
      } else {
         // refresh page
         header("Refresh:0");
      }
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

   <H1>Login</H1>

   <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" id="form" method="POST">
      <div class="form-field">
         <label for="email">Email: <small><i>(name@example.com)</i></small></label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email" pattern="\S+@\S+\.\S+" required>
      </div>

      <div class="form-field">
         <label for="password">Password: <small><i>(uppercase & numbers only, at least 8 characters)</i></small></label>
         <input type="password" name="password" id="password" placeholder="Enter the password" pattern="[0-9A-Z]{8,}" required>
      </div>

      <button type="submit">Submit</button>
   </form>

   <br><br>


</body>

</html>