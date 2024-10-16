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

					<h1 class="h3 mb-3"><strong>Analytics Dashboard</storng></h1>

					
								<div class="row">
									<div class="col-sm-4">
										<a href="pages-user.php"><div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card_title">Users</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<?php
												require('conn.php');
												 $sql = "SELECT COUNT(ID) as users FROM userdata";
												 $result = $conn->query($sql); 
												 if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) { 
												 ?>
												<h1 class="mt-1 mb-3"><?php echo "$row[users]"?></h1> <?php } }?>
												<div class="mb-0">
													<span class="text-muted">Number of active users</span>
												</div>
											</div> </a>
										</div>
										
									</div>
									<div class="col-sm-4">
										<a href="viewproducts.php"><div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card_title">Products</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="gift"></i>
														</div>
													</div>
												</div>
												<?php
												require('conn.php');
												 $sql = "SELECT COUNT(ID) as products FROM products";
												 $result = $conn->query($sql); 
												 if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) { 
												 ?>
												<h1 class="mt-1 mb-3"><?php echo "$row[products]" ?></h1> <?php }}?>
												<div class="mb-0">
													<span class="text-muted">Total no. of products</span>
												</div>
											</div> </a>
										</div>
									</div>
									<div class="col-sm-4">
										<a href="orders.php"><div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card_title">Orders</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>
														</div>
													</div>
												</div>
												<?php
												require('conn.php');
												 $sql = "SELECT COUNT(ID) as orders FROM orders";
												 $result = $conn->query($sql); 
												 if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) { 
												 ?>
												<h1 class="mt-1 mb-3"><?php echo "$row[orders]" ?></h1> <?php }}?>
												<div class="mb-0">
													<span class="text-muted">Total no. of orders</span>
												</div>
											</div> </a>
										</div>
									</div>
							
							</div>


					<div class="row">
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill display">
								<div class="card-header1">

									<h5 class="card_title mb-0">Recent Orders</h5>
								</div>
								<table class="table table-hover mytable">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Total</th>
											<th class="d-none d-xl-table-cell">Date & Time</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Shipping </th>
										</tr>
									</thead>
									<tbody>
									<?php
												require('conn.php');
												 $sql = "SELECT * FROM `orders` ORDER BY ID DESC LIMIT 10";
												 $result = $conn->query($sql); 
												 if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) { 
												 ?>
										<tr>

											<td><?php echo "$row[customer_name]"?></td>

											<td class="d-none d-xl-table-cell">$ <?php echo "$row[grand_total]" ?></td>

											<td class="d-none d-xl-table-cell"><?php echo "$row[order_date]" ?></td>

											<?php if($row["status"] == 'Pending') { ?>
											<td><span class="badge bg-warning"><?php echo "$row[status]" ?></span></td>
                                            <?php } else if ($row["status"] == 'Cancelled') { ?>
											<td><span class="badge bg-danger"><?php echo "$row[status]" ?></span></td>
											<?php } else if($row["status"] == 'Complete') { ?>
											<td><span class="badge bg-success"><?php echo "$row[status]" ?></span></td>
											<?php }else if($row["status"] == 'Shipped') { ?>
											<td><span class="badge bg-warning"><?php echo "$row[status]" ?></span></td>
											<?php } else if($row["status"] == 'Refunded') {?>
											<td><span class="badge bg-danger"><?php echo "$row[status]" ?></span></td>
											<?php } ?>

											<td class="d-none d-md-table-cell"><?php echo "$row[shipping_method]" ?></td>

										</tr> <?php } }?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="col-8 col-lg-4 col-xxl-7 d-flex">
						<div class="card flex-fill display">
								<div class="card-header">

									<h5 class="card_title1 mb-0">Recently Added Products</h5>
								</div>
								<?php
												require('conn.php');
												 $sql = "SELECT * FROM `products` ORDER BY ID DESC LIMIT 3";
												 $result = $conn->query($sql); 
												 if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) { 
												 ?>
								<div class="line">
                                 <img src="../<?php echo "$row[product_image]"?>" class="line_img">
								 <span id="pro_name"><?php echo "$row[product_name]" ?></span>
								 <span id="pro_price">$ <?php echo "$row[product_price]"?> </span>
								</div>
								<?php  } }?>
							</div>
					    </div>

					</div>
				</div>
			</main>

			<?php include('footer.php'); ?>
		</div>
	</div>

	<script src="js/app.js"></script>

