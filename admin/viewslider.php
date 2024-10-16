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

					<h1 class="h3 mb-3">View Slider </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <?php
                                require('conn.php');
                                    $sql = "SELECT * FROM viewslider";
                                    $result = $conn->query($sql); 
                                    if ($result->num_rows > 0) {
                                ?>
									<table width="100%" border="2"  class="table">
                                    
                                    <tr>
                                        <th><strong>Sr No.</strong></th>
                                        <th><strong>Link</storng></th>
                                        <th><strong>Text</storng></th>
                                        <th><strong>Sub Title</storng></th>
                                        <th><strong>Image<strong></th>
										<th><strong>Edit<strong></th>
										<th><strong>Delete<strong></th>
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                    <td><?php echo $row["ID"];?></td>
                                    <td><?php echo $row["url"];?> </td>
                                    <td><?php echo $row["text"];?> </td>
                                    <td><?php echo $row["subtitle"];?> </td>
                                    <td><?php echo "<img width='120px' height='70px'  src='../".$row['image']."' >";?> </td>
                                    <td align="center"><a href='editslider.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="edit"></i></a></td>
                                    <td align="center"><a href='viewslider.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="trash-2"></i></a></td>
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

    $sql1 = "DELETE FROM viewslider WHERE ID = '$ID' ";
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
