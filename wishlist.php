<?php
if(session_id() == '') {
  session_start();
} 
include 'header.php';?>


<section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
             <h2>
                   My Wishlist
             </h2>
      </div>

      <?php
      if(!isset($_GET["action"])) {
        if(isset($_SESSION["ID"])) {
        $Userid = $_SESSION["ID"];
        $sql2 ="SELECT * FROM `wishlist` WHERE userid = $Userid";
        $result2 = mysqli_query($conn,$sql2);
        
        if(mysqli_num_rows($result2) > 0){
            foreach ( $result2 as $row2 ) {
                $_SESSION["wishlist"] = unserialize($row2['wishlist_data']);
              } }
              else{
               //echo "ERROR";
               }
            } }
      if(!empty($_SESSION["wishlist"])) {
    
       ?>
      <div class="row">
        <?php    foreach($_SESSION["wishlist"] as $values) { ?>
           <div class="col-sm-6 col-lg-4 probox morebox" style="display:none;" >
           <form method="post" action="cart?action=add&id=<?php echo $values["product_id"]; ?>">
             <div class="box">
                <div class="wishlist">
                <div class="close">
               
                      <div class="close_container">
                       <a href="wishlist.php?action=delete&id=<?php echo $values["product_id"]; ?>"> <i class="fa fa-times" aria-hidden="true"></i> </a>
                      </div>

                 </div>
                <div class="img-box" >
                <img src="<?php echo  $values['product_image']; ?>" alt="">
                <a href="cart?action=add&id=<?php echo $values["product_id"]; ?>" class="add_cart_btn">
                      <span>
                      <input type="submit" name="add"  class="btn btn-default" style="color:white;" value="Add to Cart">
                      </span>
                    </a>
                    
                </div>
                <div class="detail-box">
                <h5>
                <a href="prodetail.php?id=<?php echo $values["product_id"]; ?>"><?php echo $values["product_name"]; ?> </a>
                </h5>
                  <div class="product_info">
                    <h5>
                        <span>$</span> <?php echo $values["product_price"]; ?>
                    </h5>
                     
                  </div>
                </div>
                </div>
             </div> </form>
          </div> 
          <?php } ?>
        </div>
      <?php }else{ ?>
          <div class="empty">Your wishlist is Empty!! <br>
            <img src="images/crying-penstand.jpg" width="210px" height="260px"> <br>
            <button class="shop-btn"><a href="product.php"> Continue Shopping</a></button>
          </div>
       <?php  }  ?>
       
    </div>
  </section>

  <?php include 'footer.php';?>
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
                       $ID = $row["ID"];
    
               }}
              
              $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
              if(!in_array($ID, $item_array_id)) {

                  
                   $count = count($_SESSION["wishlist"]);
                   
                   $item_array = array(
                       'product_id' => $ID,
                       'product_name' => $name,
                       'product_price' => $price,
                       'item_quantity' => $quantity,
                       'product_image' => $image
                   ); 
                   $_SESSION["wishlist"][$count] = $item_array;
                  echo '<script>window.location="wishlist.php"</script>';
               } 
               else {
                   echo '<script>alert("Products already added to wishlist")</script>';
                   echo '<script>window.location="wishlist.php"</script>';
               }
          //  } else {
          //          $item_array = array(
          //              'product_id' => $ID,
          //              'item_name' => $name,
          //              'product_price' => $price,
          //              'item_quantity' => $quantity,
          //              'product_image' => $image
          //          );
          //          $_SESSION["wishlist"][0] = $item_array;
          //  }
       }
    }      
       if(isset($_GET["action"])) {
           if($_GET["action"] == "delete") {
               foreach($_SESSION["wishlist"] as $keys => $values) {
                   if($values["product_id"] == $_GET["id"]) {
                       unset($_SESSION["wishlist"][$keys]);
                      //  echo '<script>alert("Product has been removed")</script>';
                       echo '<script>window.location="wishlist.php"</script>';
                       $_SESSION["wishlist"] = array_merge($_SESSION["wishlist"]); 
            
                   }
               }
           }
       }
      // print_r($_SESSION["wishlist"]);

      require('conn.php');
// Check connection
if($conn === false){
die("ERROR: Could not connect. "    . mysqli_connect_error());
}
if(isset($_SESSION["wishlist"])) {
  if(isset($_SESSION["ID"])) {
$Userid = $_SESSION["ID"];
$Wishlist = $_SESSION["wishlist"];
//print_r($_SESSION["wishlist"]);
$Data = serialize($Wishlist);
    
$sql2 ="SELECT * FROM `wishlist` WHERE userid = $Userid";
$result = mysqli_query($conn,$sql2);
if(mysqli_num_rows($result) > 0){
   $sql1= "UPDATE `wishlist` SET `wishlist_data`= '$Data' WHERE `wishlist`.`userid`='$Userid'";
  if(mysqli_query($conn,$sql1)){
    // echo "ok";
  }
  else{echo "ERROR: Hush! Sorry $sql1."    . mysqli_error($conn);}
}
else{
  $sql = "INSERT INTO `wishlist`(`ID`, `userid`, `wishlist_data`) VALUES (NULL,'$Userid','$Data')"; 
      if(mysqli_query($conn, $sql)){ 
        // echo "Inserted";
     }   
     else{     echo "ERROR: Hush! Sorry $sql." . mysqli_error($conn); }  
}
} }
  ?>
  
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
 <script src="js/bootstrap.js"></script> 
<!-- custom js -->
<script src="js/custom.js"></script> 
<script src="js/more.js"></script>

