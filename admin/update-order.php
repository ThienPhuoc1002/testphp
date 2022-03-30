<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>
    <br>

    <?php
      if(isset($_GET['id']))
      {
        $id= mysqli_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM tbl_order WHERE id='$id'";
        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
          $count = mysqli_num_rows($res);
          if($count==1)
          {
            $rows = mysqli_fetch_assoc($res);
            $food_id=$rows['food_id'];
            $quantity=$rows['quantity'];
            $price=$rows['price'];
            $total=$rows['total'];
            $order_date=$rows['order_date'];
            $status=$rows['status'];
            $customer_name=$rows['customer_name'];
            $customer_phone=$rows['customer_phone'];
            $customer_email=$rows['customer_email'];
            $customer_address=$rows['customer_address'];
          }
          else
          {
            header('location:'.SITEURL.'admin/manager-order.php');
          }
        }
      }
      else
      {
        header('location:'.SITEURL.'admin/manager-order.php');
      }
    ?>
    <br>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Food Name</td>
          <td>
            <?php 
              $sql1 = "SELECT name FROM tbl_foods WHERE id=$food_id";
              $res1  = mysqli_query($conn, $sql1);
              echo mysqli_fetch_assoc($res1)['name'];
            ?>
          </td>
        </tr>
        <tr>
          <td>Price</td>
          <td><?php echo $price; ?></td>
        </tr>
        <tr>
          <td>Quantity</td>
          <td><input type="text" name="quantity" value="<?php echo $quantity; ?>"></td>
        </tr>
        
        <tr>
          <td>Status</td>
          <td>
            <select name="status">
              <option <?php if($status=="Ordered") echo "selected"; ?>  value="Ordered">Ordered</option>
              <option <?php if($status=="On Delivery") echo "selected"; ?> value="On Delivery">On Delivery</option>
              <option <?php if($status=="Delivered") echo "selected"; ?> value="Delivered">Delivered</option>
              <option <?php if($status=="Cancelled") echo "selected"; ?> value="Cancelled">Cancelled</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Customer Name</td>
          <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
        </tr>
        <tr>
          <td>Customer Phone</td>
          <td><input type="text" name="customer_phone" value="<?php echo $customer_phone; ?>"></td>
        </tr>
        <tr>
          <td>Customer Email</td>
          <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
        </tr>
        <tr>
          <td>Customer Address</td>
          <td><textarea name="customer_address" rows="10"><?php echo $customer_address; ?></textarea></td>
        </tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

  </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit']))
  {
    $id = $_POST['id'];
    $quantity= $_POST['quantity'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_email= $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    
    $sql = "UPDATE tbl_order SET
      quantity='$quantity',
      status='$status',
      customer_name='$customer_name',
      customer_phone='$customer_phone',
      customer_email='$customer_email',
      customer_address='$customer_address'
      WHERE id='$id'
    ";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Order Updated Successfully</div>";
      header('location:'.SITEURL.'admin/manager-order.php');
    }
    else
    {
      $_SESSION['add'] = "<div class='error'>Failed Update Order</div>";
      header('location:'.SITEURL.'admin/manager-order.php');
    }
  }
?>