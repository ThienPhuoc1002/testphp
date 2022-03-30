<?php include('partials/menu.php'); ?>

    <div class="main-content">
      <div class="wrapper">
        <h1>Manager Food</h1>
      
        <br><br>
        <?php
          if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
        ?>
        <br><br>

        <table class="tbl-full">
          <tr>
            <th>SN</th>
            <th>Food</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Actions</th>
          </tr>

          <?php
            $sql = "SELECT * FROM tbl_order";
            $res = mysqli_query($conn, $sql);
            $count  = mysqli_num_rows($res);
            if($count>0)
            {
              while($rows=mysqli_fetch_assoc($res))
              {
                $id=$rows['id'];
                $food_id=$rows['food_id'];
                $quantity=$rows['quantity'];
                $price=$rows['price'];
                $total=$rows['total'];
                $order_date=$rows['order_date'];
                $status=$rows['status'];
                $customer_name=$rows['customer_name'];
                ?>

                <tr>
                  <td><?php echo $id ?></td>
                  <td>
                    <?php 
                      $sql1 = "SELECT name FROM tbl_foods WHERE id=$food_id";
                      $res1  = mysqli_query($conn, $sql1);
                      echo mysqli_fetch_assoc($res1)['name'];
                    ?>
                  </td>
                  <td><?php echo $price ?></td>
                  <td><?php echo $quantity ?></td>
                  <td><?php echo $total ?></td>
                  <td><?php echo $order_date ?></td>
                  <td><?php echo $status ?></td>
                  <td><?php echo $customer_name ?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                  </td>
                </tr>

                <?php
              }
            }
          ?>

          
        </table>

      </div>
    </div>

<?php include('partials/footer.php'); ?>