<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <br>

    <?php
      $id=$_GET['id'];
      $sql="SELECT * FROM users WHERE id='$id'";
      $res=mysqli_query($conn, $sql);
      if($res==TRUE)
      {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
          echo "Admin Vailable";
          $row=mysqli_fetch_assoc($res);
          $name = $row['name'];
        }
        else
        {
          header('location:'.SITEURL.'admin/manager-admin.php');
        }
      }
    ?>
    <br>
    
    <form action="" method="post">

    <table class="tbl-30">
      <tr>
        <td>Fullname</td>
        <td><input type="text" name="name" value="<?php echo $name; ?>" placeholder="Fullname"></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="btn-secondary">
          <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
        </td>
      </tr>
    </table>
    </form>

  </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit']))
  {
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    $sql = "UPDATE users SET
      name='$name'
      WHERE id='$id'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Admin Updated Successfully</div>";
      header('location:'.SITEURL.'admin/manager-admin.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Update Admin</div>";
      header('location:'.SITEURL.'admin/manager-admin.php');
    }
  }
?>