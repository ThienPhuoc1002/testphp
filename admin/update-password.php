<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Change Password</h1>
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
        <td>Current Password</td>
        <td><input type="password" name="current_password" placeholder="Current password"></td>
      </tr>
      <tr>
        <td>New Password</td>
        <td><input type="password" name="new_password" placeholder="New password"></td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
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
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    
    $sql = "SELECT * FROM users WHERE id='$id' AND password='$current_password'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if($res==TRUE)
    {
      $count = mysqli_num_rows($res);
        if($count==1)
        {
          if($new_password==$confirm_password)
          {
            $sql = "UPDATE users SET password='$newpassword' WHERE id='$id'";
            $res = mysqli_query($conn, $sql) or die(mysqli_error());
            if($res==TRUE)
            {
              $_SESSION['add'] = "<div class='success'>Change Password Success</div>";
              header('location:'.SITEURL.'admin/manager-admin.php');
            }
            else
            {
              $_SESSION['add'] = "<div class='error'>Change Password Fail</div>";
              header('location:'.SITEURL.'admin/manager-admin.php');
            }
          }
          else
          {
            $_SESSION['add'] = "<div class='error'>Password not patch</div>";
            header('location:'.SITEURL.'admin/manager-admin.php');
          }
        }
        else
        {
          $_SESSION['add'] = "<div class='error'>User Not Found</div>";
          header('location:'.SITEURL.'admin/manager-admin.php');
        }
    }
  }
?>