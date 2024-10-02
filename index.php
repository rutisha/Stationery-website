<?php
if(session_id() == '') {
  session_start();
} 
if(isset($_SESSION['uname'])) {
if(!isset($_GET["action"])) {
        require('conn.php');
        $Userid = $_SESSION["ID"];
        $sql2 ="SELECT * FROM `wishlist` WHERE userid = $Userid";
        $result2 = mysqli_query($conn,$sql2);
        
        if(mysqli_num_rows($result2) > 0){
            foreach ( $result2 as $row2 ) {
                $_SESSION["wishlist"] = unserialize($row2['wishlist_data']);
              } }
              else{
               //echo "ERROR";
               }
            } 
          
            if(!isset($_GET["action"])) {
            $Userid = $_SESSION["ID"];
            $sql2 ="SELECT * FROM `cart` WHERE userid = $Userid";
            $result2 = mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result2) > 0){
                foreach ( $result2 as $row2 ) {
                    $_SESSION["cart"] = unserialize($row2['cart_data']);
                  } }
                  else{
                   //echo "ERROR";
                   }} else{
                    //echo "<center><b>Not Found</b></center>";
                   }
          }
        
         ?>
<?php include 'header.php';?>

<?php 
 require('conn.php');
 $sql = " SELECT * FROM viewslider ";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  $i = 0;
 ?>

<section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
       <?php 
        while($row = $result->fetch_assoc()) { 
          if($i == 0) {
              $class ="active";
          } else {
            $class ="";
          }
      ?>
          <div class="carousel-item <?php echo $class; ?>">

            <div class="container ">
              
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                    <?php echo "$row[text]"?>
                    </h1>
                    <p>
                    "<?php echo "$row[subtitle]" ?>"
                    </p>
                    <a href="<?php echo "$row[url]"?>">
                      Shop Now
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <img src="<?php echo "$row[image]"?>" alt="">
                </div>
              </div>
            </div>
          </div>
          <?php $i++; } ?>
        </div>
        <div class="carousel_btn_box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end slider section -->
  </div>
  

<!-- product section -->
  <?php 
 require('conn.php');
 $sql = "SELECT * FROM `products` ORDER BY ID DESC LIMIT 9";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>

  <section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          TRENDING PRODUCTS
        </h2>
      </div>
      
      <div class="row">
       <?php  while($row = $result->fetch_assoc()) { ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
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
                 if(in_array($row["ID"], $item_array_id)) {
                  ?>
                <div class="star_container icon_<?php echo $row["ID"]; ?> added" id="<?php echo $row["ID"]; ?>" >
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
           </div> 
          </div>
          <?php } ?>
        </div>
      <div class="btn_box">
        <a href="product" class="view_more-link">
          View More
        </a>
      </div>
     <?php }  ?>
    </div>
    
  </section>

  <!-- end product section -->

  <!-- about section -->
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
        <h3><?php echo "$row[title]" ?></h3>
        <p>
          <?php echo "$row[content]" ?>
        </p>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php } ?>


  <!-- end about section -->

  <!-- why us section -->
  <?php 
 require('conn.php');
 $sql = "SELECT * FROM `benefits` ";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>

  <section class="why_us_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Why Choose Us
        </h2>
      </div>
      <div class="row">
      <?php  while($row = $result->fetch_assoc()) { ?>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
              <img src="<?php echo "$row[icon]"?>" alt="">
            </div>
            <div class="detail-box">
              <h5>
                <?php echo "$row[title]" ?>
              </h5>
              <p>
              <?php echo "$row[subtitle]" ?>
              </p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </section>

  <!-- end why us section -->


  <!-- client section -->
  <?php 
 require('conn.php');
 $sql = " SELECT * FROM testimonial";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  $i = 0;
 ?>
<section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          What Says Our Customers
        </h2>
      </div>
    </div>
    <div class="client_container ">
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <?php 
        while($row = $result->fetch_assoc()) { 
          if($i == 0) {
              $class ="active";
          } else {
            $class ="";
          }
      ?>
          <div class="carousel-item <?php echo $class ?>">
            <div class="container">
              <div class="box">
                <div class="detail-box">
                  <p>
                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                  </p>
                  <p>
                  <?php echo "$row[review]"?>
                  </p>
                </div>
                <div class="client-id">
                  <div class="img-box">
                    <img src="<?php echo "$row[reviewer_image]"?>" alt="">
                  </div>
                  <div class="name">
                    <h5>
                    <?php echo "$row[reviewer_name]"?>
                    </h5>
                    <h6>
                    <?php echo "$row[sub_title]"?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <?php $i++; } ?>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
            <span>
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
            <span>
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
  </section>
  <!-- end of client section -->



<?php include 'footer.php';?>
 

  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script>
    jQuery(document).ready(($) => {
        
    $('.star_container').on('click',  function(e) {
          var data;
          var id = this.id;
        if($(this).hasClass("added")){
          $.ajax({
              type: "GET",
              dataType: "text",
              url: "deletewish.php?id="+id, 
              data: data,
              success: function(data) {
                console.log(data);
                //$(".star_container.icon_"+id).html(data);
                $(".star_container.icon_"+id).html('<i class="fa fa-heart-o"  aria-hidden="true" ></i>')
                $(".star_container.icon_"+id).removeClass('added');
              }
              
            });
        } else {
          $.ajax({
              type: "GET",
              dataType: "text",
              url: "wish.php?id="+id, 
              data: data,
              success: function(data) {
                console.log(data);
                //$(".star_container.icon_"+id).html(data);
                $(".star_container.icon_"+id).html('<i class="fa fa-heart"  aria-hidden="true" style="color:red;"></i>');
                $(".star_container.icon_"+id).addClass('added');
                
              }
              
            });

        }
    });
    
    });
  </script>
 
 
   
  
 <script>
var owl = $('#brand-carousel');
owl.owlCarousel({
   items:6,
    loop:true,
    margin:15,
    singleItem: true,
    responsiveClass:true,
    autoplay:true,
    autoplayTimeout:1000,
    responsive:{
                0:{
                    items: 1,
                    dots: true
                },
                200:{
                    items: 2,
                    dots: true
                },
                400:{
                    items: 3,
                    dots: true,
                    
                },
                600:{
                    items: 4,
                    dots: true
                },
                900:{
                    items: 5,
                    dots: true
                },
                1200:{
                    items: 6
                }
            }
});
  </script>
</body>
</html>
