<?php 

session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- CSS from Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/92ce2e27c0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
         
    <!----NAVBAR---->



    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-white py-3 fixed-top">
        <div class="container">
          <!-- <img src="assets/imgs/"> -->
          <h2 class="logo">Stayteen</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
           <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="About.php">About Us</a>
              </li>



              <li class="nav-item nav-icons">
              <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                    <span class=" cart_quantity"> <?php echo $_SESSION['cart_quantity']; ?> </span>
                    <?php }?>
             
              <a href="cart.php">
                
              <i class="fas fa-shopping-bag">
                  
                  
                </i>

              </a>
                
              </li>
            </ul>

            
          </div>
        </div>
      </nav>