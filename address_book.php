<?php 
if(session_id() == '') {
  session_start();
} 
include "header.php" ?>
<section class="padding">
<div class="container1">

  <div class="sidebar">
  <ul>
       <a href="myaccount".php>
      <li style="--clr: #2f4aab"> 
      <i class="fa fa-address-card-o" aria-hidden="true"></i>
        <span>Edit Profile</span> 
      </li> </a>
      <a href="order_history.php">
      <li style="--clr: #f1cc52">
      <i class="fa fa-history" aria-hidden="true"></i>
        <span>Order History</span>
      </li> </a>
      <a href="address_book.php">
      <li style="--clr: #2f4aab">
      <i class="fa fa-address-book-o" aria-hidden="true"></i>
        <span>Address Book</span>
      </li> </a>
      <a href="wishlist.php">
      <li style="--clr: #f1cc52 ">
      <i class="fa fa-heart" aria-hidden="true"></i>
        <span>Wishlist</span>
      </li> </a>
    </ul>
  </div>
  <div class="profile1">
    <h2>Insert or Edit Your Address</h2>
    <?php
        require('conn.php');
        $ID = $_SESSION["ID"];
        $sql = "SELECT * FROM `order_meta` WHERE `user_id`= '$ID' ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result); 
        ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form" name="myform" >
    <label class="entry">
      <span class="fname">First Name:</span> 
      <input type="text" name="fname" id="fname" value="<?php echo $row["first_name"] ?>"required> 
    </label> 
    <label class="entry">
      <span class="fname">Last Name:</span> 
      <input type="text" name="lname" id="fname" value="<?php echo $row["last_name"] ?>"required> 
    </label> 
    <label class="entry">
      <span class="fname">Country:</span> 
      <input type="text" name="country" id="fname" value="<?php echo $row["country"] ?>"required> 
    </label> 
    <label class="entry">
      <span class="fname">State:</span> <br>
      <input type="text" name="state" id="fname" value="<?php echo $row["state"] ?>"required>
    </label> 
    <label class="entry">
      <span class="fname">Address Line 1:</span> <br>
      <input type="text" name="add1" id="fname" value="<?php echo $row["address"] ?>"required>
    </label> 
    <label class="entry">
      <span class="fname">Address Line 2:</span> <br>
      <input type="text" name="add2" id="fname" value="<?php echo $row["address2"] ?>"required>
    </label> 
    <label class="entry">
      <span class="fname">City:</span> <br>
      <input type="text" name="city" id="fname" value="<?php echo $row["city"] ?>"required>
    </label> 
    <label class="entry">
      <span class="fname">Postcode:</span> <br>
      <input type="text" name="pin" id="fname" value="<?php echo $row["postcode"] ?>"required>
    </label> 
    <label class="entry">
      <span class="fname">Contact Number:</span> <br>
      <input type="text" name="num" id="fname" value="<?php echo $row["phone"] ?>"required>
    </label> 
    
    <input type="submit" name="Submit" id="Submit">
   </form>
   </div>
   
</div>
</section>      

<?php include "footer.php" ?>

<?php 
 require('conn.php');
      
 if($conn === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error()); }
if ($row != 0) {
if(isset($_POST['Submit'])){
  $ID = $_SESSION["ID"];
  $First_Name = $_POST["fname"];
  $Last_Name = $_POST["lname"];
  $Country = $_POST["country"];
  $State = $_POST["state"];
  $Address1 = $_POST["add1"];
  $Address2 = $_POST["add2"];
  $City = $_POST["city"];
  $Postcode = $_POST["pin"];
  $Phone = $_POST["num"];

  $sql = "UPDATE `order_meta` SET `country`= '$Country',`state`= '$State',`address`= '$Address1',
  `address2`= '$Address2',`city`= '$City',`postcode`= '$Postcode',`phone`= '$Phone' WHERE `user_id`= '$ID'";
  if(mysqli_query($conn, $sql)){
    //echo "Data Updated Successfully";
   } else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn); }
  }
}
else {
  if(isset($_POST['Submit'])){
    $ID = $_SESSION["ID"];
    $First_Name = $_POST["fname"];
    $Last_Name = $_POST["lname"];
    $Country = $_POST["country"];
    $State = $_POST["state"];
    $Address1 = $_POST["add1"];
    $Address2 = $_POST["add2"];
    $City = $_POST["city"];
    $Postcode = $_POST["pin"];
    $Phone = $_POST["num"];
  
    $sql = "INSERT INTO `order_meta`(`ID`, `user_id`, `first_name`, `last_name`, `country`, `state`, `address`, `address2`, `city`, `postcode`, `phone`) 
    VALUES (NULL,'$ID','$First_Name','$Last_Name','$Country','$State','$Address1','$Address2','$City','$Postcode','$Phone')";
    if(mysqli_query($conn, $sql)){
      echo "Data Added Successfully";
     } else{
      echo "ERROR: Hush! Sorry $sql. "
          . mysqli_error($conn); }
    }

}
mysqli_close($conn);

?>
<script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>