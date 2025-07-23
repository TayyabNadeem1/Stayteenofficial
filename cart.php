<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // If the user has already added something to cart i.e cart is not empty
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // If the product has already been added to cart or not
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_img' => $_POST['product_img'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            // Product was already added to cart
            echo '<script>window.location="index.php";</script>';
        }
    } else {
        // If this is the first product
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_img' => $product_img,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }

    // Calculate total
    calculateTotalCart();
} elseif (isset($_POST['remove_product'])) {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    // Calculate total
    calculateTotalCart();
} elseif (isset($_POST['edit_quantity'])) {
    // We get ID and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // Get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    // Update product quantity
    $product_array['product_quantity'] = $product_quantity;

    // Return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;

    // Calculate total
    calculateTotalCart();
} else {
    // Default case
    // header('location:index.php');
}

$price_check = 0;

// function calculateTotalCart()
// {
//     $total_price = 0;
//     $total_quantity = 0;

//     foreach ($_SESSION['cart'] as $key => $value) {
//         $product = $_SESSION['cart'][$key];

//         $price = $product['product_price'];
//         $quantity = $product['product_quantity'];

//         $total_price += ($price * $quantity);
//         $total_quantity += $quantity;

//         // Update the price for each product
//         echo "<script>document.getElementById('product_price_$key').innerText = 'Rs. ' + " . ($price * $quantity) . ".toFixed(2);</script>";
//     }

//     $total_price += 200; // Add shipping cost (if any) to the total price
//     $_SESSION['total'] = $total_price;
//     $_SESSION['quantity'] = $total_quantity;

//     // Update the total price display
//     echo "<script>document.getElementById('total-price').innerText = 'Rs. ' + $total_price.toFixed(2);</script>";
// }

// function edit(){
//   $product_id = $_POST['product_id'];
//     $product_quantity = $_POST['product_quantity'];

//     // Get the product array from the session
//     $product_array = $_SESSION['cart'][$product_id];

//     // Update product quantity
//     $product_array['product_quantity'] = $product_quantity;

//     // Return array back to its place
//     $_SESSION['cart'][$product_id] = $product_array;

//     // Calculate total
//     calculateTotalCart();
// }

// ... (Your existing code)

// Calculate total cart quantity

$cart_quantity = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $cart_quantity += $product['product_quantity'];
    }
}
// Save the total cart quantity in the session
$_SESSION['cart_quantity'] = $cart_quantity;

// ... (Rest of your cart.php code)





?>

<?php include('layouts/header.php'); ?>

<!-- Cart-->
<body> 
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

                    <style>
  /* Adjust the styles for the form elements */
  form {
      display: flex;
      align-items: center;
      justify-content: center;
      width: fit-content; /* Set the form width to fit the content */
      margin: auto; /* Center the form horizontally */
  }

  .minus-btn,
  .plus-btn {
      display: inline-block;
      width: 24px; /* Set the width for the plus and minus buttons */
      height: 24px; /* Set the height for the plus and minus buttons */
      font-size: 20px;
      line-height: 24px;
      text-align: center;
      cursor: pointer;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
      border-radius: 4px;
      margin: 0 4px; /* Add some margin between the buttons and the quantity text */
  }

  h3 {
      display: inline-block;
      font-size: 16px;
      margin: 0;
      padding: 0 8px; /* Add some padding to the quantity text */
  }

  /* Style the cart count in the header */
  .cart-count {
      display: inline-block;
      width: 20px;
      height: 20px;
      line-height: 20px;
      text-align: center;
      font-size: 14px;
      background-color: #f00;
      color: #fff;
      border-radius: 50%;
      position: absolute;
      top: 5px;
      right: 5px;
  }

    /* Styles for the quantity controls */
    .quantity-controls {
        display: flex;
        align-items: center;
    }

    .minus-btn,
    .plus-btn {
        width: 24px;
        height: 24px;
        font-size: 20px;
        line-height: 24px;
        text-align: center;
        cursor: pointer;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        border-radius: 4px;
        margin: 0 4px;
    }

    h3 {
        font-size: 16px;
        margin: 0;
        padding: 0 8px;
    }


</style>


<div class="quantity-controls">
    <button type="button" class="minus-btn" onclick="updateQuantity(<?php echo $value['product_id']; ?>, -1, <?php echo $value['product_price']; ?>)">-</button>
    <h3 id="quantity_<?php echo $value['product_id']; ?>"><?php echo max(1, $value['product_quantity']); ?></h3>
    <button type="button" class="plus-btn" onclick="updateQuantity(<?php echo $value['product_id']; ?>, 1, <?php echo $value['product_price']; ?>)">+</button>
</div>


<script>
function updateQuantity(productId, quantityChange, productPrice) {
    var quantityElement = document.getElementById('quantity_' + productId);
    var currentQuantity = parseInt(quantityElement.innerText);

    // Ensure that the currentQuantity is a valid number
    currentQuantity = isNaN(currentQuantity) ? 0 : currentQuantity;

    // Update the displayed quantity
    var newQuantity = Math.max(1, currentQuantity + quantityChange);
    quantityElement.innerText = newQuantity;

    // Ensure that productPrice and newQuantity are valid numbers
    productPrice = isNaN(productPrice) ? 0 : productPrice;
    newQuantity = isNaN(newQuantity) ? 0 : newQuantity;

    // Calculate and update the displayed price
    var priceElement = document.getElementById('price_' + productId);
    var newPrice = productPrice * newQuantity;

    // Check if newPrice is a valid number before updating
    if (!isNaN(newPrice)) {
        priceElement.innerText = 'Rs. ' + newPrice.toFixed(2);
    }

    // Update the total price
    updateTotalPrice();
    
    // Make an AJAX call to update the quantity in the session
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'cart.php', true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
            console.log(xhr.responseText);
        }
    };

    // Send the data to the server
    xhr.send('edit_quantity=1&product_id=' + productId + '&product_quantity=' + newQuantity);
}

function updateTotalPrice() {
    var totalPriceElement = document.getElementById('total-price');
    var newTotalPrice = 200; // initial shipping cost

    // Iterate through all products and update total price
    <?php foreach ($_SESSION['cart'] as $key => $value): ?>
        var quantity = parseInt(document.getElementById('quantity_<?php echo $value['product_id']; ?>').innerText);
        var price = parseFloat(<?php echo $value['product_price']; ?>);
        newTotalPrice += quantity * price;
    <?php endforeach; ?>

    // Update the total price in the HTML
    totalPriceElement.innerText = 'Rs. ' + newTotalPrice.toFixed(2);
}
</script>





                <td>
                    <h3 id="price_<?php echo $value['product_id']; ?>">
                        Rs. <?php echo number_format($value['product_quantity'] * $value['product_price'],0); ?>
                    </h3>
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
                
                <td id="total-price">Rs. <?php echo $_SESSION['total']; ?></td>

            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="hidden" name="total_price" value="<?php echo $_SESSION['total']; ?>">
            <input type="hidden" name="product_quantity" value="<?php echo $_SESSION['quantity']; ?>">
            <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
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

<?php include('layouts/footer.php'); ?>

</body>