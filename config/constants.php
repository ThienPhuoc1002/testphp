<?php
  session_start();

  define('SITEURL', 'http://localhost/testphp/');
  define('LOCALHOST', 'localhost');
  define('DB_USERNAME', 'root');
  define('PASSWORD', '');
  define('DB_NAME', 'testphp');

  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD) or die(mysqli_error($conn));
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
  
  
?>