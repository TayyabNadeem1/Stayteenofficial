<?php

 session_start();

include('connection.php');

if(isset($_POST['place_order']) ){

    
    // 1. get user info and store in its database
    
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    
    $order_date = date('Y-m-d H:i:s');
    
    

      $stmt = $conn->prepare("insert into orders (order_cost, order_status, user_name,user_phone,user_city, user_address, order_date, email)
      values (?,?,?,?,?,?,?,?); ");
  
      $stmt->bind_param('ississss',$order_cost,$order_status, $_SESSION['name'], $_SESSION['phone'],$_SESSION['city'],$_SESSION['address'],$order_date,$_SESSION['email']);
  
              
      $stmt_status = $stmt->execute();
  
      
      if(!$stmt_status){
        header('location : index.php');
    }
  
    // 2. issue new order and store order info in database
    $order_id = $stmt->insert_id;
     
  
    
  
    // 3. get products from the cart (from session)
  
    // [ 4=>[array], 5=> [] ]
  
    
    foreach($_SESSION['cart'] as $key => $value){
  
    
        $product = $_SESSION['cart'][$key]; // []
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_img'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        
        // 4. store each single item in order_item database
        $stmt1 = $conn->prepare("insert into order_items (order_id, product_id, product_name, product_img, product_price, product_quantity, order_date)
        values (?,?,?,?,?,?,?)");
  
        $stmt1->bind_param('iissiis',$order_id,$value['product_id'],$value['product_name'],$value['product_image'],$value['product_price'],$value['product_quantity'],$order_date);
  
        $stmt1->execute();
  
    }
  
  
  
  
  
    
  
  
    
  
    // 5. remove everything from cart --> delay untill payment
    
    unset($_SESSION['cart']);
    $_SESSION['quantity'] = 0;
    $_SESSION['total'] = 0;
    
    
  
    // 6. inform user whether everything is fine or not
    // ...
    $_SESSION['order_status'] = 'order placed successfully';
    
    header('location: ../confirmation_message.php');
  }
  

?>