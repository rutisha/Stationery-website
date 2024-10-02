<section class="info_section ">
    <div class="footer_container">
      <div class="row">
        <div class="col-md-3">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          
          <div class="info_contact">
            <h5>
            <?php
              require('conn.php');
              $sql = " SELECT * FROM header_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
            ?>
              <a href="index" class="navbar-brand">
              <img src="<?php echo "$row[logo]"?>" >
              </a>
            </h5>
            <?php } } ?>
            <p>
            <?php
              require('conn.php');
              $sql = " SELECT * FROM footer_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
            ?>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
            <a href="#" target="_blank"> <?php echo "$row[address]" ?> </a>
            </p> <?php } } ?>
            <?php
              require('conn.php');
              $sql = " SELECT * FROM header_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
            ?>
            <p>
              
              <i class="fa fa-phone" aria-hidden="true"></i>
              +1 <?php echo "$row[contact_no]" ?>
            </p>
            <p>
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=new" target="_blank">  <?php echo "$row[email]" ?> </a>
            </p>
            <?php } } ?>
          </div>
          
        </div>
        <div class="col-md-3">
          <div class="info_info">
          <?php
              require('conn.php');
              $sql = " SELECT * FROM footer_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
            ?>
            <h5>
              Information
            </h5>
            <p>
             <?php echo "$row[information]" ?>
            </p>
            <?php } } ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Useful Links
            </h5>
            <ul>
            <?php  require('conn.php');
                       $sql = "SELECT * FROM `menu` WHERE `menu_type`= 'footer' ORDER BY `display_order` ASC";
                       $result = $conn->query($sql); 
                       if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {  
                         ?>
              <li>
                <a href="<?php echo "$row[url]"?>">
                  <?php echo "$row[text]" ?>
                </a>
              </li>
             <?php } } ?>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Newsletter
            </h5>
            <form  method="POST" id="newsform" action="">
              <input type="email" name="email" id="email" placeholder="Enter your email">
              <button id="newsub" type="submit">Subscribe </button><br><br>
              <span id="success_message" class="text-success"></span>
              
            </form>
            <div class="social_box">
            <?php
              require('conn.php');
              $sql = " SELECT * FROM footer_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
            ?>
              <a href="<?php echo "$row[facebook_url]"?>">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="<?php echo "$row[whatsapp_url]"?>">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
              </a>
              <a href="<?php echo "$row[instagram_url]"?>">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="<?php echo "$row[youtube_url]"?>">
                <i class="fa fa-youtube" aria-hidden="true"></i>
              </a>
              <?php } } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
<footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By Stationary for you
      </p>
    </div>
  </footer>
  <script>
     $(document).ready(function() {
      $('#success_message').hide();
    $("#newsform").submit(function (e) {
      e.preventDefault();
        var email = $("#email").val();
        $.ajax({
             url: "subscribe.php",
             type: 'post',
             data: {'email': email},
            success:function(data){  
             
                          // $("form").trigger("reset");  
                          $('#success_message').html(data);  
                          setTimeout(function(){  
                               $('#success_message').show("milliseconds");  
                          },500);  
                     }  
         });
         
    });
  });
</script>
</body>
</html>