<?php
if(session_id() == '') {
  session_start();
} 
include 'header.php';?>

<?php
 $status="";    
if (isset($_GET['id']) && $_GET['id']!=""){
 $ID = $_GET["id"];
 require('conn.php');
 $sql = " SELECT * FROM products WHERE ID ='$ID'";
 $result = $conn->query($sql);
 $row = mysqli_fetch_array($result);
}
  ?>
<section class="layout">
   <div class="container2">
        <div class="single-product">
            <div class="row">
                <div class="col-6">
                    <div class="product-image">
                        <div class="product-image-main">
                            
                          <img  src="<?php echo $row["product_image"]; ?>" alt="" id="product-main-image">
                        </div>
    
                    </div>
                </div>
                <div class="col-6">
                
                    <div class="product">
                        <div class="product-title">
                            <h2><?php echo $row["product_name"]; ?></h2>
                        </div>

                        <div class="product-price">
                            <span class="offer-price">$ <?php echo  $row["product_price"]; ?></span>
                        </div>

                        <div class="product-details">
                            <h3>Description</h3>
                            <p><?php echo  $row["description"]; ?></p>
                        </div> 
                        
                        <div class="product-details">
                            <h3>Quantity</h3>
                        <form id='myform' method='POST' class='quantity' action='#'>
                        <input type='button' value='-' class='qtyminus minus' field='quantity' />
                        <input type='text' name='quantity' id= "<?php echo $ID; ?>" value='1' class='qty' />
                        <input type='button' value='+' class='qtyplus plus' field='quantity' />
                        </form> </div>

                        <span class="divider"></span>
                        
                        <div class="product-btn-group">
                        
                        
                        <a href="cart.php"><input type="button" name="add" value="Add to Cart"  id= "<?php echo $ID; ?>" class="button buy-now"></a>
                        
                        <div class="heart">
                        <?php
                if(isset($_SESSION["wishlist"])){
                $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
                 if(in_array($row["ID"], $item_array_id)) {?>
                <div class="star_container icon_<?php echo $row["ID"]; ?> added" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i>
                 Added to Wishlist
                </div>
                <?php } else{ ?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                Add to Wishlist
                </div>
                <?php } } else {?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                 Add to Wishlist
                </div>
                <?php } ?>
                
              </div>
                        </div> 
                        </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<?php 
 require('conn.php');
 $sql = " SELECT * FROM products WHERE ID != $ID ORDER BY RAND() LIMIT 15";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
 
 ?>
 <section>
 
<div class="container">
     <div class="heading_container heading_center">
        <h2>
          RELATED PRODUCTS
        </h2>
 </div>

<div class="related">
<div class="row">
<div class="owl-carousel owl-theme" id="product-carousel">
<?php  while($row = $result->fetch_assoc()) { ?> 

    <div class="box">
            <div class="img-box">
              <img src="<?php echo "$row[product_image]"?>" alt="">
              <a href="cart.php?action=add&id=<?php echo $row["ID"]; ?>" class="add_cart_btn">
                <span>
                <input type="submit" name="add"  class="btn btn-default" style="color:white;" value="Add to Cart">
                </span>
              </a>
            </div>
            <div class="detail-box">
                <h5>
                <a href="prodetail.php?id=<?php echo $row["ID"]; ?>"><?php echo "$row[product_name]" ?> </a>
              </h5>
              <div class="product_info">
                <h5>
                  <span>$</span> <?php echo "$row[product_price]" ?>
                </h5>
                <?php
                if(isset($_SESSION["wishlist"])){
                $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
                 if(in_array($row["ID"], $item_array_id)) {?>
                <div class="star_container icon_<?php echo $row["ID"]; ?> added" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i>
                </div>
                <?php } else{ ?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } } else {?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } ?>
              </div>
            </div>
           </div> 
          
        <?php } ?>  
        
    </div> </div>
    
</div> 
 <?php  } ?>
</div>
</div> 

 </section> 
<section>

<p> </p>
</section>
<script src="js/jquery-3.4.1.min.js"></script>
        <script>
    jQuery(document).ready(($) => {
        
    $('.quantity').on('click', '.plus', function(e) {
        let $input = $(this).prev('input.qty');
        let val = parseInt($input.val());
        if (val < 20) {
        $input.val( val+1 ).change();
       // console.log(val+1);
     } else {
        alert("Quantity out of range.")
     }
    });
  
    $('.quantity').on('click', '.minus', function(e) {
        let $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        if (val > 1) {
            $input.val( val-1 ).change();
         //  console.log(val-1);
        } 
    });
    
    $('.qty').on('change', function(e) {
        var data;
        var newVal = $(this).val();
        var id = this.id;
         $.ajax({
              type: "GET",
              dataType: "text",
              url: "cart1.php?id="+id+"&value="+newVal, 
              data: data,
              success: function(data) {
                  console.log(data);
              }
              
            });
        });
        $('.buy-now').on('click', function(e) {
        var data;
        var id = this.id;
         $.ajax({
              type: "GET",
              dataType: "text",
              url: "cart2.php?id="+id, 
              data: data,
              success: function(data) {
                  console.log(data);
              }
              
            });
        });
    }); </script>
    <script>
    jQuery(document).ready(($) => {
        
    $('.star_container').on('click',  function(e) {
          var data;
          var id = this.id;
        if($(this).hasClass("added")){
          $.ajax({
              type: "GET",
              dataType: "text",
              url: "deletewish.php?id="+id, 
              data: data,
              success: function(data) {
                console.log(data);
                //$(".star_container.icon_"+id).html(data);
                $(".star_container.icon_"+id).html('<i class="fa fa-heart-o"  aria-hidden="true" ></i>')
               
                $(".star_container.icon_"+id).removeClass('added');
              }
              
            });
        } else {
          $.ajax({
              type: "GET",
              dataType: "text",
              url: "wish.php?id="+id, 
              data: data,
              success: function(data) {
                console.log(data);
                //$(".star_container.icon_"+id).html(data);
                $(".star_container.icon_"+id).html('<i class="fa fa-heart"  aria-hidden="true" style="color:red;"></i>');
                
                $(".star_container.icon_"+id).addClass('added');
                
              }
              
            });

        }
    });
    
    });
  </script>
  
<?php include 'footer.php';?>


<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
 <script src="js/bootstrap.js"></script> 
<!-- custom js -->
<!-- <script src="js/custom.js"></script>  -->

<script src="js/owl.carousel.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  
 <script>
var owl = $('#product-carousel');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:15,
    singleItem: true,
    responsiveClass:true,
    responsive:{
                0:{
                    items: 1,
                   
                },
                200:{
                    items: 1,
                    
                },
                400:{
                    items: 2,
                    
                },
                600:{
                    items: 3,
                  
                },
                900:{
                    items: 4,
                    
                },
                1200:{
                    items: 4
                }
            }
});
  </script>

