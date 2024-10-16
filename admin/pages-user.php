<?php  
session_start();//session starts here  
  
?>  

<?php  if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  ?>

    <?php include('header.php'); ?>
			<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3">View Users </h1>

                <div class="row">
                	<div class="col-12">
	                    	<div class="card">
		                    	<div class="card-header">
			<?php
			$conn = mysqli_connect("localhost", "root", "root", "s4u");
			if($conn === false){
			   die("ERROR: Could not connect. "
				  . mysqli_connect_error());
				}
				$sql = "SELECT * FROM userdata";
				$result = $conn->query($sql); 
				if ($result->num_rows > 0) {
			?>
				<table width="100%" border="2" style="border-collapse:collapse;" class="table" >
				
				<tr>
					<th><strong>Sr No.</strong></th>
					<th><strong>Name</storng></th>
					<th><strong>Email</storng></th>
					<th><strong>Password<strong></th>
					<th><strong>Edit<strong></th>
					<th><strong>Delete<strong></th>
				</tr>
				
				<tbody>
				<?php 
				while($row = $result->fetch_assoc()) { ?>
				<tr>
				<td><?php echo $row["ID"];?></td>
				<td><?php echo $row["name"];?> </td>
				<td><?php echo $row["email"];?> </td>
				<td><?php echo $row["password"];?> </td>
				<td align="center"><a href='edituser.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="edit"></i></a></td>
				<td align="center"><a href='pages-user.php?id=<?php echo $row["ID"]; ?>'><i class="align-middle" data-feather="trash-2"></i></a></td>
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
    $conn = mysqli_connect("localhost", "root", "root", "s4u");
    if($conn === false){
        die("ERROR: Could not connect. "
         . mysqli_connect_error());
    }
    if(isset($_GET['id']))
    {
    $ID = $_GET['id'];

    $sql1 = "DELETE FROM userdata WHERE ID = '$ID' ";
    if(mysqli_query($conn, $sql1)){
     echo "Data Deleted Successfully<br>";} 
     else{
     echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
     }
    }
     mysqli_close($conn);
    ?>
		</div>
	</div>

	<script src="js/app.js"></script>
