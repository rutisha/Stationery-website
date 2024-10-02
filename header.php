<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/favicon.jpg" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>S4U</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- <link href="admin/static/css/custom.css" rel="stylesheet"> -->
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> <!-- range slider -->

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Owl Slider -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.default.css">
  <script src="js/owl.autoplay.js"> </script>
  <script src="js/owl.carousel.js"> </script>
  <script src="js/owl.carousel.min.js"> </script>

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" >
  <link href="css/custom.css" rel="stylesheet" >
  <!-- responsive style -->

  <link href="css/responsive.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  
</head>

<body>

  <div class="hero_area">
    <!-- header section starts -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="top_nav_container">
          <?php
              require('conn.php');
              $sql = " SELECT * FROM header_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
          ?>
          
            <div class="contact_nav">
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  +1 <?php echo "$row[contact_no]" ?>
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  <?php echo "$row[email]" ?>
                </span>
              </a>
            </div>
            <?php } } ?>
            <form class="search_form" id="frmsearch" method="POST" action="search.php">
              <input type="text" id="txtsearch" name="search" class="form-control" placeholder="Search products...">
              <a href= "search.php"><button  type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button></a>
            </form>

            <div class="user_option_box">
            <?php if(isset($_SESSION['uname']) ) { ?>
              <a href="myaccount.php" class="account-link">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                <?php
                 echo $_SESSION['uname']; ?>
                </span>
              </a>
             <?php } else { ?>
                <a href="login-register.php" class="account-link">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                MY ACCOUNT
                </span>
              </a>

             <?php } ?>
              <a href="cart.php" class="cart-link">
              
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Cart</span>
             </a>
             <a href="wishlist.php" class="wish-link">
              
                <i class="fa fa-heart" aria-hidden="true"></i>
                <span>Wishlist</span>
             </a>
              <a href="logout.php" class="out-link">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <span>
                  Logout
                </span>
              </a>
            </div>
          </div>

        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
          <?php
              require('conn.php');
              $sql = " SELECT * FROM header_setting ";
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) { 
          ?>
            <a class="navbar-brand" href="index">
            <img src="<?php echo "$row[logo]"?>" >
             
            </a>
            <?php } } ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
              <?php  require('conn.php');
                       $sql = "SELECT * FROM menu WHERE parent_id = 0 AND `menu_type`= 'header' ORDER BY display_order ASC";
                       $result = $conn->query($sql); 
                       if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {  
                         ?>
                         
                           <li class="nav-item">
                           <?php   $sql1 = " SELECT * FROM menu WHERE parent_id = '$row[ID]' AND `menu_type`= 'header' ORDER BY`display_order` ASC "; 
                             $result1 = $conn->query($sql1);
                              
                             if ($result1->num_rows > 0) {
                                $haschild = true;
                                $droparrow = '<i class="fa fa-caret-down" aria-hidden="true"></i>';
                             } else {
                                $haschild = false;
                                $droparrow = '';
                             }
                             ?>
                            <?php if($haschild == true) { echo '<div class="dropdown">'; ?>
                                    <div class="nav-link drop"  href="<?php echo "$row[url]" ?>"><?php echo "$row[text]"?> <?php echo $droparrow; ?></div> <?php }
                                    else{?>
                                      <a class="nav-link"  href="<?php echo "$row[url]" ?>"><?php echo "$row[text]"?> <?php echo $droparrow; ?></a> 
                                    <?php } ?>
                                   <?php  
                                   if ($result1->num_rows > 0) {
                                    echo '<div class="dropdown-content">';
                                   while($row1 = $result1->fetch_assoc()) {  ?>
                                    
                                    
                                    <a href="<?php echo "$row1[url]" ?>"><?php echo "$row1[text]"?></a>
                                    
                                    
                                     <?php } 
                                      echo '</div>';
                                    } ?>
                                     <?php if($haschild == true) { echo '</div>'; } ?>
                            </li>
                <?php } } ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>

    

