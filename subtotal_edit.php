<?php
session_start();

$id = $_GET['id'];
$new_value =$_GET['value'];
foreach($_SESSION['cart'] as $key => $val)
{
    if($id == $val["product_id"])
    {
        $Sub_Total = $val["product_price"] * $new_value; 
    }   
}    
?>
Rs <?php echo $Sub_Total; ?>

