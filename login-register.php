<?php
if(session_id() == '') {
  session_start();
} 
 include "header.php"; ?>
<div class= "part">

    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/frontImg-1.jpg" alt="">
      </div>
      <div class="back">
        <img class="backImg" src="images/frontImg.jpg" alt="">
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          <form  method ="POST" id="login">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fa fa-envelope"></i>
                <input type="text" name="uname" id="uname" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fa fa-lock"></i>
                <input type="password" name="psd" id="psd" minlength="5" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
              <input type="submit" name="signin" value="Login" />
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form method="POST" id="signup">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fa fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fa fa-envelope"></i>
                <input type="email"  name="email1" id="email1" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fa fa-lock"></i>
                <input type="password" name="psw" id="psw" placeholder="Enter your password" minlength="5" required >
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit" name="Submit" >
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
</div> 
</div>

 <?php 
$_SESSION['loggedIn'] = true;
 $conn = mysqli_connect("localhost", "root", "", "s4u");
 // Check connection
 if($conn === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }
 if(isset($_POST['Submit'])){
  $Name = $_REQUEST['name'];
  $Email = $_REQUEST['email1'];
  $Pwd = $_REQUEST['psw'];
  
  $Name = stripcslashes($Name);  
  $Name = mysqli_real_escape_string($conn, $Name);  
  
  
  $sql1 = "INSERT INTO `userdata`(`ID`, `name`, `email`, `password`) VALUES (NULL,'$Name','$Email','$Pwd')";
  if(mysqli_query($conn, $sql1)){
   // echo "Register Successfully.";
  } else{
    echo "ERROR: Hush! Sorry $sql1."
        . mysqli_error($conn);
  } }
  mysqli_close($conn);

 ?> 
<?php
        $conn = mysqli_connect("localhost", "root", "", "s4u");
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        if(isset($_POST['signin'])){
        $Username = $_POST['uname'];  
        $Password = $_POST['psd'];  
        
          
        //to prevent from mysqli injection  
        $Username = stripcslashes($Username);  
        $Password = stripcslashes($Password);  
        $Username = mysqli_real_escape_string($conn, $Username);  
        $Password = mysqli_real_escape_string($conn, $Password);
        $_SESSION['uname']=$Username; 
        $_SESSION['loggedIn'] = true;
        if(!$_SESSION['uname'])  
        {  
          header("Location: login-register"); 
         } 

         

        $sql = "SELECT * from userdata WHERE  name = '$Username' AND password = '$Password'";  
       $result = mysqli_query($conn, $sql);  
       $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
       $count = mysqli_num_rows($result);  
       
       if($count == 1){  
        
        $_SESSION['ID']= $row["ID"]; 
        echo '<script>window.location="index"</script>';
           echo "<h6><center>Login successful</center></h6>";
          
           
      }
       else{  
           echo "<h4><center>Login failed. Invalid username or password.<center></h4>";  
       }  }   
        // Close connection
        mysqli_close($conn);
        ?>


<?php include 'footer.php'?>
