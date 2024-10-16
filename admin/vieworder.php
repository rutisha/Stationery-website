<?php  
session_start(); 
  
?>  

<?php  if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  ?>

    <?php include('header.php'); ?>
            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">View Order Details </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <?php
                                require('conn.php');
                                    $OrderId = $_GET["id"];
                                    $sql1 = "SELECT * FROM `order_line_items` WHERE `order_id`= '$OrderId' ";
                                    $result1 = $conn->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
									<table width="100%" class="table2" >
                                    
                                    <tr>
                                        <th><strong>Order ID</strong></th>
                                        <th><strong>Product Image</storng></th> 
                                        <th><strong>Product Name</storng></th>
                                        <th><strong>Quantity</storng></th>
                                        <th><strong>Sub Total</storng></th> 
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                    <td># <?php echo $row1["order_id"];?></td>
                                    <td><img src="<?php echo $row1["product_img"];?>" width="60px" height="70px"> </td>
                                    <td><?php echo $row1["product_name"];?> </td>
                                    <td><?php echo $row1["quantity"];?> pc</td> 
                                    <td>Rs <?php echo $row1["sub_total"]; ?> </td>
                                    </tr>
                                     <?php } ?> 
                                    </tbody>
                                    <tr>
                                    <?php
                                         $ID = $_GET["id"];
                                         require('conn.php');
                                         $sql = "SELECT * FROM `orders` WHERE ID = '$ID'";
                                         $result = $conn->query($sql);
                                         $row = mysqli_fetch_array($result); ?>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                         <td><b>TOTAL :</b></td>
                                        <td> <label><b>  $  <?php echo "$row[grand_total]"?></b></label></td>
                                    </tr>
                                    </table>
                                    <?php } 
                                     $conn1->close(); ?>
                            
                                     <div class="address">
                                     <?php
                                         $User_ID = $_GET["user_id"];
                                         require('conn.php');
                                         $sql = "SELECT * FROM `order_meta` WHERE user_id = '$User_ID'";
                                         $result = $conn->query($sql);
                                         $row = mysqli_fetch_array($result); ?>
                                         <h3 class="h3 mb-3">Shipping Details </h3>
                                        <label><b>First Name:</b></label>  <?php echo "$row[first_name]" ?><br>
                                        <label><b>Last Name:</b></label>  <?php echo "$row[last_name]" ?><br>
                                        <label><b>Country:</b></label> <?php echo "$row[country]" ?><br>
                                        <label><b>State:</b></label>  <?php echo "$row[state]" ?> <br> 
                                        <label><b>Address Line 1:</b></label> <?php echo "$row[address]" ?><br>
                                        <label><b>Address Line 2:</b></label> <?php echo "$row[address2]" ?> <br>
                                        <label><b>City:</b></label> <?php echo "$row[city]" ?> <br>
                                        <label><b>Postcode:</b></label> <?php echo "$row[postcode]" ?><br>
                                        <label><b>Contact No.:</b></label> <?php echo "$row[phone]" ?> <br>

                                    </div>
                                </div>
                                    <div class="delivery">
                                    <?php
                                         $ID = $_GET["id"];
                                         require('conn.php');
                                         $sql = "SELECT * FROM `orders` WHERE ID = '$ID'";
                                         $result = $conn->query($sql);
                                         $row = mysqli_fetch_array($result); ?>
                                           <form action="" method="POST" enctype="multipart/form-data">
                                          <!-- <label id="name"><b> Grand Total:</b>  Rs  <?php echo "$row[grand_total]"?></label> <br><br><br> -->
                                          <h3 class="h3 mb-3">Delivery Details </h3> <br>
                                          <label ><b>Shipping Method:</b></label>  
                                          <label id="space"><b>Payment Type:</b></label> <br>
                                          <input type="text" name="method" id="price" value="<?php echo "$row[shipping_method]"?>"required >&nbsp&nbsp&emsp;&emsp;&emsp;
                                          <input type="text" name="pay_type" id="price" value="<?php echo "$row[payment_type]"?>"required ><br><br>

                                          <label><b>Status:</b></label> <br>
                                          <?php $selectedtype = $row["status"]; ?>
                                          <select name="status" id="price">
                                         <option value="Pending" <?php if($selectedtype == 'Pending') { echo "selected"; } ?>>Pending</option>
                                         <option value="Shipped" <?php if($selectedtype == 'Shipped') { echo "selected"; } ?>>Shipped</option>
                                         <option value="Complete" <?php if($selectedtype == 'Complete') { echo "selected"; } ?>>Complete</option>
                                         <option value="Cancelled"<?php if($selectedtype == 'Cancelled') { echo "selected"; } ?>>Cancelled</option>
                                         <option value="Refunded" <?php if($selectedtype == 'Refunded') { echo "selected"; } ?>>Refunded</option>
                                         </select><br><br>
                                     
                                    <input type="submit" id="submit" name="Submit" value="Submit">
                                    </form>


                                    <div>
								
								<div class="card-body">
								</div>
							</div>
                            
						</div>
                        
					</div>
                    <a href="orders.php"><button id="back"><i class="align-middle" data-feather="corner-up-left"></i> Back</button></a>
				</div>
			</main>


		<?php include('footer.php'); ?>
        <?php
    require('conn.php');
             
    if(isset($_POST['Submit'])){

     $ID = $_GET['id'];
     $Shipping_method = $_REQUEST['method'];
     $Payment_type = $_REQUEST['pay_type'];
     $Status = $_REQUEST['status'];
     $sql = "UPDATE `orders` SET `shipping_method`= '$Shipping_method',`payment_type`= '$Payment_type',`status`= '$Status' WHERE `orders`.`ID`='$ID' ";
        
    if(mysqli_query($conn, $sql)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn); }
    } 
     mysqli_close($conn);
     
    ?>
		</div>
	</div>
	<script src="js/app.js"></script>
