<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sower | Contact us</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
   <link rel="stylesheet" href="style.css">
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</head>

<body>
   <?php include_once("header.php"); ?>

   <h1>Please fill in details to request for cover.</h1>

   <form action="">
      <div class="form-field">
         <label for="cover">Select insurance cover:</label>
         <select name="insurance-cover" id="cover">
            <option hidden>-------</option>
            <option value="1">General</option>
            <option value="2">Medical</option>
         </select>
      </div>

      <div class="form-field">
         <label for="name">Name:</label>
         <input type="text" name="username" placeholder="Enter Your Name" required>
      </div>

      <div class="form-field">
         <label for="email">Email:</label>
         <input type="email" name="email" placeholder="Enter Your Email" required>
      </div>

      <div class="form-field">
         <label for="number">Number:</label>
         <input type="number" name="number" placeholder="Enter Your Number" required>
      </div>

      <div class="form-field">
         <label for="date">Date:</label>
         <input type="date" name="date" placeholder="Enter the date" required>
      </div>

      <div class="form-field">
         <label for="">What's Your Inquiry?</label>
         <textarea name="Inquiry" id="" cols="30" rows="10"></textarea>
      </div>

      <button type="submit">Submit</button>
      <button type="reset">Reset</button>
   </form>
   <br> <br>
   </div>








</body>

</html>