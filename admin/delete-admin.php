<?php
  include('../config/constants.php');

  $id = $_GET['id'];
  $sql = "DELETE FROM users WHERE id=$id";
  $res = mysqli_query($conn, $sql);

  if($res==TRUE)
  {
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manager-admin.php');
  }
  else
  {
    $_SESSION['delete'] = "<div class='error'>Admin Added Failed</div>";
    header('location:'.SITEURL.'admin/manager-admin.php');
  }
?>