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

  $total_price += 150; // Add shipping cost (if any) to the total price
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}

?>


<?php include('layouts/header.php');?>




<html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }



img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

@media screen and (max-width: 480px) {
    .mobile-hide {
        display: none !important;
    }
    .mobile-center {
        text-align: center !important;
    }
}
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">



<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#F44336">
               
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">Stayteen</h1>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                <table cellspacing="0" cellpadding="0" border="0" align="right">
                                    <tr>
                                        <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                            <p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a href="#" target="_blank" style="color: #ffffff; text-decoration: none;">Shop &nbsp;</a></p>
                                        </td>
                                        <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;">
                                            <a href="#" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="https://img.icons8.com/color/48/000000/small-business.png" width="27" height="23" style="display: block; border: 0px;"/></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
              
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                Thank You For Your Order!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                             
                            </div>
                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        Order Confirmation #
                                    </td>
                                    <div class="container">
        <h2>Order Confirmation</h2>
        <div class="order-info">
          
            
            <p><strong>Delivery Address:</strong> <?php echo $_SESSION['delivery_address']; ?></p>
            <!-- Add more order details as needed -->
        </div>
    </div>
                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        <?php echo $_SESSION['order_number']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        Purchased Items
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        Prices
                                    </td>
                                </tr>

                                <?php 
                                $total_price = 0;
                                foreach($_SESSION['cart'] as $key => $product):
                                    $product_name = $product['product_name'];
                                    $product_price = $product['product_price'];
                                    $product_quantity = $product['product_quantity'];
                                    $subtotal = $product_price * $product_quantity;
                                    $total_price += $subtotal;
                                ?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                        <?php echo $product_name; ?> (<?php echo $product_quantity; ?>)
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                        $<?php echo number_format($subtotal, 2); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        Total
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        $<?php echo number_format($total_price, 2); ?>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
                
                </td>
            </tr>
             <tr>
                <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0;">
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Delivery Address</p>
                                            <p>675 Massachusetts Avenue<br>11th Floor<br>Cambridge, MA 02139</p>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Estimated Delivery Date</p>
                                            <p>January 1st, 2016</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td align="center" style=" padding: 35px; background-color: #ff7361;" bgcolor="#1b9ba3">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>

                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px 0 15px 0;">
                            
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            
        </table>
        </td>
    </tr>
</table>
    
</body>
</html>
