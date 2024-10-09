<?php
session_start();

$id = $_GET['id'];
require('conn.php');
    $sql = "SELECT * FROM `products` WHERE ID = $id";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
               $name = "$row[product_name]";
               $image = "$row[product_image]";
               $price = "$row[product_price]";
               $quantity = "1";
               $code = "";
               $percent = "0";
               $sum = $quantity * $price;
               $ID = $id;

       }}
      
      $item_array_id = array_column($_SESSION["cart"], 'product_id'); 
      if(!in_array($ID, $item_array_id)) {

          
           $count = count($_SESSION["cart"]);
           
           $item_array = array(
               'product_id' => $ID,
               'product_name' => $name,
               'product_price' => $price,
               'item_quantity' => $quantity,
               'discount' => $code,
               'percent' => $percent,
                'grand_total' => $sum,
               'product_image' => $image
           ); 
           $_SESSION["cart"][$count] = $item_array;
        //  echo '<script>window.location="cart.php"</script>';
       } 
       else {
          // echo '<script>alert("Products already added to cart")</script>';
           //echo '<script>window.location="cart.php"</script>';
       }

print_r($_SESSION['cart']);