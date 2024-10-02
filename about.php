<?php
if(session_id() == '') {
  session_start();
} 
 include 'header.php'; ?>
<br> <br>
<section>
<div class="heading_container heading_center">
        <h2>
          About Us
        </h2>
      </div> 
   
</section> <br> 
<?php 
require('conn.php');
 $sql = "SELECT * FROM pages ORDER BY ID LIMIT 1";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>
    <section class="about_section">
    <div class="upper">
    <?php  while($row = $result->fetch_assoc()) { ?>
        <div class="image">
        <img src="<?php echo "$row[image]" ?>" alt="Image" id="slider" />
        </div>
    
      <div class="info">
        <h3><?php  echo "$row[title]"?></h3>
        <p>
           <?php echo "$row[content]"?>
        </p>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <!-- ------------------------------------ -->
    <?php 
require('conn.php');
 $sql = "SELECT * FROM pages LIMIT 1";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>
    <div class="lower">
    <?php  while($row = $result->fetch_assoc()) { ?>
      <div class="info" id="lower-info">
        <h3><?php echo "$row[title]" ?></h3>
        <p>
       <?php echo "$row[content]" ?>
        </p>
      </div>
      <div class="slider" id="lower-img">
      <img src="<?php echo "$row[image]" ?>" alt="Image" id="slider" />
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
   <br> <br> <br>
  <?php include 'footer.php';?>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>

