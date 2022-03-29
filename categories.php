<?php include('partials-front/menu.php'); ?>

  <section class="food-search text-center">
      <div class="container">
        <form action="">
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
            echo "<div class='error'>Category not found</div>";
          }
        ?>

        <div class="clearfix"></div>
      </div>
  </section>

  <?php include('partials-front/footer.php'); ?>