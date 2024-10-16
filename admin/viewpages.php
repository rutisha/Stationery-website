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

					<h1 class="h3 mb-3">View Pages Details </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <?php
                               require('conn.php');
                                    $sql1 = "SELECT * FROM pages";
                                    $result1 = $conn->query($sql1); 
                                    if ($result1->num_rows > 0) {
                                ?>
									<table width="50%" border="2" class="table" >
                                    
                                    <tr>
                                        <th><strong>Sr No.</strong></th>
                                        <th><strong>Title</storng></th>
                                        <th><strong>Content</storng></th>
                                        <th><strong>Image</storng></th>
                                        <th><strong><center>Edit</center></storng></th>
                                        <th><strong><center>Delete</center></storng></th>
                                    </tr>
                                    
                                    <tbody>
                                    <?php 
                                    while($row1 = $result1->fetch_assoc()) { ?>
                                    <tr>
                                    <td><?php echo $row1["ID"];?></td>
                                    <td><?php echo $row1["title"];?> </td>
                                    <td><?php echo $row1["content"];?> </td>
                                    <td><img src="../<?php echo $row1["image"];?>" width="120px" height="80px"> </td>
                                    <td align="center"><a href='editpages.php?id=<?php echo $row1["ID"]; ?>'><i class="align-middle" data-feather="edit"></i></a></td>
                                    <td align="center"><a href='pages.php?id=<?php echo $row1["ID"]; ?>'><i class="align-middle" data-feather="trash-2"></i></a></td>
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
            <?php
      require('conn.php');
      if(isset($_GET['id']))
      {
      $ID = $_GET['id'];
  
      $sql2 = "DELETE FROM pages WHERE ID = '$ID' ";
      if(mysqli_query($conn, $sql2)){
       echo "Data Deleted Successfully<br>";} 
       else{
       echo "ERROR: Hush! Sorry $sql2. "
           . mysqli_error($conn);
       }
      }
       mysqli_close($conn);
    ?>
		</div>
	</div>

	<script src="js/app.js"></script>
