<?php include('partials/menu.php'); ?>

    <div class="main-content">
      <div class="wrapper">
        <h1>Manager Admin</h1>
      
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
        
        <a href="add-category.php" class="btn-primary">Add Category</a>

        <br><br>

        <table class="tbl-full">
          <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Image</th>
            <th>Action</th>
          </tr>

          <?php
            $sql = "SELECT * FROM tbl_categories";
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
                  $image=$rows['image'];
                  ?>

                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name ?></td>
                    <td>
                      <?php 
                        if($image=="")
                        {
                          echo "<div class='error'>Image is not added</div>";
                        }
                        else
                        {
                          echo "<img src='".SITEURL."/media/$image' width='100px'>";
                        }
                      ?>
                    </td>
                    <td>
                      <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
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