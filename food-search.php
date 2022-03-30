  <?php include('partials-front/menu.php'); ?>

  <section class="food-search text-center">
      <div class="container">
        <?php
          $search = $_POST['search'];
        ?>
        <h2>Foods on Your Search <a href="" class="text-white"><?php echo $search; ?></a></h2>
      </div>
  </section>


  <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>  

        <?php
          $sql = "SELECT * FROM tbl_foods WHERE name like '%$search%'";
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
                  <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order</a>
                </div>
              </div>

              <?php
            }
          }
          else
          {
            echo "<div class='error text-center'>Food not found</div>";
          }
        ?>

        <div class="clearfix"></div>
      </div>
  </section>

  <?php include('partials-front/footer.php'); ?>