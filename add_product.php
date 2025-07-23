<?php




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stayteen_database";



// add_product.php

$uploadDir = 'product_images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product details from the form
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];

    // Check if an image is uploaded
    if (isset($_FILES['image'])) {
        $uploadedFile = $_FILES['image'];
        $uploadedFileName = $uploadedFile['name'];
        $uploadedFilePath = $uploadDir . basename($uploadedFileName);

        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadedFilePath)) {
            // Image uploaded successfully, save the product details to the database
            $imagePath = $uploadedFilePath;

            // Assuming you have already established a database connection
            $conn = mysqli_connect('localhost', 'root', '', 'stayteen_database');

            $query = "INSERT INTO products (product_name, product_description, product_price, product_img) 
                      VALUES ('$productName', '$productDescription', '$productPrice', '$imagePath')";
            
            mysqli_query($conn, $query);


            // Close the database connection
            mysqli_close($conn);

            echo "Product added successfully!";
        } else {
            echo "Failed to upload the product image.";
        }
    }
}
?>
