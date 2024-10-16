<?php  
session_start();//session starts here  
  
?>  
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In </title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Admin</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/icon.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="90" height="60" />
									</div>
                                    
									<form method="POST" name="login">
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="uname" id="uname" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="pwd" id="pwd" placeholder="Enter your password" />

										</div>
										<div>
											<label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                            <span class="form-check-label">
                                            Remember me next time
                                             </span>
                                        </label>
										</div>
										<div class="text-center mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary" name="signin" value="Sign in"/>
											
											
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
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "s4u");
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        if(isset($_POST['signin'])){
        $Username = $_POST['uname'];  
        $Password = $_POST['pwd'];  
          
        //to prevent from mysqli injection  
        $Username = stripcslashes($Username);  
        $Password = stripcslashes($Password);  
        $Username = mysqli_real_escape_string($conn, $Username);  
        $Password = mysqli_real_escape_string($conn, $Password);
        $_SESSION['aname']=$Username; 

        if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  
       

        $sql = "SELECT * from admin where username = '$Username' and password = '$Password'";  
       $result = mysqli_query($conn, $sql);  
       $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
       $count = mysqli_num_rows($result);  
    
       if($count == 1){  
           echo "<h6><center>Login successful</center></h6>";
           header("Location: admin.php");}  
       else{  
           echo "<h4><center>Login failed. Invalid username or password.</center></h4>";  
       }  }   
        // Close connection
        mysqli_close($conn);
        ?>


	<script src="js/app.js"></script>

</body>

</html>