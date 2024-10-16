<?php
if(session_id() == '') {
    session_start();
  } 
  

 include 'header.php';?>

<section class="layout_padding">
<div class="heading_container heading_center">
        <h2>
          Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </h2>
      </div> 
      <?php
      require('conn.php');
      if($conn == false){
      die("ERROR: Could not connect. "    . mysqli_connect_error());
      }
      if(isset($_SESSION['cart'])){
        if(isset($_SESSION['ID'])) {
      $Userid = $_SESSION["ID"];
      $Cart = $_SESSION["cart"];
      $String = serialize($Cart);
          
      $sql2 ="SELECT * FROM `cart` WHERE userid = $Userid";
      $result = mysqli_query($conn,$sql2);
      if(mysqli_num_rows($result) > 0){
         $sql1= "UPDATE `cart` SET `cart_data`= '$String' WHERE `cart`.`userid`='$Userid'";
        if(mysqli_query($conn,$sql1)){
          // echo "ok";
        }
        else{echo "ERROR: Hush! Sorry $sql1."    . mysqli_error($conn);} 
      }
      else{ }  } }
      
       if(!isset($_GET["action"])) {
         if(isset($_SESSION["ID"])) {
           $Userid = $_SESSION["ID"];
           $sql2 ="SELECT * FROM `cart` WHERE userid = $Userid";
           $result2 = mysqli_query($conn,$sql2);

        if(mysqli_num_rows($result2) > 0){
            foreach ( $result2 as $row2 ) {
                $_SESSION["cart"] = unserialize($row2['cart_data']);
              } }
              else{
               //echo "ERROR";
               }
        } }
      if(!empty($_SESSION["cart"])) {
       
      $total = 0;
       ?>
     
<div class="card-1">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Cart Items</b></h4></div>
                            <div class="col align-self-center text-right text-muted"><?php echo count($_SESSION["cart"]); ?> items</div>
                        </div>
                    </div> 
                    <div class="row">
                           <div class="subtitle">Image</div>
                          <div class="subtitle">Product Name</div> 
                          <div class="subtitle">Quantity</div>
                          <div class="subtitle">Price</div>
                          <div class="subtitle">Subtotal</div>
                          <div class="subtitle"></div>
                       </div>  
                    <div class="box"> 
                     
                    <div class="row border-top border-bottom">
                    <?php
                    foreach($_SESSION["cart"] as $values) {
                                     ?>
                        <div class="row main align-items-center">
                            <div class="combo">
                             <div class="line">
                            <div class="pic"><img class="img_fluid" src="<?php echo $values['product_image']; ?>"></div>
                            <div class="pro_name">
                                <a href="prodetail.php?id=<?php echo $values["product_id"]; ?>"><?php echo $values["product_name"]; ?></a>
                            </div> 
                            <div class="myform">

                            <form id='myform' method='POST' class='quantity' >
                            <input type='button' value='-' class='qtyminus minus' field='quantity' />
                            <input type='text' name="qnty"  id= "<?php echo $values["product_id"] ?>" value='<?php echo $values["item_quantity"]?>' class='qty'/>
                            <input type='button' value='+' class='qtyplus plus' field='quantity' />
                            </form>

                            </div> </div>

                            <div class="line2">
                            
                            <span class="hide">Price:</span><div>$ <?php echo $values["product_price"];?> </div>
                           
                            <span class="hide">Subtotal:</span><div  id="subtotal_<?php echo $values['product_id']; ?>">$ <?php echo ($values["product_price"] * $values["item_quantity"]);?> </div>
                           
                             <div><span ><a href="cart.php?action=delete&id=<?php echo $values["product_id"]; ?>" class="close">
                            <i class="fa fa-window-close" aria-hidden="true"></i> </a>
                          </span></div>
                          </div> </div>
  
                            
                          </div> <?php   $total = $total + ($values["item_quantity"] * $values["product_price"]);       } ?>
                    </div>
      
        
                    <div class="back-to-shop"><a href="product.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp <span class="text-muted">Continue Shopping</span></div></a>
                </div>
               </div>
               
                <div class="col-md-4 summary" id="box-1">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:15px;"><?php echo count($_SESSION["cart"]); ?> ITEMS</div>
                        $<div id="total"> <?php echo $total ?></div>
                    </div>
                       
                    <div id="delivery">
                       <?php if($total<150) { ?>
                               <br> <p>* Minimum order of $ 50 is required for free delivery *</p>
                              <input type="radio" id="free" name="free_delivery" value="free_delivery" checked = true>
                              <label id="delivery">Delivery Charge-$ 10</label><br><br>

                         <?php  } else { ?>
                                 <input type="radio" id="charge" name="delivery" value="delivery_charge" checked = true>
                                  <label>Free Delivery</label><br><br>

                           <?php } ?> </div> 
                         
                        <div class="discount">
                         <p>DISCOUNT CODE: </p> 
                       
                        <input id="code" name= "code"  placeholder="Enter your code">
                        <button class="apply-btn" type="button">Apply Code</button>
                        <div id="display"></div>
                         </div>
                        
                    
                    <div class="row del_show" style="border-top: 2px solid rgba(0,0,0,.1); padding: 2vh 0;margin-top:20px;">
                    <?php if($total<50) { ?>
                          <div class="col">Delivery Charge: </div>
                          <div class="del_display"> <?php  echo "+ $ 10"; ?> </div>
                    <?php  } else {} ?>
                     </div>

                    <div class="row code_show">
                    <?php if($values["percent"] != 0) { ?>
                    <div class="col">Discount: <?php echo $values["discount"]; ?>  </div>
                    <div class="del_display">- <?php  echo  $values["percent"];  ?>% </div>
                    <button class="remove-btn" id="remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <div id="myModal" class="modal">
                         <div class="modal-content">
                         <span class="cancel">x</span>
                           <p>Are you really want to remove discount code?</p>
                           <div class="button">
                           <button class="btn-1">Yes</button>
                           <button class="btn-2">No</button>
                          </div>
                           </div>
                    </div>
                    <?php } ?>
                    </div> <br>

                   <div class="row">
                    <div class="col">TOTAL PRICE</div>
                        $ <div  id="total1">
                        <?php if($total<50) { ?>
                             <?php echo $total + 10 ?>
                            <?php  } else { 
                                $sum = $total;
                                if($values["percent"]!= 0){
                                    $Percent = $values["percent"];
                                    $sum = $sum - (($sum/100)*$Percent); 
                                    echo $sum; } 
                                else {  echo $sum; } ?>
                            <?php } ?>
                        </div>
                    </div>
                   <div class="checkout"> <a href="checkout.php"><button class="chk-btn">CHECKOUT</button></a> </div> 
                </div> 
            </div>
                      
        </div> 
        <?php } else{ ?>
          <div class="empty">Your cart is Empty!! <br>
            <img src="images/crying-pencil.jpg" width="280px" height="280px"> <br>
            <button class="shop-btn"><a href="product"> Continue Shopping</a></button>
          </div>
       <?php  }  ?>
        </section>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script>
    jQuery(document).ready(($) => {
        
    $('.quantity').on('click', '.plus', function(e) {
        let $input = $(this).prev('input.qty');
        let val = parseInt($input.val());
        if (val < 10) {
        $input.val( val+1 ).change();
      // var test = console.log(val+1);
     } else {
        alert("Quantity out of range.")
     }
    });
  
    $('.quantity').on('click', '.minus', function(e) {
        let $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        if (val > 1) {
            $input.val( val-1 ).change();
           // var test = console.log(val-1);
        } 
    });
    
    $('.qty').on('change', function(e) {
        var data;
        var newVal = $(this).val();
        var id = this.id;
         $.ajax({
              type: "GET",
              dataType: "text",
              url: "shop.php?id="+id+"&value="+newVal, 
              data: data,
              success: function(data) {
                 // console.log(data);
                 //  $("#subtotal").html(data);
              }
              
            });
            $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "subtotal_edit.php?id="+id+"&value="+newVal, 
               data: data,
               success: function(result) {
                    //console.log(result);
                    $("#subtotal_"+id).html(result);
                }
            });
            $.ajax({ 
                type: "GET",
                dataType: "text",
                url: "total_edit.php?id="+id+"&value="+newVal, 
                data: data,
                success: function(result) {
                        console.log(result);
                        $("#total").html(result);
                }
            });
            $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "shop.php?id="+id+"&value="+newVal, 
               data: data,
               success: function(result) {
                  console.log(result);
                  $("#total1").html(result);
                }
            });
            $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "shipping.php?id="+id+"&value="+newVal, 
               data: data,
               success: function(result) {
                  console.log(result);
                  $("#delivery").html(result);
                }
            });
            $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "display_del.php?id="+id+"&value="+newVal, 
               data: data,
               success: function(result) {
                  console.log(result);
                  $(".del_show").html(result);
                }
            });

        });
        $('.apply-btn').on('click', function(e) {
            var data;
            var sum = $('#total').text();
           var code = $('#code').val();
           var id = this.id;
           $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "code.php?id="+id+"&code="+code+"&sum="+sum, 
               data: data,
               success: function(result) {
                var $data = $(result).filter(".text").html();
                var $sub =  $(result).filter("#sum").html();
                var $del =  $(result).filter(".deliv").html();
                  $("#total1").html($sub);
                 $("#display").html($data);
                 $(".code_show").html($del);
                 
                }
            });
            
        });
        $('.btn-1').on('click', function(e) {

            var data;
            var sum = $('#total').text();
           var code = $('#code').val();
           var id = this.id;
           $.ajax({ 
               type: "GET",
               dataType: "text",
               url: "remove_dis.php?id="+id+"&code="+code+"&sum="+sum, 
               data: data,
               success: function(result) {
                 console.log(result);
                 var $del =  $(result).filter(".deliv").html();
                 $(".code_show").html($del);
               }
            });
            window.location="cart";
        });
        

    });
     </script> 
  <?php
   include 'footer.php';?>

<?php     
 if(isset($_GET["action"])) {
        if($_GET["action"] == "add") {
          
            $ID = $_GET["id"];
            require('conn.php');
            $sql = "SELECT * FROM `products` WHERE ID = $ID";
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                       $name = "$row[product_name]";
                       $image = "$row[product_image]";
                       $price = "$row[product_price]";
                       $quantity = "1";
                       $code = "";
                       $percent = "0";
                       $ID = $row["ID"];
    
               }}
              
              $item_array_id = array_column($_SESSION["cart"], 'product_id'); 
              if(!in_array($ID, $item_array_id)) {

                  
                   $count = count($_SESSION["cart"]);
                   
                   $item_array = array(
                       'product_id' => $ID,
                       'product_name' => $name,
                       'product_price' => $price,
                       'item_quantity' => $quantity,
                       'discount' => $code,
                       'percent' => $percent,
                       'product_image' => $image
                   ); 
                   $_SESSION["cart"][$count] = $item_array;
                  echo '<script>window.location="cart.php"</script>';
               } 
               else {
                   echo '<script>alert("Products already added to cart")</script>';
                   echo '<script>window.location="cart.php"</script>';
               }
        //    } else {
        //            $item_array = array(
        //                'product_id' => $ID,
        //                'item_name' => $name,
        //                'product_price' => $price,
        //                'item_quantity' => $quantity,
        //                'percent' => $percent,
        //                'discount' => $code,
        //                'product_image' => $image
        //            );
        //            $_SESSION["cart"][0] = $item_array;
        //    }
       }
    }      
       if(isset($_GET["action"])) {
           if($_GET["action"] == "delete") {
               foreach($_SESSION["cart"] as $keys => $values) {
                   if($values["product_id"] == $_GET["id"]) {
                       unset($_SESSION["cart"][$keys]);
                      //  echo '<script>alert("Product has been removed")</script>';
                       echo '<script>window.location="cart.php"</script>';
                       $_SESSION["cart"] = array_merge($_SESSION["cart"]); 
                   }
               }
           }
       }
      // print_r($_SESSION["cart"]);

      
    
  ?>
  
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<script>
    var modal = document.getElementById('myModal');
var btn = document.getElementById("remove");
var span = document.getElementsByClassName("cancel")[0];
var close = document.getElementsByClassName("btn-2")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
close.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
