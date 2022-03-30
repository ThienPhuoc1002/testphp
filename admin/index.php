<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>DASHBOARD</h1>

    <div class="col-4 text-center">
      <h1>
        <?php
          $sql = "SELECT * FROM tbl_categories";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          echo $count;
        ?>
      </h1>
      <br/>
      Categories
    </div>

    <div class="col-4 text-center">
      <h1>
        <?php
          $sql = "SELECT * FROM tbl_foods";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          echo $count;
        ?>
      </h1><br/>
      Foods
    </div>

    <div class="col-4 text-center">
      <h1>
        <?php
          $sql = "SELECT * FROM tbl_order";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          echo $count;
        ?>
      </h1><br/>
      Total Order
    </div>

    <div class="col-4 text-center">
      <h1>
        <?php
          $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          echo $row['Total'];
        ?>
      </h1><br/>
      Total Revenue
    </div>

    <div class="clearfix"></div>

  </div>
</div>

<?php include('partials/footer.php'); ?>