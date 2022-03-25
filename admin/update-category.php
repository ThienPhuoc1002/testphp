<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>
    <br>

    <?php
      $id=$_GET['id'];
      $sql = "SELECT * FROM tbl_categories WHERE id='$id'";
      $res = mysqli_query($conn, $sql);
      if($res==TRUE)
      {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
          $row=mysqli_fetch_assoc($res);
          $name = $row['name'];
          $old_image = $row['image'];
        }
        else
        {
          header('location:'.SITEURL.'admin/manager-category.php');
        }
      }
    ?>
    <br>

    <form action="" method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Name</td>
          <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
        </tr>
        <tr>
          <td>Current Image</td>
          <td>
            <?php 
              if($old_image=="")
              {
                echo "<div class='error'>Image is not added</div>";
              }
              else
              {
                echo "<img src='".SITEURL."/media/$old_image' width='100px'>";
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>New Image</td>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id ?>">
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
    $id = $_POST['id'];
    $name_new = $_POST['name'];
    if($_FILES['image']['name']!= "")
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

    if($old_image != "")
    {
      $path ="../media/".$old_image;
      $remove = unlink($path);
      if ($remove==false)
      {
        $_SESSION['delete'] = "<div class='error'>Image Category Deleted Fail</div>";
        header('location:'.SITEURL.'admin/manager-category.php');
        die();
      }
    } 
    $sql = "UPDATE tbl_categories SET
      name='$name_new',
      image='$image_name'
      WHERE id='$id'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Category Updated Successfully</div>";
      header('location:'.SITEURL.'admin/manager-category.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Update Category</div>";
      header('location:'.SITEURL.'admin/manager-category.php');
    }
  }
?>