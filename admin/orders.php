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

					<h1 class="h3 mb-3">View Orders </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <?php
                                require('conn.php');
                                if($conn === false){
                                   die("ERROR: Could not connect. "
                                      . mysqli_connect_error());
                                    }
                                    $sql1 = "SELECT * FROM orders";
                                    $result1 = $conn->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
									<table width="100%" border="2" class="table" >
                                    
                                    <tr>
                                        <th><strong>Order ID</strong></th>
                                        <th><strong>Customer Name</storng></th> 
                                        <th><strong>Grand Total</storng></th>
                                        <th><strong>Order Date</storng></th>
                                        <th><strong>Shipping Method</storng></th> 
                                        <th><strong>Payment Type</storng></th>
                                        <th><strong>Status</storng></th>
                                        <th><strong><center>View</center></storng></th>
                                        <th><strong><center>Delete</center></storng></th>
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                    <td># <?php echo $row1["ID"];?></td>
                                    <td><?php echo $row1["customer_name"];?> </td>
                                    <td>$ <?php echo $row1["grand_total"];?> </td>
                                    <td><?php echo $row1["order_date"];?> </td> 
                                    <td><?php echo $row1["shipping_method"]; ?> </td>
                                    <td><?php echo $row1["payment_type"];?> </td>
                                    <td><?php echo $row1["status"];?> </td>
                                    <td align="center"><a href='vieworder.php?id=<?php echo $row1["ID"]; ?>&user_id=<?php echo $row1["user_id"]; ?>'><i class="align-middle" data-feather="eye"></i></a></td>
                                    <td align="center"><a href='orders.php?id=<?php echo $row1["ID"]; ?>'><i class="align-middle" data-feather="trash-2"></i></a></td>
                                     </tr>
                                     <?php } ?> 
                                    </tbody>
                                    </table>
                                    <?php } 
                                     $conn->close(); ?>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>


		<?php include('footer.php'); ?>
		</div>
	</div>
    <?php
    require('conn.php');
    if($conn === false){
        die("ERROR: Could not connect. "
         . mysqli_connect_error());
    }
    if(isset($_GET['id']))
    {
    $ID = $_GET['id'];

    $sql2 = "DELETE FROM orders WHERE ID = '$ID' ";
    if(mysqli_query($conn, $sql2)){
     echo "Data Deleted Successfully<br>";} 
     else{
     echo "ERROR: Hush! Sorry $sql2. "
         . mysqli_error($conn);
     }
    }
     mysqli_close($conn);
    ?>
   

	<script src="js/app.js"></script>
