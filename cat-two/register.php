<?php

require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // get form data
   $account_type = $_POST['account-type'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $tel = $_POST['number'];
   $dob = $_POST['dob'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   // save to database
   $query = "INSERT INTO `user` (`account_type`, `username`, `email`, `phone`, `dob`, `password`)";
   $query .= " VALUES ('$account_type', '$username', '$email', '$tel', '$dob', '$password');";

   $conn = getConnection();

   if (mysqli_query($conn, $query)) {
      header('Location: login.php');
      exit();
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
   <title>Sower | Register</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include_once("header.php"); ?>

   <h1><!-- Input your details to --> Register a new account as a <br> <u>CUSTOMER</u> or an <u>AGENT</u></h1>

   <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" id="form" method="POST">
      <div class="form-field">
         <label for="accountType">Select account type: <small><i>(required)</i></small></label>
         <select name="account-type" id="accountType" autofocus>
            <option hidden selected>------</option>
            <option value="1">Customer</option>
            <option value="2">Agent</option>
         </select>
      </div>

      <div class="form-field">
         <label for="username">Username: <small><i>(required)</i></small></label>
         <input type="text" name="username" id="username" placeholder="Enter Your Username">
      </div>

      <div class="form-field">
         <label for="email">Email: <small><i>(required)</i></small></label>
         <input type="email" name="email" id="email" placeholder="Enter Your Email">
         <label class="form-hint" for="email">Eg: name@example.com</label>
      </div>

      <div class="form-field">
         <label for="phoneNumber">Phone number: <small><i>(required)</i></small></label>
         <input type="number" name="number" id="phoneNumber" min="10" placeholder="254xxx">
         <label class="form-hint" for="phoneNumber">Eg: 254712345678</label>
      </div>

      <div class="form-field">
         <label for="dob">Date of birth: <small><i>(required)</i></small></label>
         <input type="date" name="dob" id="dob" placeholder="Enter the date of birth">
      </div>

      <div class="form-field">
         <label for="password">Password: <small><i>(required)</i></small></label>
         <input type="password" name="password" id="password" placeholder="Enter the password">
         <label class="form-hint" for="password">Uppercase & numbers only, at least 8 characters</label>
      </div>

      <button type="submit">Submit</button>
      <button type="reset">Reset</button>
   </form>

   <br><br>

   <script src="register.js"></script>

</body>

</html>