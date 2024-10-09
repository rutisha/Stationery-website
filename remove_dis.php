<?php 
session_start();

$id = $_GET['id'];
$sum = $_GET['sum'];

foreach($_SESSION["cart"] as $keys => $values) {
        $_SESSION['cart'][$keys]['discount']="";
        $_SESSION['cart'][$keys]['percent'] =0;
        $total = $total + ($values["product_price"]*$values["item_quantity"]);
        $_SESSION['cart'][$keys]['grand_total'] = $total;

        $_SESSION["cart"] = array_merge($_SESSION["cart"]); 
}
?>

<div class="deliv">
<div class="col">Discount: <?php  ?></div>
<div class="del_display"> <?php  echo "- 0 %"; ?> </div>
</div>

