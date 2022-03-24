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
        
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br>

        <table class="tbl-full">
          <tr>
            <th>SN</th>
            <th>Full Name</th>
            <th>Actions</th>
          </tr>

          <?php
            $sql = "SELECT * FROM users";
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
                  ?>

                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name ?></td>
                    <td>
                      <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                      <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
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