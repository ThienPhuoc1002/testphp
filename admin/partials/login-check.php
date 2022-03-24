<?php
  if(!isset($_SESSION['user']))
  {
    $_SESSION['login'] = "<div class='error text-center'>Please login to make admin page</div>";
    header('location:'.SITEURL.'admin/login.php');
  }
?>