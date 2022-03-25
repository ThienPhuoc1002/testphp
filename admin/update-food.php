<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>
    <br>

    <?php
      $id=$_GET['id'];
      $sql = "SELECT * FROM tbl_foods WHERE id='$id'";
      $res = mysqli_query($conn, $sql);
      if($res==TRUE)
      {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
          $row=mysqli_fetch_assoc($res);
          $name = $row['name'];
          $price = $row['price'];
          $old_image = $row['image'];
          $type = $row['category_id'];
        }
        else
        {
          header('location:'.SITEURL.'admin/manager-food.php');
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
          <td>Price</td>
          <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
        </tr>
        <tr>
          <td>Current Image</td>
          <td>
          <input type="hidden" name="old_image" value="<?php echo $old_image ?>">
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
          <td>Category</td>
          <td>
            <select name="category">
              <?php
                $sql = "SELECT * FROM tbl_categories";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                  while($rows=mysqli_fetch_assoc($res))
                  {
                    $cate_id=$rows['id'];
                    $name=$rows['name'];
                    ?>
                    <option value="<?php echo $cate_id; ?>" <?php if ($cate_id==$type) echo "selected"; ?> se ><?php echo $name; ?></option>
                    <?php
                  }
                }
                else
                {
                  ?>
                  <option value="0" disabled>No Category</option>
                  <?php
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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
    $name= $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $old_image = $_POST['old_image'];
    if($_FILES['image']['name']!= "")
    {
      $image_name = basename($_FILES['image']['name']);
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../media/".$image_name;
      // $ext = end(explode('.', $image_name));
      // $image_name = "food_".rand(000, 999).'.'.$ext;
      $upload = move_uploaded_file($source_path, $destination_path);
      if($upload==false)
      {
        $_SESSION['add'] = "<div class='error'>Failed Add Image</div>";
        header('location:'.SITEURL.'admin/add-food.php');
      }
    }
    else
    {
      $image_name=$old_image;
    }

    // if($old_image != "")
    // {
    //   $path ="../media/".$old_image;
    //   $remove = unlink($path);
    //   if ($remove==false)
    //   {
    //     $_SESSION['delete'] = "<div class='error'>Image Food Deleted Fail</div>";
    //     header('location:'.SITEURL.'admin/manager-food.php');
    //     die();
    //   }
    // } 
    $sql = "UPDATE tbl_foods SET
      name='$name',
      price='$price',
      category_id='$category',
      image='$image_name'
      WHERE id='$id'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Food Updated Successfully</div>";
      header('location:'.SITEURL.'admin/manager-food.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Update Food</div>";
      header('location:'.SITEURL.'admin/manager-food.php');
    }
  }
?>