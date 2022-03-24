<?php include('../config/constants.php'); ?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
  </head>

  <body>
    <div class="login">
      <h1 class="text-center">Login</h1>
      <br><br>

      <?php
        if(isset($_SESSION['login']))
        {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
        }
      ?>

      <br><br>

      <form action="" method="post" class="text-center">
        Name: <br>
        <input type="text" name="name"><br>
        Password: <br>
        <input type="password" name="password"><br>

        <input class="btn-primary" value="Login" type="submit" name="submit">
      </form>

      <p class="text-center">Created By - <a href="">Phuoc</a></p>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE name='$name' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    if($count==1)
    {
      $_SESSION['login'] = "<div class='text-center success'>Login success</div>";
      $_SESSION['user'] = $name;
      header('location:'.SITEURL.'admin/');
    }
    else
    {
      $_SESSION['login'] = "<div class='text-center error'>Login fail</div>";
      header('location:'.SITEURL.'admin/login.php');
    }
  }
?>