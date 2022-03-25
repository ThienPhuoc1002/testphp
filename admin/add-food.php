<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Food</h1>
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
          <td>Price</td>
          <td><input type="number" name="price"></td>
        </tr>
        <tr>
          <td>Image</td>
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
                    $id=$rows['id'];
                    $name=$rows['name'];
                    ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    if($_FILES['image']['name'] != "")
    {
      $image_name = basename($_FILES['image']['name']);
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../media/food/".$image_name;
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
      $image_name="";
    }
    $sql = "INSERT INTO tbl_foods SET 
    name='$name',
    price='$price',
    category_id='$category',
    image='$image_name'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
      header('location:'.SITEURL.'admin/manager-food.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Add Food</div>";
      header('location:'.SITEURL.'admin/add-food.php');
    }
  }
?>