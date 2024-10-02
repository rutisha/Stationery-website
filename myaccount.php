<?php
if(session_id() == '') {
  session_start();
} 
 include "header.php" ?>
<section class="padding">
<div class="container1">

  <div class="sidebar">
  <ul>
       <a href="myaccount">
      <li style="--clr: #2f4aab"> 
      <i class="fa fa-address-card-o" aria-hidden="true"></i>
        <span>Edit Profile</span> 
      </li> </a>
      <a href="order_history">
      <li style="--clr: #f1cc52">
      <i class="fa fa-history" aria-hidden="true"></i>
        <span>Order History</span>
      </li> </a>
      <a href="address_book">
      <li style="--clr: #2f4aab">
      <i class="fa fa-address-book-o" aria-hidden="true"></i>
        <span>Address Book</span>
      </li> </a>
      <a href="wishlist">
      <li style="--clr: #f1cc52 ">
      <i class="fa fa-heart" aria-hidden="true"></i>
        <span>Wishlist</span>
      </li> </a>
    </ul>
  </div>
  <div class="profile">
    <h2>Edit Profile</h2>
    <?php
        require('conn.php');
        $ID = $_SESSION["ID"];
        $sql = "SELECT * FROM `userdata` WHERE ID = '$ID' ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result); ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="myform" name="myform" >
    <label class="entry">
      <span class="fname">Name:</span> <br>
      <input type="text" name="fname" class="pwd" id="fname" value="<?php echo $row["name"] ?>"required>
    </label> 
    <label class="entry">
      <span class="lname">Email: </span> <br> 
      <input type="email" name="mail" class="pwd" id="mail"value="<?php echo $row["email"] ?>" required> 
    </label> 
   
    <label class="entry">
      <span>Password:</span> <br>
      <input type="password" name="pwd" class="pwd" id="pwd" value="<?php echo $row["password"] ?>">&nbsp&nbsp<p toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></p>
    </label> 
    <input type="submit" name="Submit" id="Submit">
   </form>
   </div>
</div>
</section>      
<script>
  $(document).on('click', '.toggle-password', function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pwd");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
  });
</script>
<?php include "footer.php" ?>

<?php 
 require('conn.php');
      
 if($conn === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error()); }

if(isset($_POST['Submit'])){
  $ID = $_SESSION["ID"];
  $Name1 = $_POST["fname"];
  $Email = $_POST["mail"];
  $Password = $_POST["pwd"];

  $sql = "UPDATE `userdata` SET `name`= '$Name1',`email`= '$Email',`password`= '$Password' WHERE ID ='$ID'";
  if(mysqli_query($conn, $sql)){
    //echo "Data Updated Successfully";
   } else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn); }
  } 
mysqli_close($conn);

?>
<script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>