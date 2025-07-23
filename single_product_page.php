
<?php

  include('server/connection.php');

  if(isset($_GET['product_id'])){

      $product_id = $_GET['product_id'];
    
      $stmt = $conn->prepare("select * from products where product_id = ?");
      $stmt->bind_param("i",$product_id);

      $stmt->execute();

      $product = $stmt->get_result();


    // no product id was given
  }else{
    header('location: index.php'); 
  }

?>

<?php include('layouts/header.php'); ?>


      <!-- #Single Product Page -->
      <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

        <?php while ($row = $product->fetch_assoc()) {?>


            <div class="col-md-5 col-md-6 col-sm-12">
                
                <img class="img-flid w-100 pb-1" src="/<?php echo  $row['product_img'] ?> " id="mainImg" height="100%">
                <div class="small-img-group"> 
                    <div class="small-img-col">
                        <!-- <img src="assets/imgs/<?php echo $row['product_img']?>" width="100%" class="small-img"/> -->
                    </div>
                    <div class="small-img-col">
                        <!-- <img src="assets/imgs/<?php echo $row['product_img']?>" width="100%" class="small-img"/> -->
                    </div>
                    <div class="small-img-col">
                        <!-- <img src="assets/imgs/<?php echo $row['product_img']?>" width="100%" class="small-img"/> -->
                    </div>
                    <div class="small-img-col">
                        <!-- <img src="assets/imgs/kk (6).jpg" width="100%" class="small-img"/> -->
                    </div>
                </div>
            </div>
        
        <div class="col-lg-6 col-md-12 col-12">
            <!-- <h7>Men/Soem</h7> -->
            <h7 class="py-4"><?php echo $row['product_name']?></h7>
            <h2>Rs.<?php echo $row['product_price']?></h2>

            <form method="POST" action="cart.php">
        </form>
            
            <section class="container">
           
           <div class="center container-c">
             <div class="button col ">
               <button id="minus-btn">-</button>
             </div>
             <div class="number col ">
               <h2 id="count">1</h2>
             </div>
             <div class="button col ">
               <button id="plus-btn">+</button>
             </div>
           
         </div>

       </section>      
          
       
       <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <input type="hidden" name="product_img" value="<?php echo $row['product_img']; ?>"/>
            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
            <input type="hidden" name="product_quantity" id="product_quantity" value="1">
        <button class="buy-btn "type="submit" name="add_to_cart">add to cart</button>  


      </form>

      

        
        <script>
  document.addEventListener("DOMContentLoaded", function () {
    let minusBtn = document.getElementById("minus-btn");
    let count = document.getElementById("count");
    let plusBtn = document.getElementById("plus-btn");
    let productQuantityInput = document.getElementById("product_quantity");

    let countNum = 1;
    count.innerHTML = countNum;

    minusBtn.addEventListener("click", () => {
      if (countNum > 0) {
        countNum -= 1;
        count.innerHTML = countNum;
        productQuantityInput.value = countNum; // Update the hidden input field
      }
    });

    plusBtn.addEventListener("click", () => {
      countNum += 1;
      count.innerHTML = countNum;
      productQuantityInput.value = countNum; // Update the hidden input field
    });
  });
</script>

            <!-- <input type="number" value="1" name="product_quantity"> -->

            
         

            
            <h2 class="mt-5 mb-5">Product details</h2>
            <h4> <?php echo $row['product_description']?><h4>
        </div>
        


        <?php }?>
        
        </div>
      </section>


      <!-- #Related Prodcut -->

              <!-- <section id="related-products" class="my-5 pb-5">
                <div class="container text-center mt-5 py-5">
                    <h3>Related Products</h3>
                    <hr>
                    
                </div>
                <div class="row mx-auto container-fluid">
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="/assets/imgs/me1.jpg"/>
                        <div class="star">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                        </div>
                        <h5 class="p-name">Fase Wash</h5>
                        <h4 class="p-price">1999.9$</h4>
                        <button class="buy-btn"> Buy Now</button>
                    </div>
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="/assets/imgs/me1.jpg"/>
                        <div class="star">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                        </div>
                        <h5 class="p-name">Fase Wash</h5>
                        <h4 class="p-price">1999.9$</h4>
                        <button class="buy-btn"> Buy Now</button>
                    </div>
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="/assets/imgs/me1.jpg"/>
                        <div class="star">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                        </div>
                        <h5 class="p-name">Fase Wash</h5>
                        <h4 class="p-price">1999.9$</h4>
                        <button class="buy-btn"> Buy Now</button>
                    </div>
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="/assets/imgs/me1.jpg"/>
                        <div class="star">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i> 
                        </div>
                        <h5 class="p-name">Fase Wash</h5>
                        <h4 class="p-price">1999.9$</h4>
                        <button class="buy-btn"> Buy Now</button>
                    </div>
                </div>
                
            </section>
 -->

  
        <!-- JS from Bootstrap -->
  

          
        <script>
            var mainImg = document.getElementById("mainImg");
            var smallImg = document.getElementsByClassName("small-img");

        for(let i=0; i<4; i++){
            
            smallImg[i].onclick = function(){
                mainImg.src = smallImg[i].src; 
            }
        }   


  




        </script>
          
<?php include('layouts/footer.php'); ?>