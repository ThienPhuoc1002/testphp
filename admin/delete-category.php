<?php
  include('../config/constants.php');

  $id = $_GET['id'];
  $sql = "DELETE FROM tbl_categories WHERE id=$id";
  $res = mysqli_query($conn, $sql);

  if($res==TRUE)
  {
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manager-category.php');
  }
  else
  {
    $_SESSION['delete'] = "<div class='error'>Category Added Failed</div>";
    header('location:'.SITEURL.'admin/manager-category.php');
  }
?>