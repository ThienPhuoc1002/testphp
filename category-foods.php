<?php include('partials-front/menu.php'); ?>

<?php
  if(isset($_GET['category_id']))
  {
    $category_id = $_GET['category_id'];
    $sql = "SELECT name FROM tbl_categories WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_name = $row['name'];
  }
  else
  {
    header('location:'.SITEURL);
  }
?>

<section class="food-search text-center">
    <div class="container">
      <h2>Foods on <a href="" class="text-white"><?php echo $category_name; ?></a></h2>
    </div>
</section>


<section class="food-menu">
    <div class="container">
      <h2 class="text-center">Food Menu</h2>  

      <?php
        $sql = "SELECT * FROM tbl_foods WHERE category_id = $category_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>0)
        {
          while($row=mysqli_fetch_assoc($res))
          {
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
            ?>
            
            <div class="food-menu-box">
              <div class="food-menu-img">
                <?php
                  if($image=="")
                  {
                    echo "<div class='error'>Image not available</div>";
                  }
                  else
                  {
                    ?>
                    <img src="<?php echo SITEURL; ?>media/<?php echo $image; ?>" class="img-responsive img-curve">
                    <?php
                  }
                ?>
              </div>

              <div class="food-menu-desc">
                <h4><?php echo $name; ?></h4>
                <p class="food-price"><?php echo $price; ?></p>
                <p class="food-detail">Description</p>
                <br>
                <a href="" class="btn btn-primary">Order</a>
              </div>
            </div>

            <?php
          }
        }
        else
        {
          echo "<div class='error text-center'>Food not available</div>";
        }
      ?>

      <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>