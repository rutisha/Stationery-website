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

					<h1 class="h3 mb-3">Edit User</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form action="" method="GET">
                                    <label for="url"><b>Name:</b></label>
                                    <input type="text" name="name" id="name" required ><br><br>

                                    <label for="text"><b>Email:</b></label>
                                    <input type="text" name="email" id="email" required ><br><br>
                                     
                                    <label for="text"><b>Password:</b></label>
                                    <input type="text" name="psw" id="psw" required ><br><br>
                                    
                                     <input type="submit" name="submit" value="submit">
                                     <a href="pages-user.php"><button type="button">Back</button></a>

                                    </form>
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
     $conn = mysqli_connect("localhost", "root", "root", "s4u");
      
     if($conn === false){
         die("ERROR: Could not connect. "
             . mysqli_connect_error()); }
      
     $ID = $_GET['id'];
     $Name = $_REQUEST['name'];
     $Email = $_REQUEST['email'];
     $Password =  $_REQUEST['psw'];
    
     $sql ="UPDATE `userdata` SET `ID`= '$ID',`name`='$Name',`email`= '$Email',`password`= '$Password' WHERE `userdata`.`ID`='$ID' ";

     if(mysqli_query($conn, $sql)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn); }
      
     mysqli_close($conn);
     
    ?>
	<script src="js/app.js"></script>
