<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <br>

    <?php
      if(isset($_SESSION['add']))
      {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }
    ?>
    <br>
    
    <form action="" method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Name</td>
          <td><input type="text" name="name"></td>
        </tr>
        <tr>
          <td>Image</td>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
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
    $name = $_POST['name'];
    if(isset($_FILES['image']['name']))
    {
      $image_name = basename($_FILES['image']['name']);
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../media/".$image_name;
      // $ext = end(explode('.', $image_name));
      // $image_name = "category_".rand(000, 999).'.'.$ext;
      $upload = move_uploaded_file($source_path, $destination_path);
      if($upload==false)
      {
        $_SESSION['add'] = "<div class='error'>Failed Add Image</div>";
        header('location:'.SITEURL.'admin/add-category.php');
      }
    }
    else
    {
      $image_name="";
    }
    $sql = "INSERT INTO tbl_categories SET 
    name='$name',
    image='$image_name'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
      header('location:'.SITEURL.'admin/manager-category.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Add Category</div>";
      header('location:'.SITEURL.'admin/add-category.php');
    }
  }
?>