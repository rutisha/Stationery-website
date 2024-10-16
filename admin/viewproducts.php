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

					<h1 class="h3 mb-3">View Products</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <?php
                                require('conn.php');
                                    $sql = "SELECT * FROM products";
                                    $result = $conn->query($sql); 
                                    if ($result->num_rows > 0) {
                                ?>
									<table width="100%" border="1" style="border-collapse:collapse;" class="table" >
                                    
                                    <tr>
                                        <th><strong>Sr No.</strong></th>
                                        <th><strong>Product Name</storng></th>
                                        <th><strong>Product Price</storng></th>
                                        <th><strong>Product Quantity<strong></th>
                                        <th><strong>Product Image<strong></th>
                                        <th><strong>Product Description<strong></th>
                                        <th><strong>Edit<strong></th>
                                        <th><strong>Delete<strong></th>
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                    <td><?php echo $row["ID"];?></td>
                                    <td><?php echo $row["product_name"];?> </td>
                                    <td><?php echo $row["product_price"];?> </td>
                                    <td><?php echo $row["product_qty"];?> </td>
                                    <td><?php echo "<img width='80px' height='70px'  src='../".$row['product_image']."' >";?> </td>
                                    <td><?php echo $row["description"];?> </td>
                                    <td align="center"><a href='editproducts.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="edit"></i></a></td>
                                    <td align="center"><a href='viewproducts.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="trash-2"></i></a></td>
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
    if(isset($_GET['id']))
    {
    $ID = $_GET['id'];

    $sql1 = "DELETE FROM products WHERE ID = '$ID' ";
    if(mysqli_query($conn, $sql1)){
     echo "Data Deleted Successfully<br>";} 
     else{
     echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
     }
    }
     mysqli_close($conn);
    ?>

	<script src="js/app.js"></script>
