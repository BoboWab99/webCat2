<?php

// constants
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "cat_db");

/**
 * Used to create a connection to the database
 */
function getConnection() {
   // create connection
   $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

   // check connection
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      echo "Database connection failed!";
      return null;
   }

   return $conn;
}
