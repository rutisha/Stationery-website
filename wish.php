<?php

session_start();
$id = $_GET['id'];


        $ID = $_GET["id"];
        require('conn.php');
        $sql = "SELECT * FROM `products` WHERE ID = $ID";
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
                   $name = "$row[product_name]";
                   $image = "$row[product_image]";
                   $price = "$row[product_price]";
                   $quantity = "1";
                   $ID = $row["ID"];

           }}
          
          $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
          if(!in_array($ID, $item_array_id)) {

              
               $count = count($_SESSION["wishlist"]);
               
               $item_array = array(
                   'product_id' => $ID,
                   'product_name' => $name,
                   'product_price' => $price,
                   'item_quantity' => $quantity,
                   'product_image' => $image
               ); 
               $_SESSION["wishlist"][$count] = $item_array;
             // echo '<script>window.location="wishlist.php"</script>';
           } 
           
     
if(isset($_SESSION["wishlist"])) {
require('conn.php');
// Check connection
if($conn === false){
die("ERROR: Could not connect. "    . mysqli_connect_error());
}
$Userid = $_SESSION["ID"];
$Wishlist = $_SESSION["wishlist"];
//print_r($_SESSION["wishlist"]);
$Data = serialize($Wishlist);
    
$sql2 ="SELECT * FROM `wishlist` WHERE userid = $Userid";
$result = mysqli_query($conn,$sql2);
if(mysqli_num_rows($result) > 0){
   $sql1= "UPDATE `wishlist` SET `wishlist_data`= '$Data' WHERE `wishlist`.`userid`='$Userid'";
  if(mysqli_query($conn,$sql1)){
    // echo "ok";
  }
  else{echo "ERROR: Hush! Sorry $sql1."    . mysqli_error($conn);}
}
else{
  $sql = "INSERT INTO `wishlist`(`ID`, `userid`, `wishlist_data`) VALUES (NULL,'$Userid','$Data')"; 
      if(mysqli_query($conn, $sql)){ 
        // echo "Inserted";
     }   
     else{     echo "ERROR: Hush! Sorry $sql." . mysqli_error($conn); }  
} }
?>

<?php echo $id ?>


