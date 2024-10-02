<?php  
session_start(); 
?>  
<?php  

include('header.php'); ?>

<section class="layout_padding">

<div class="heading_container heading_center">
        <h2>
          Forgot Password 
        </h2>
      </div> 


     <div class="card square">
          <form method="POST" >

            <p>Enter your Email Address To Send Temporary Password </p>

            <input type="email" id="chk-email" name="email"> <br><br>

            <input type="submit" class="send-mail" value="Send Mail" name="submit_email">

          </form>
     </div> <br><br>

     <?php
$conn = mysqli_connect("localhost", "root", "", "s4u");
// Check connection
if($conn == false)
{
    die("ERROR: Could not connect. ". mysqli_connect_error());
}

if(isset($_POST['submit_email']))
{
    $Email = $_REQUEST['email'];
$sql = "SELECT * FROM `userdata` WHERE `email`= '$Email'";

$result = $conn->query($sql); 
 if ($result->num_rows > 0) 
 {
  echo "<div class= 'msg' > Please check your email for Temporary Password !!</div> <br>";
 }
else
{
 echo "<div class= 'msg-1' > Your email is not associate with this site !! </div>";
}

}
?>
</section>


<?php include('footer.php'); ?>

<?php 
  if(isset($_POST['submit_email'])){
    $from = "patelrutisha@gmail.com.com"; // this is your Email address
    $to = $_REQUEST['email']; // this is the sender's Email address
    $subject = "Password Recovery ";
   
    $message = "Hello customer below you will find temporary password below <br>
     Temporary Password: xyz <br>
     you can login through temprary password <br>
     After successfull login go to my account->Edit profile and change it";
   
    $headers = "From:" . $from;
   
    mail($to,$subject,$message,$headers);
   
    echo "Mail Sent ";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }

?>
<script src="js/jquery-3.4.1.min.js"></script>

<script src="js/bootstrap.js"></script> 

<script src="js/custom.js"></script> 