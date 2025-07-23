

<?php

session_start();



if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){

}else{
  header('location:index.php');
}


if (isset($_POST['total_price'])) {
    $total_price = $_POST['total_price'];
    $product_quantity = $_POST['product_quantity']; // Product quantity
    // You can use $total_price here as needed
}



?>


<?php include('layouts/header.php');?>

      <!-- #CheckOut -->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Check Out</h2>
            <hr class="mx-auto">

        </div>
        <div class="mx-auto container">
            <form id="checkout-form" action="payment.php" method="POST">
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone"  required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="address" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <h3>Total amount : Rs.<?php echo $_SESSION['total'];?></h3>
                    <input type="submit" class="btn checkout-btn" name ="place_check"  value="Place Order">
                </div>
                
            </form>
        </div>
      </section>



<?php include('layouts/footer.php')?>;