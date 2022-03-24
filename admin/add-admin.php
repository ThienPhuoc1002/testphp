<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <br>

    <?php
      if(isset($_SESSION['add']))
      {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }
    ?>
    <br>
    
    <form action="" method="post">

    <table class="tbl-30">
      <tr>
        <td>Fullname</td>
        <td><input type="text" name="fullname" placeholder="Fullname"></td>
      </tr>
      <tr>
        <td>Username</td>
        <td><input type="text" name="username"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
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
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $sql = "INSERT INTO users SET
      password='$password',
      name='$username'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
      header('location:'.SITEURL.'admin/manager-admin.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Add Admin</div>";
      header('location:'.SITEURL.'admin/add-admin.php');
    }
  }
?>