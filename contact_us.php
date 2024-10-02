<?php
if(session_id() == '') {
  session_start();
} 
include 'header.php';?>

<section class="layout_padding">
<div class="contain">

  <div class="wrapper">

    <div class="form">
      <h4>GET IN TOUCH</h4>
      <h2 class="form-headline">Send us a message or feedback</h2>
      <form id="submit-form" action="contact_us">
        <p>
          <input id="name" class="form-input" name="name" type="text" placeholder="Your Name" required>
          
        </p>
        <p>
          <input id="email" class="form-input" name="email" type="email" placeholder="Your Email">
          
        </p>
        <p class="full-width">
          <textarea  minlength="20" id="message" name="message" cols="30" rows="7" placeholder="Your Message" required></textarea>
          
        </p>
        <p class="full-width">
          <input type="submit" class="submit-btn"  name="contact_sub" value="Submit" >
          
        </p>
      </form>
    </div>

    <div class="contacts contact-wrapper">
      <img class="contact_img" src="./admin/static/img/photos/contact.png" alt="">
    </div>
  </div>
</div>
<?php 

if(isset($_POST['contact_sub']))
{

  $from = $_REQUEST['email']; // this is your Email address
  $to = "patelrutisha@gmail.com"; // this is the sender's Email address
  $msg = $_REQUEST['message'];
  $name = $_REQUEST['name'];
  $subject = "Customer's message";

  $message = "Hello,

   The message is from ".$name." is as below : 
   ".$msg."
  
   Yours Truely,"
   .$name." ";
 
  $headers = "From:" . $from;
 
  if(mail($to,$subject,$message,$headers)) 
 {
   echo"Mail sent";
  }
  else {
    echo "Mail not sent ";
  }
}
?>

</section>

<?php include 'footer.php'; ?>