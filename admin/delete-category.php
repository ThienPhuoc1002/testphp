<?php
  include('../config/constants.php');

  $id = $_GET['id'];
  $sql = "SELECT * FROM tbl_categories WHERE id=$id";
  $res = mysqli_query($conn, $sql);
  $image=mysqli_fetch_assoc($res)['image'];
  if($image != "")
  {
    $path ="../media/".$image;
    $remove = unlink($path);
    if ($remove==false)
    {
      $_SESSION['delete'] = "<div class='error'>Image Category Deleted Fail</div>";
      header('location:'.SITEURL.'admin/manager-category.php');
      die();
    }
  } 
  $sql = "DELETE FROM tbl_categories WHERE id=$id";
  $res = mysqli_query($conn, $sql);
  if($res==TRUE)
  {
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manager-category.php');
  }
  else
  {
    $_SESSION['delete'] = "<div class='error'>Category Deletted Failed</div>";
    header('location:'.SITEURL.'admin/manager-category.php');
  }
?>