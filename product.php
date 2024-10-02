<?php
if(session_id() == '') {
  session_start();
} 
include 'header.php';?>

<?php 
  require('conn.php');
 $sql = "SELECT * FROM `products` ORDER BY ID DESC LIMIT 15";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>

<section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
             <h2>
                   Our Products
             </h2>
      </div>
      <div class="row">
        <?php  while($row = $result->fetch_assoc()) {  ?>
           <div class="col-sm-6 col-lg-4 probox morebox" style="display:none;" >
           <form method="post" action="cart?action=add&id=<?php echo $row["ID"]; ?>">
             <div class="box">
             
                <div class="img-box" >
                <img src="<?php echo "$row[product_image]"?>" alt="">
                <a href="cart?action=add&id=<?php echo $row["ID"]; ?>" class="add_cart_btn">
                      <span>
                      <input type="submit" name="add"  class="btn btn-default" style="color:white;" value="Add to Cart">
                      </span>
                    </a>
                </div>
                <div class="detail-box">
                <h5>
                <a href="prodetail?id=<?php echo $row["ID"]; ?>"><?php echo "$row[product_name]" ?> </a>
                </h5>
                  <div class="product_info">
                    <h5>
                        <span>$</span> <?php echo "$row[product_price]" ?>
                    </h5>
                    <?php
                   if(isset($_SESSION["wishlist"])){
                   $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
                 if(in_array($row["ID"], $item_array_id)) {?>
                <div class="heart_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i>
                </div>
                <?php } else{ ?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } } else {?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } ?>
                  </div>
                </div>
             </div> </form>
          </div> 
          <?php } ?>
        </div>
      <div class="btn_box" id="loadmore">
        <a href="" class="view_more-link">
          View More
        </a>
      </div>
      <?php } ?>
    </div>
  </section>

  
  <?php include 'footer.php';?>
  <script>
    jQuery(document).ready(($) => {
        
    $('.star_container').on('click',  function(e) {
        var data;
        var id = this.id;
        $.ajax({
              type: "GET",
              dataType: "text",
              url: "wish.php?id="+id, 
              data: data,
              success: function(data) {
                 console.log(data);
                 $(".star_container.icon_"+id).html(data);
              }
              
            });
    });
    });
  </script>
  <script>
    jQuery(document).ready(($) => {
        
    $('.heart_container').on('click',  function(e) {
        var data;
        var id = this.id;
        $.ajax({
              type: "GET",
              dataType: "text",
              url: "deletewish.php?id="+id, 
              data: data,
              success: function(data) {
                 console.log(data);
                 $(".heart_container.icon_"+id).html(data);
              }
              
            });
    });
    });
  </script>
  

<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
 <script src="js/bootstrap.js"></script> 
<!-- custom js -->
<script src="js/custom.js"></script> 
<script src="js/more.js"></script>

