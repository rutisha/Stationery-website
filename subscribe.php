<?php
if(session_id() == '') {
  session_start();
} 
$conn = mysqli_connect("localhost", "root", "", "s4u");
if($conn == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }
$Email = $_REQUEST['email'];
if($Email!= "") {
$sql = "INSERT INTO `newsletter`(`ID`, `email`) VALUES (NULL,'$Email')";
if(mysqli_query($conn, $sql)){ ?>

    <div id="message" style="color:#fff">Thank You for Subscribing!!</div>

    <?php  } 
} else { ?>
  <div id="message" style="color:#fff">Please enter your email</div>
<?php   }
    mysqli_close($conn);
   ?>