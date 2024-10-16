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
                    <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql = " SELECT * FROM userdata WHERE ID ='$ID'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result); ?>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form method="POST" action="" class="eform">
                                    <label for="url"><b>Name:</b></label> 
                                    <label for="text" id="ptitle2"><b>Email:</b></label> <br> 
                                    <input type="text" name="name" id="name"  value="<?php echo "$row[name]"?>" required >
                                    &nbsp &nbsp &emsp; &emsp;  &nbsp  &emsp; &emsp;
                                    <input type="text" name="email" id="email" value="<?php echo "$row[email]"?>"required ><br><br><br>
                                     
                                    <label for="text"><b>Password:</b></label> <br>
                                    <input type="text" name="psw" id="psw" value="<?php echo "$row[password]"?>"required ><br><br><br>
                                     
                                    

                                     <input type="submit" id="sub" name="Submit" value="Submit">

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
   
	<script src="js/app.js"></script>
	<?php
    require('conn.php');
	if(isset($_POST['Submit'])){
      
     $ID = $_GET['id'];
     $Name = $_REQUEST['name'];
     $Email = $_REQUEST['email'];
     $Password =  $_REQUEST['psw'];
    
     $sql1 ="UPDATE `userdata` SET `ID`= '$ID',`name`='$Name',`email`= '$Email',`password`= '$Password' WHERE `userdata`.`ID`='$ID' ";

     if(mysqli_query($conn, $sql1)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql1. "
             . mysqli_error($conn); }
	 }
     mysqli_close($conn);
     
    ?>
