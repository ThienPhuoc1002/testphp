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
    // $target_dir = "../media/";
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // // Check if image file is a actual image or fake image
    // if(isset($_POST["submit"])) {
    //   $check = getimagesize($_FILES["image"]["tmp_name"]);
    //   if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    //   } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    //   }
    // }

    // // // Check if file already exists
    // // if (file_exists($target_file)) {
    // //   echo "Sorry, file already exists.";
    // //   $uploadOk = 0;
    // // }

    // // // Check file size
    // // if ($_FILES["image"]["size"] > 500000) {
    // //   echo "Sorry, your file is too large.";
    // //   $uploadOk = 0;
    // // }

    // // // Allow certain file formats
    // // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // // && $imageFileType != "gif" ) {
    // //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    // //   $uploadOk = 0;
    // // }

    // // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //   echo "Sorry, your file was not uploaded.";
    // // if everything is ok, try to upload file
    // } else {
    //   if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    //     echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    //   } else {
    //     echo "Sorry, there was an error uploading your file.";
    //   }
    // }
    // die();

    $name = $_POST['name'];
    if(isset($_FILES['image']['name']))
    {
      $image_name = basename($_FILES['image']['name']);
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../media/category/".$image_name;
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
      echo "Date inserted";
      $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
      header('location:'.SITEURL.'admin/manager-category.php');
    }
    else
    {
      echo "fail inserted";
      $_SESSION['add'] = "<div class='error'>Failed Add Category</div>";
      header('location:'.SITEURL.'admin/add-category.php');
    }
  }
?>