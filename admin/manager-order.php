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
          if(isset($_SESSION['delete']))
          {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }
        ?>
        <br><br>
        
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br><br>

        <table class="tbl-full">
          <tr>
            <th>SN</th>
            <th>Food</th>
            <th>Price</th>
            <th>Total</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Actions</th>
          </tr>

          <?php
            $sql = "SELECT * FROM tbl_foods";
            $res = mysqli_query($conn, $sql);
            if($res==TRUE)
            {
              $count  = mysqli_num_rows($res);
              if($count>0)
              {
                while($rows=mysqli_fetch_assoc($res))
                {
                  $id=$rows['id'];
                  $name=$rows['name'];
                  $price=$rows['price'];
                  $type=$rows['category_id'];
                  $image=$rows['image'];
                  ?>

                  <tr>
                    <td><?php echo $id ?></td>
                    <td>
                      <?php 
                        $sql1 = "SELECT name FROM tbl_categories WHERE id=$type";
                        $res1  = mysqli_query($conn, $sql1);
                        echo mysqli_fetch_assoc($res1)['name'];
                      ?>
                    </td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $price ?></td>
                    <td>
                      <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                    </td>
                  </tr>

                  <?php
                }
              }
            }
          ?>

          
        </table>

      </div>
    </div>

<?php include('partials/footer.php'); ?>