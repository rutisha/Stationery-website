<?php
if(session_id() == '') {
  session_start();
} 
include "header.php"; ?>
<section class="layout_padding">
 <div class="container_chk">
  <div class="chk-title">
      <h2>Checkout Form</h2> 
  </div>
  <div class="row">
    <div class="col-md-7">
<div class="d-flex">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  name="myform" >
    <label class="entry">
      <span class="fname">First Name:<span class="required">*</span></span>
      <input type="text" name="fname" id="fname" required>
    </label>
    <label class="entry">
      <span class="lname">Last Name: <span class="required">*</span></span>
      <input type="text" name="lname" id="lname" required> 
    </label>
    <label class="entry">
      <span>Country: <span class="required">*</span></span>
      <select name="selection">
        <option value="select">Select a country...</option>
        <option value="India">Canada</option>
      </select>
    </label>
    <label class="entry">
      <span>State:<span class="required">*</span></span>
      <input type="text" name="state" id="state" required> 
    </label>
    <label class="entry">
      <span>Street Address: <span class="required">*</span></span>
      <input type="text" name="houseadd" id="houseadd" placeholder="Address" required>
    </label>
    <label class="entry">
      <span></span>
      <input type="text" name="apartment" id="apartment" placeholder="Apartment, suite etc.">
    </label>
    <label class="entry">
      <span>Town / City: <span class="required">*</span></span>
      <input type="text" name="city" id="city" required> 
    </label>
    <label class="entry">
      <span>Postcode: <span class="required">*</span></span>
      <input type="text" name="pin" id="pin" inputmode="numeric" maxlength="6" required> 
    </label>
    <label class="entry">
      <span>Phone: <span class="required">*</span></span>
      <input type="number" name="num" id="num" maxlength="10"  required> 
    </label>
    <div class="back-to-shop"><a href="cart"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp <span class="text-muted">Back To Cart</span></div></a>
        
     </div>
    </div>
 <div class="col-md-5" >
 <?php 
 require('conn.php');
// Check connection
if($conn === false){
die("ERROR: Could not connect. "    . mysqli_connect_error());
}
if(isset($_SESSION["ID"])) {
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
else{
  $sql = "INSERT INTO `cart`(`ID`, `userid`, `cart_data`) VALUES (NULL,'$Userid','$String')"; 
      if(mysqli_query($conn, $sql)){ 
       //  echo "Inserted";
     }   
     else{     echo "ERROR: Hush! Sorry $sql." . mysqli_error($conn); }  
}
}

 ?>
  <div class="Yorder">
  <?php
        if(!empty($_SESSION["ID"])){
        $Userid = $_SESSION["ID"];
        $sql2 ="SELECT * FROM `cart` WHERE userid = $Userid";
        $result2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result2) > 0){
            foreach ( $result2 as $row2 ) {
                $_SESSION["cart"] = unserialize($row2['cart_data']);
              } }
              else{
               //echo "ERROR";
               }} else{
                //echo "<center><b>Not Found</b></center>";
              }
     
      if(!empty($_SESSION["cart"])) {
       
      $total = 0;
      
       ?>
     
    <table>
      <tr>
        <th colspan="2"><center><h4>Your order</h4></center></th>
      </tr>
      <?php foreach($_SESSION["cart"] as $values) {
      ?>
      <tr>
        <td><img class="img_fluid" src="<?php echo $values['product_image']; ?>">&nbsp;<?php echo $values["product_name"]; ?> x <?php echo $values["item_quantity"];?>pc</td>
        <td>$ <?php echo ($values["product_price"] * $values["item_quantity"]);?> </td>
      </tr>
      <?php $total = $total + ($values["item_quantity"] * $values["product_price"]); }  ?>
      
      <tr>
      <td>Sub Total:</td>
       <td>$ <?php echo $total; ?></td>
      </tr> 
  
      <?php if($values["percent"] != 0) { ?>
      <tr>
      <td>Discount: <?php echo $values["discount"]; ?></td>
       <td>-<?php echo $values["percent"] ?>%</td>
      </tr>
      <?php } ?>

      <tr>
      <td>Shipping Charge : </td>
        <td><?php if($total<150){ echo "$ 10";} else {echo "Free Delivery"; }?></td>
        
      </tr>
      <?php  $Percent = $values["percent"];
             $sum = $total;
            $sum = $sum - (($sum/100)*$Percent); ?>
      <tr>
      <td>Grand Total :</td>
        <td>$ 
          <?php if($total<50) 
               { $Grand_Total = $total + 10; 
               echo $Grand_Total;  } 
               else {
               echo round($sum); } ?>
              
        </td>
      </tr>  
      <tr>
        <td>Payment Method : </td>
        <td>Cash on Delivery </td>
      </tr>
    </table><br>
     <?php } else {  }?>
    </div> <br>
    <a href="thankyou.php"><input type="submit" class="plc" name="Submit" value="Submit" id="Submit" onClick="myFunction()"></a> <br><br>
    <?php
     
     if($conn === false){
         die("ERROR: Could not connect. "
             . mysqli_connect_error());
     }
     
     if(isset($_POST['Submit'])){

     $First_Name = $_REQUEST['fname'];
     $Last_Name = $_REQUEST['lname'];
     $Country = $_REQUEST['selection'];
     $State = $_REQUEST['state'];
     $Address = $_REQUEST['houseadd'];
     $Address2 = $_REQUEST['apartment'];
     $City =$_REQUEST['city'];
     $Postcode = $_REQUEST['pin'];
     $Phone = $_REQUEST['num'];
     if(!empty($_SESSION["cart"])) {
      $total = 0;
      foreach($_SESSION["cart"] as $values) { 

        $total = $total + ($values["item_quantity"] * $values["product_price"]); 
        }
        $Percent = $values["percent"];
        $sum = $total;
        $sum = $sum - (($sum/100)*$Percent);
        if($total<50) 
               { $Grand_Total = $total + 10; 
                } 
               else {
               $Grand_Total = round($sum); 
              }
      }

         if(isset($_SESSION['uname'])) {
      $Customer_name = $_SESSION['uname'];
      $ID = $_SESSION['ID'];
     } else{
      $Customer_name = $_REQUEST['fname'];
      $ID = '0';
     }

    $sql = "INSERT INTO `order_meta`(`ID`,`user_id`, `first_name`, `last_name`, `country`, `state`, `address`, `address2`, `city`, `postcode`, `phone`) 
     VALUES (NULL,'$ID','$First_Name','$Last_Name','$Country','$State','$Address','$Address2','$City','$Postcode','$Phone')";

    $sql1 = "INSERT INTO `orders`(`ID`, `user_id`,`customer_name`, `grand_total`, `order_date`, `shipping_method`, `payment_type`, `status`) 
    VALUES (NULL,'$ID','$Customer_name','$Grand_Total',CURRENT_TIMESTAMP,'Standard','COD','Pending')";

          if(mysqli_query($conn, $sql)){ 
                      //  echo "Done";
          }   
          else{
                echo "ERROR: Hush! Sorry $sql." . mysqli_error($conn);
          } 
          if(mysqli_query($conn, $sql1)){ 
                // echo "Done1";
          }   
          else {
           echo "ERROR: Hush! Sorry $sql1.". mysqli_error($conn);
          } 
    
  

    if(!empty($_SESSION["cart"])) {
      foreach($_SESSION["cart"] as $values) { 
        $Product_id = $values['product_id']; 
        $Product_image = $values['product_image']; 
        if(isset($_SESSION['uname'])) {
          $Customer_name = $_SESSION['uname'];
          $ID = $_SESSION['ID'];
          $q = "SELECT * FROM `orders` WHERE `customer_name` = '$Customer_name' ";  
         } else{
          $Customer_name = $_REQUEST['fname'];
          $ID = '0';
          $q = "SELECT * FROM `orders` WHERE `customer_name` = '$Customer_name' ";  
         }
   
     
      $result1 = $conn->query($q); 
      if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
        $_SESSION['orderid'] = $row1["ID"];
        $Order_id = $_SESSION["orderid"]; 
        
        $Product_name = $values['product_name'];
        $Quantity = $values['item_quantity'];
        $Sub_Total = $values["product_price"] * $values["item_quantity"];
         
        $sql2 = "INSERT INTO `order_line_items`(`ID`,`user_id`, `product_id`, `order_id`, `product_img`, `product_name`, `quantity`, `sub_total`)
        VALUES (NULL,'$ID','$Product_id','$Order_id','$Product_image','$Product_name','$Quantity','$Sub_Total')";  

        if(mysqli_query($conn, $sql2)){ 
               // echo "Done2";
        } 
         else {
            echo "ERROR: Hush! Sorry $sql2." . mysqli_error($conn);
          } } } ?>

          <script>
           window.location.href="thankyou.php";
          </script>

       <?php }}
       }
        
    mysqli_close($conn);


      ?>

        </div>
    </div>
 </div>
</div> 
        </section>
       
 <?php include "footer.php" ?>

