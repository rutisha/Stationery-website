<?php
if(session_id() == '') {
   session_start();
 } 

include "header.php" ?>

<section class="layout_padding">
 <div class="container">
    <center>
 <img src= "images/tickmark.png"  width= "100px" height="100px"> <br><br>
  <h1>THANK YOU!!</h1>
  <p>Your order will delivered soon at your address..</p> <br>
  <button class="shop-btn"><a href="product"> Continue Shopping</a></button> <br><br> <br><br>
  <div class="row border-bottom"></div><br>
  <p> Send Feedback and follow us on below links</p>
    <div class="buttons">
    <?php 
           require('conn.php');
            $sql = "SELECT * FROM footer_setting";
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) { 
       ?>
         <div class="rows">
            <a href="<?php echo "$row[facebook_url]" ?>"><button class="facebook">
            <span><i class="fa fa-facebook-f"></i></span>
            Facebook</button></a>
            <a href="<?php echo "$row[instagram_url]" ?>"><button class="instagram">
            <span><i class="fa fa-instagram"></i></span>
            Instagram</button></a>
         </div>
         <div class="rows">
         <a href="<?php echo "$row[whatsapp_url]" ?>"><button class="whatsapp">
            <span><i class="fa fa-whatsapp"></i></span>
            Whatsapp</button></a>
            <a href="<?php echo "$row[youtube_url]" ?>"><button class="youtube">
            <span><i class="fa fa-youtube"></i></span>
            YouTube</button></a>
         </div>
         <?php }} ?>
      </div>
 </center>
        </div>
        </section>
       
<?php include "footer.php" ?>
<?php 
if(isset($_SESSION["cart"])){
   
   unset($_SESSION["cart"]);
   require('conn.php');
    if($conn == false){
        die("ERROR: Could not connect. "
         . mysqli_connect_error());
    }
   
   if(isset($_SESSION["ID"])) {
   $ID = $_SESSION["ID"];
   $sql2 = "DELETE FROM cart WHERE userid = '$ID' ";
   if(mysqli_query($conn2, $sql2)){
    //echo "Data Deleted Successfully<br>";
   } 
    else{
    echo "ERROR: Hush! Sorry $sql2. "
        . mysqli_error($conn2);
    }
   }
   
   }
  



?>