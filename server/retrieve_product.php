<?php


$conn = mysqli_connect("localhost","root","","stayteen_database")
    or die("couldn't connect to database");


$stmt = $conn->prepare("SELECT * FROM products WHERE (product_id <= 13 AND product_id != 7 OR product_id IN (43, 44, 45, 47, 48) OR product_id = 37) ORDER BY CASE WHEN product_id = 37 THEN 1 ELSE 0 END, product_id");

$stmt->execute();

$featured_products = $stmt->get_result();




// Gold Section

$stmt_gold = $conn->prepare("SELECT * FROM products WHERE (product_id > 15 AND product_id <= 22) OR product_id = 38");


$stmt_gold->execute();

$featured_products_gold = $stmt_gold->get_result();





// Charcoal

$stmt_charcoal = $conn->prepare("SELECT * FROM products WHERE (product_id >22 AND product_id <=28 ) OR product_id = 39");

$stmt_charcoal->execute();

$featured_products_charcoal = $stmt_charcoal->get_result();



// Professional Series

$stmt_professional = $conn->prepare("select * from products where product_id >28 and product_id<33  ");

$stmt_professional->execute();

$featured_products_professional = $stmt_professional->get_result();


// Rice Range Series

$stmt_rice = $conn->prepare("SELECT * FROM products WHERE product_id IN (40, 41, 42, 54)");

$stmt_rice->execute();

$featured_products_rice = $stmt_rice->get_result();


// 120 ml series

$stmt_120ml = $conn->prepare("SELECT * FROM products WHERE product_id IN (46,50,51,53,56,57,58)");

$stmt_120ml->execute();

$featured_products_120ml = $stmt_120ml->get_result();

// sunblock

$stmt_sunblock = $conn->prepare("SELECT * FROM products WHERE product_id IN (14,15,52,55)");

$stmt_sunblock->execute();

$featured_products_sunblock = $stmt_sunblock->get_result();

// $stmt_gold = $conn->prepare("select * from gold ");

// $stmt_gold->execute();

// $featured_products_gold = $stmt_gold->get_result();



?>