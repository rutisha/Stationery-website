<?php
if(session_id() == '') {
  session_start();
} 
 include "header.php" ?>
<section class="padding">
<div class="container1">

  <div class="sidebar">
  <ul>
       <a href="myaccount">
      <li style="--clr: #2f4aab"> 
      <i class="fa fa-address-card-o" aria-hidden="true"></i>
        <span>Edit Profile</span> 
      </li> </a>
      <a href="order_history">
      <li style="--clr: #f1cc52">
      <i class="fa fa-history" aria-hidden="true"></i>
        <span>Order History</span>
      </li> </a>
      <a href="address_book">
      <li style="--clr: #2f4aab">
      <i class="fa fa-address-book-o" aria-hidden="true"></i>
        <span>Address Book</span>
      </li> </a>
      <a href="wishlist">
      <li style="--clr: #f1cc52 ">
      <i class="fa fa-heart" aria-hidden="true"></i>
        <span>Wishlist</span>
      </li> </a>
    </ul>
  </div>
  <div class="profile">
    <h2>Ordered Products</h2>
    <br>
    <div class="row">
        <div class="card-2">
    <?php
                                require('conn.php');
                                if($conn === false){
                                   die("ERROR: Could not connect. "
                                      . mysqli_connect_error());
                                    }
                                    $ID = $_SESSION["ID"];
                                    $sql1 = "SELECT * FROM `order_line_items` WHERE `user_id`= '$ID'";
                                    $result1 = $conn1->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
								                	<table  class="tbl2" >
                                    
                                    <tr>
                                        <th><strong>Sr No.</storng></th>
                                        <th><strong>Product Image</storng></th>
                                        <th><strong>Product Name</storng></th>
                                        <th><strong>Quantity</storng></th>
                                        <th><strong>Subtotal</storng></th>
                                        
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                    <td class="counterCell">]</td>
                                    <td><img class="img_fluid" src="./admin/static/<?php echo $row1["product_img"]; ?>"></td>
                                    <td><?php echo $row1["product_name"]; ?> </td>
                                    <td><?php echo $row1["quantity"]; ?> pc</td>
                                    <td>Rs <?php echo $row1["sub_total"]; ?></td>
                                     </tr>
                                     <?php } ?> 
                                    </tbody>
                                    </table>
                                    <?php } 
                                     $conn1->close(); ?>
                                     <?php
                                 require('conn.php');
                                  if($conn === false){
                                   die("ERROR: Could not connect. "
                                      . mysqli_connect_error());
                                    }
                                    $ID = $_SESSION["ID"];
                                    $sql1 = "SELECT * FROM `orders` WHERE `user_id`= '$ID' ";
                                    $result1 = $conn->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
                                     <table class="tbl3">
                                     <tr>
                                        <th><strong></storng></th>
                                        <th><strong></storng></th>
                                        <th><strong></storng></th>
                                        <th><strong></storng></th>
                                        <th><strong></storng></th>
                                    </tr>
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                        <td><b>Grand Total :</b></td>
                                        <td>Rs <?php echo $row1["grand_total"]; ?></td>
                                    
                                     </tr>
                                     <tr>
                                        <td><b>Shipping Method :</b></td>
                                        <td><?php echo $row1["shipping_method"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Payment Type :</b></td>
                                        <td><?php echo $row1["payment_type"]; ?></td>
                                    
                                     </tr>
                                     <?php } ?> 
                                    </tbody>
                                    <?php } 
                                     $conn1->close(); ?>
                                    </table>
                                    <?php
                                  require('conn.php');
                                  if($conn === false){
                                   die("ERROR: Could not connect. "
                                      . mysqli_connect_error());
                                    }
                                    $ID = $_SESSION["ID"];
                                    $sql1 = "SELECT * FROM `order_meta` WHERE `user_id` = '$ID'";
                                    $result1 = $conn1->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                        while($row1 = $result1->fetch_assoc()) { 
                                ?>
                                    <div class="addr">
                                    <h5><b>Billing Address :</b></h5>
                                    <p><?php echo $row1["address"]; ?>,</p>
                                    <p><?php echo $row1["address2"]; ?>,</p>
                                    <p><?php echo $row1["city"]; ?> - <?php echo $row1["postcode"]; ?></p>
                                    <p><?php echo $row1["state"]; ?></p>
                                    <p><?php echo $row1["country"]; ?></p>
                                    <p>Contact No.- <?php echo $row1["phone"]; ?></p>
                                        </div>
                                    <?php } } ?>
								</div>
								
         </div>
 </div>
</div>
</section>      

<?php include "footer.php" ?>
<script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>