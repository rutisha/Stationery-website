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
    <h2>Order History</h2> 
    <div class="row">
		
                        <?php
                                require('conn.php');
                                if($conn1 === false){
                                   die("ERROR: Could not connect. "
                                      . mysqli_connect_error());
                                    }
                                    $ID = $_SESSION["ID"];
                                    $sql1 = "SELECT * FROM orders WHERE user_id = '$ID'";
                                    $result1 = $conn1->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
									                <table  border="2" class="table1" >
                                    
                                    <tr>
                                        <th><strong>Sr No.</storng></th>
                                        <th><strong>Order ID</storng></th>
                                        <th><strong>Grand Total</storng></th>
                                        <th><strong>Order Date</storng></th>
                                        <th><strong>Shipping Method</storng></th>
                                        <th><strong>Payment Type</storng></th>
                                        <th><strong>Status</storng></th>
                                        <th><strong>Action</storng></th>
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                    <td class="counterCell">]</td>
                                    <td># <?php echo $row1["ID"]; ?></td>
                                    <td>Rs <?php echo $row1["grand_total"];?> </td>
                                    <td><?php echo $row1["order_date"];?> </td>
                                    <td><?php echo $row1["shipping_method"];?> </td>
                                    <td><?php echo $row1["payment_type"];?> </td>
                                    <td><?php echo $row1["status"];?> </td>
                                    <td align="center"><a href='ordered_product'><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
                                     </tr>
                                     <?php } ?> 
                                    </tbody>
                                    </table>
                                    <?php } else { ?> 
                                     &nbsp&nbsp<h6>You have not order anything yet...&nbsp <img src="images/emoji.jpg" width="35px" height="40px"></h6>
                                    <?php }
                                     $conn1->close(); ?>
								</div>
								<div class="card-body">
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