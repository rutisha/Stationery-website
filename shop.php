<?php
session_start();

$id = $_GET['id'];
$new_value =$_GET['value'];
$total = 0;
foreach($_SESSION['cart'] as $k=>$v)
{

    $k;
    $v["product_id"];
    $v["item_quantity"];
    if($id == $v["product_id"])
    {
        //assign new value to the quantity
        $_SESSION['cart'][$k]['item_quantity']=$new_value;
    }
    $Sub_Total = $v["product_price"] * $new_value; 
    $total = $total + ($v["product_price"]*$v["item_quantity"]);
}
 
 if($total<50) { ?>
    <?php echo $total+ 10; ?>
<?php  } else { ?>
    <?php echo $total; ?>
<?php } ?>