<?php include('partials-front/menu.php'); ?>

  <section class="food-search text-center">
      <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
          <input type="search" name="search" placeholder="Search for food..">
          <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
      </div>
  </section>

  <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2> 

        <?php
          $sql = "SELECT * FROM tbl_categories LIMIT 3";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if($count>0)
          {
            while($row=mysqli_fetch_assoc($res))
            {
              $id = $row['id'];
              $name = $row['name'];
              $image = $row['image'];
              ?>
              
              <a href="#">
                <div class="box-3 float-container">
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
                  
                  <h3 class="float-text text-white"><?php echo $name; ?></h3>
                </div>
              </a>

              <?php
            }
          }
          else
          {
            echo "<div class='error'>Category not Added</div>";
          }
        ?>

        <div class="clearfix"></div>
      </div>
  </section>

  <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>  

        <?php
          $sql = "SELECT * FROM tbl_foods";
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
            echo "<div class='error'>Food not Added</div>";
          }
        ?>

        <div class="clearfix"></div>
      </div>
  </section>

  <?php include('./partials-front/footer.php'); ?>