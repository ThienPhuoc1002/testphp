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
        <h2 class="text-center text-white">Fill this form to comfirm your order.</h2>  

        <form action="#" class="order">
          <fieldset>
            <legend>Selected Food</legend>

            <div class="food-menu-img">
              <img src="./media/pizza.jpeg" alt="" class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
              <h3>Food Title</h3>
              <p class="food-price">3000d</p>

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
      </div>

  </section>

  <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>  

        <div class="food-menu-box">
          <div class="food-menu-img">
            <img src="./media/pizza.jpeg" alt="" class="img-responsive img-curve">
          </div>

          <div class="food-menu-desc">
            <h4>foodtitle</h4>
            <p class="food-price">3000d</p>
            <p class="food-detail">Description</p>
            <br>
            <a href="" class="btn btn-primary">Order</a>
          </div>
        </div>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <img src="./media/pizza.jpeg" alt="" class="img-responsive img-curve">
          </div>

          <div class="food-menu-desc">
            <h4>foodtitle</h4>
            <p class="food-price">3000d</p>
            <p class="food-detail">Description</p>
            <br>
            <a href="" class="btn btn-primary">Order</a>
          </div>
        </div>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <img src="./media/pizza.jpeg" alt="" class="img-responsive img-curve">
          </div>

          <div class="food-menu-desc">
            <h4>foodtitle</h4>
            <p class="food-price">3000d</p>
            <p class="food-detail">Description</p>
            <br>
            <a href="" class="btn btn-primary">Order</a>
          </div>
        </div>

        <div class="clearfix"></div>
      </div>
  </section>

  <?php include('partials-front/footer.php'); ?>