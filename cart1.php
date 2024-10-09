<?php
session_start();

$id = $_GET['id'];
$new_value =$_GET['value'];
foreach($_SESSION['cart'] as $k=>$v)
{
    
    $k;
    $v["product_id"];
    $v["item_quantity"];
    if($id == $v["product_id"])
    {
        
        //assign new value to the quantity
        $_SESSION['cart'][$k]['item_quantity']=$new_value;
        $_SESSION['cart'][$k]['grand_total']= $v['product_price'] * $new_value;
    }
    else{
    
        if(isset($_SESSION["cart"])) {
            $ID = $_GET["id"];
            require('conn.php');
            $sql = "SELECT * FROM `products` WHERE ID = $ID";
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                       $name = "$row[product_name]";
                       $image = "$row[product_image]";
                       $price = "$row[product_price]";
                       $quantity = $new_value;
                       $code = "";
                       $percent = "0";
                       $ID = $row["ID"];
    
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
                       'product_image' => $image
                   ); 
                   $_SESSION["cart"][$count] = $item_array;
                //  echo '<script>window.location="cart.php"</script>';
               } 
               else {
                  // echo '<script>alert("Products already added to cart")</script>';
                   //echo '<script>window.location="cart.php"</script>';
               }
           } else {
                   $item_array = array(
                       'product_id' => $ID,
                       'item_name' => $name,
                       'product_price' => $price,
                       'item_quantity' => $quantity,
                       'discount' => $code,
                       'percent' => $percent,
                       'product_image' => $image
                   );
                   $_SESSION["cart"][0] = $item_array;
           }
    }
  
}
print_r($_SESSION["cart"]);

    $ID = $_GET["id"];
    require('conn.php');
    $sql = "SELECT * FROM `products` WHERE ID = $ID";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
               $name = "$row[product_name]";
               $image = "$row[product_image]";
               $price = "$row[product_price]";
               $quantity = $new_value;
               $code = "";
               $percent = "0";
               $sum = $quantity * $price;
               $ID = $row["ID"];

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

 ?>
