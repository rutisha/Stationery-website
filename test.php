<?php
if(session_id() == '') {
    session_start();
  } 
 include 'header.php';
 ?>
 <h1>Hello User...</h1>
 <?php include 'footer.php'; ?>