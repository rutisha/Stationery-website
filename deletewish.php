<?php
session_start();
$id = $_GET['id'];

       if(isset($_SESSION["wishlist"])) {
        foreach($_SESSION["wishlist"] as $keys => $values) {
            if($values["product_id"] == $_GET["id"]) {
                unset($_SESSION["wishlist"][$keys]);
               //  echo '<script>alert("Product has been removed")</script>';
                //echo '<script>window.location="wishlist.php"</script>';
                $_SESSION["wishlist"] = array_merge($_SESSION["wishlist"]); 
            }
        }
       }
     

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
}
?>

<?php echo $id ?>


