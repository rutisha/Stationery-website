<?php 
 $conn = mysqli_connect('localhost', 'root', 'root', 's4u');
 if(!$conn){
   die("Connection Failed: " . mysqli_connect_error());
 }
 
?>