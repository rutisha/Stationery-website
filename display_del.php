<?php
session_start();


 $id = $_GET['id'];
$new_value =$_GET['value'];
$total = 0;
foreach($_SESSION['cart'] as $key => $val)
    {
        $Sub_Total = $val["product_price"] * $new_value; 
        $total = $total + ($val["product_price"]*$val["item_quantity"]);
    } 
 if($total<150) { ?>
    <div class="col">Delivery Charge: </div>
    <div class="del_display"> <?php  echo "+ Rs 20"; ?> </div>
         <?php  } else {} ?>

