  <?php include('partials-front/menu.php'); ?>

  <?php
    if (isset($_GET['food_id']))
    {
      $food_id = $_GET['food_id'];
      $sql = "SELECT * FROM tbl_foods WHERE id = $food_id";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count==1)
      {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
      }
      else
      {
        header('location:'.SITEURL);
      }
    }
    else
    {
      header('location:'.SITEURL);
    }
  ?>

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
        <h2 class="text-center text-white">Fill this form to comfirm your order.</h2>  

        <form action="" method="POST" class="order">
          <fieldset>
            <legend>Selected Food</legend>

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
              <h3><?php echo $name ?></h3>
              <input type="hidden" name="food_id" class="input-responsive" value="<?php echo $food_id ?>" required>
              <p class="food-price"><?php echo $price ?></p>

              <input type="hidden" name="price" class="input-responsive" value="<?php echo $price ?>" required>
              <div class="order-label">Quantity</div>
              <input type="number" name="qty" class="input-responsive" value="1" required>
            </div>
          </fieldset>

          <fieldset>
          <legend>Delivery Details</legend>

            <div class="order-label">Full name</div>
            <input type="text" name="full-name" class="input-responsive" required>

            <div class="order-label">Phone number</div>
            <input type="tel" name="phone" class="input-responsive" required>


            <div class="order-label">Email</div>
            <input type="email" name="email" class="input-responsive" required>
          
            <div class="order-label">Address</div>
            <textarea name="address" rows="10" class="input-responsive" required></textarea>

            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
          </fieldset>
        </form>

        <?php
          if(isset($_POST['submit']))
          {
            $food_id = $_POST['food_id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:s");
            $status = "Ordered";

            $customer_name = $_POST['full-name'];
            $customer_phone = $_POST['phone'];
            $customer_address= $_POST['address'];
            $customer_email= $_POST['email'];

            $sql2 = "INSERT INTO tbl_order SET
              food_id = '$food_id',
              price = '$price',
              order_date = '$order_date',
              quantity = '$qty',
              total = '$total',
              status = '$status',
              customer_name = '$customer_name',
              customer_phone = '$customer_phone',
              customer_address = '$customer_address',
              customer_email = '$customer_email'
            ";
            $res2 = mysqli_query($conn, $sql2);
            if($res2==true)
            {
              $_SESSION['order'] = "<div class='success'>Food Ordered Success</div>";
              header('location:'.SITEURL);
            }
            else
            {
              $_SESSION['order'] = "<div class='error'>Food Ordered Fail</div>";
              header('location:'.SITEURL);
            }
          }
        ?>

      </div>

  </section>

  <?php include('partials-front/footer.php'); ?>