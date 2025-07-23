

<?php

session_start();
$orderStatus = isset($_SESSION['order_status']) ? $_SESSION['order_status'] : '';
echo "Order Status: $orderStatus";

// if(isset($_POST['order_pay_btn'])){
//   $order_status = $_POST['order_status'];
//   $order_total_price = $_POST['order_total_price'];
// }

if(isset($_POST['add_to_cart'])){

  // if user has already added to something to cart i.e cart is not empty
  if(isset($_SESSION['cart'])){

    $products_array_ids = array_column($_SESSION['cart'],"product_id");
    //if product has aleady been added to cart or not
    if(!in_array($_POST['product_id'], $products_array_ids) ){

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' =>$_POST['product_id'],
        'product_name' =>$_POST['product_name'],
        'product_price' =>$_POST['product_price'],
        'product_img' =>$_POST['product_img'],
        'product_quantity' =>$_POST['product_quantity']
      );
  
          $_SESSION['cart'][$product_id] = $product_array;
  
      //products has alrady been added
    }else{

      // echo '<script>alert("Product was already added to cart");</script>';
      echo '<script>window.location="index.php";</script>';
    }


    // if this is the first product
  }else{

      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_img = $_POST['product_img'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
        'product_id' =>$product_id,
        'product_name' =>$product_name,
        'product_price' =>$product_price,
        'product_img' =>$product_img,
        'product_quantity' =>$product_quantity
      );

          $_SESSION['cart'][$product_id] = $product_array;
    }

    // calculate total
    calculateTotalCart();



    // remove from cart
  }elseif (isset($_POST['remove_product'])) {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
     // calculate total
     calculateTotalCart();
}else if(isset($_POST['edit_quantity'])){

  //we get id and quantity from the form
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  //get the product array from the session
  $product_array = $_SESSION['cart'][$product_id];

  //update product quantity
  $product_array['product_quantity'] = $product_quantity;

  // return array back its place
  $_SESSION['cart'][$product_id] = $product_array;
   
  // calculate total
   calculateTotalCart();
}


// function calculateTotalCart(){

//   $total_price = 0;

//   $total_quantity=0;
//   foreach($_SESSION['cart'] as $key => $value){

//     $product = $_SESSION['cart'][$key];

//     $price = $product['product_price'];

//     $quantity = $product['product_quantity'];

//     $total_price = $total_price + ($price * $quantity);
//     $total_quantity = $total_quantity + $quantity;

//   }
//   $total_price = $total_price+200;
//   $_SESSION['total'] = $total_price ;
//   $_SESSION['quantity']= $total_quantity;
  
// }








?>


<?php 
       if(isset($_POST['place_check']) ){

    
        // 1. get user info and store in its database
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['address'] = $_POST['address'];

       


        }


      
       ?>




<?php include('layouts/header.php');?>


      <!-- Payment -->
      <section class="my-1 py-1">
        <!-- <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Confirm Order</h2>
            <hr class="mx-auto"> -->

        </div>
        <div class="mx-auto container text-center ">
            
          <!-- <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
          <h3>Total amount : Rs. <?php echo $_SESSION['total']; ?> </h3> 
          <input  class="btn btn-primary" type="submit" value="Pay Now"/> -->
          

          <!-- <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] =="on hold") {?> 
                  <h4> Total payment : Rs. <?php echo $_POST['order_total_price']; ?></h4>
                  <input  class="btn btn-primary" type="submit" value="Pay Now"/> -->

            <?php } else {?> 
              <h4> Your cart is empty </h4>
              <?php }?>

            <!-- <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>
            <input  class="btn btn-primary" type="submit" value="Pay Now"/>
              <?php } else { ?> -->

                <?php }?>


                <!-- <h3><?php if(isset($_POST['order_status'])){echo $_POST['order_status']; }?></h3> 

              <?php if(isset($_PST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
            <input  class="btn btn-primary" type="submit" value="Pay Now"/>
              <?php } ?>  -->
          </div>
      </section>

            <!-- Cart-->
            <section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Your Cart</h2>
    </div>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="/<?php echo $value['product_img'] ?> ">
                            <div>
                                <h4><?php echo $value['product_name']; ?></h4>
                                <h5><span>Rs.</span><?php echo $value['product_price']; ?></h5>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td class="cute-form-cell">
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                            <button type="submit" class="minus-btn" name="edit-quantity" value="-1">-</button>
                            <h3><?php echo max(1, $value['product_quantity']); ?></h3>
                            <button type="submit" class="plus-btn" name="edit-quantity" value="1">+</button>
                            <!-- Add an input field to store the product quantity -->
                            <input type="hidden" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                        </form>
                    </td>

                    <td>
                        <h3>Rs. <?php echo ($value['product_quantity'] * $value['product_price']); ?></h3>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else: ?>
        <h3>Your cart is empty.</h3>
    <?php endif; ?>

    <div class="cart-total">
        <table>
            <tr>
                <td>Shipping</td>
                <td>Rs. 200</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>Rs. <?php echo $_SESSION['total']; ?></td>
            </tr>
        </table>
    </div>


        <div class="container text-center mt-5 py-3 "id="open_shop">
              <h2>Shipping Details</h2>
              <hr>
              <h5>All information is secured encrypted</h5>
              
          </div> 
        
        <div class="mx-auto container" style="padding-bottom: 10px">
            <form id="checkout-form"  method="POST">
                <div class="form-group checkout-small-element">
                <h4> Name :  <?php echo $_SESSION['name']?></h4>

                </div>
                <div class="form-group checkout-small-element">
                <h4> Email :  <?php echo $_SESSION['email']?></h4>

                </div>
                <div class="form-group checkout-small-element">
                <h4> Phone Number : <?php echo $_SESSION['phone']?></h4>

                </div>
                <div class="form-group checkout-small-element">
                <h4> City : <?php echo $_SESSION['city']?></h4>

                </div>
                <div class="form-group checkout-large-element">
                <h4>Address : <?php echo $_SESSION['address']?></h4>

              </div>  


            </form>
            <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn " value="Change" name="checkout">
        </form>
        </div>
        
        
        <div class="container text-center mt-5 py-3 "id="open_shop">
              <h2>Payment Method</h2>
              <hr>
              <h5>all transactions are secure and encrypted </h5>
              
          </div> 
          <div class="container">
          <h3 class="color "> Cash on Delivery (COD)</h3>    
          
        </div>

        



        <div class="checkout-container">
          <form method="POST" action="server/place_order.php">
            <input type="submit" class="btn checkout-btn " value="Confirm Order" name="place_order">
            
        </form>
            
        </div>
       </section>



       <?php
if (isset($_POST['edit-quantity'])) {
    $productId = $_POST['product_id'];
    $quantityChange = intval($_POST['edit-quantity']);
    
    // Update quantity in session
    if (isset($_SESSION['cart'][$productId])) {
        $productArray = $_SESSION['cart'][$productId];
        $productArray['product_quantity'] += $quantityChange;
        if ($productArray['product_quantity'] < 1) {
            $productArray['product_quantity'] = 1;
        }
        $_SESSION['cart'][$productId] = $productArray;
    }

    // Recalculate total
    calculateTotalCart();
}
function calculateTotalCart() {
  $total_price = 0;
  $total_quantity = 0;

  foreach ($_SESSION['cart'] as $key => $value) {
      $price = $value['product_price'];
      $quantity = $value['product_quantity'];

      $total_price += ($price * $quantity);
      $total_quantity += $quantity;
  }

  $total_price += 200; // Add shipping cost (if any) to the total price
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}

?>



<?php include('layouts/footer.php');?>
 