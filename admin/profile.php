<?php  
session_start();//session starts here  
  
?>  

<?php  if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  ?>

    <?php include('header.php'); ?>
    <main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Edit Your Profile</h1>
							<p class="lead">
								
							</p>
						</div>
                        <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql = " SELECT * FROM admin WHERE ID ='$ID' ";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result); ?>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/photos/admin.jpg" alt="admin" class="img-fluid " width="90" height="60" />
									</div>
                                    
									<form method="POST" name="login">
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="uname" id="uname" value="<?php echo "$row[username]" ?>" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="text" name="pwd" id="pwd" value="<?php echo "$row[password]" ?>" placeholder="Enter your password" />
										</div>
										<div>
											
                                        </label>
										</div>
										<div class="text-center mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary" name="update" value="Update"/>
											
											
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

<?php include('footer.php'); ?>
            <?php
    require('conn.php');

    if(isset($_POST['update'])){
    
    $ID = $_GET["id"];
    $Username = $_POST['uname'];  
    $Password = $_POST['pwd'];  
          
    //to prevent from mysqli injection  
    $Username = stripcslashes($Username);  
    $Password = stripcslashes($Password);  
    $Username = mysqli_real_escape_string($conn, $Username);  
    $Password = mysqli_real_escape_string($conn, $Password);
    $_SESSION['aname']=$Username; 

    $sql = "UPDATE `admin` SET `username`= '$Username',`password`= '$Password' WHERE `admin`.`ID`='$ID'";
     if(mysqli_query($conn, $sql)){
        echo "Data updated successfully.";
        echo '<script>window.location="profile"</script>';
        
     } else{
        echo "ERROR: Hush! Sorry $sql."
            . mysqli_error($conn);
    } }
    
     mysqli_close($conn);
    ?>
		</div>
	</div>

	<script src="js/app.js"></script>
