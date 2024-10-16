<?php  
session_start(); 
  
?>  

<?php  if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  ?>


	<?php include('header.php'); ?>

     <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit Products</h1>
                    <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql = " SELECT * FROM products WHERE ID ='$ID'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result); ?>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <form action="" method="POST" enctype="multipart/form-data" class="pform">
                                    <label for="product_name"><b>Product Name:</b></label> 
                                    <label for="product_price" id="ptitle"><b>Product Price:</b></label> <br>
                                    <input type="text" name="pname" id="pname" value="<?php echo "$row[product_name]"?>" required > 
                                    &nbsp &nbsp &emsp; &emsp;  &nbsp &nbsp &emsp; &emsp;
                                    <input type="number" name="price" id="price" value="<?php echo "$row[product_price]"?>"required ><br><br><br>

                                    <label for="product_qty"><b>Product Quantity:</b></label>
                                    <input type="number" name="qty" id="qty" value="<?php echo "$row[product_qty]"?>"required >
                                    &nbsp &nbsp &emsp; &emsp;  &nbsp &nbsp &emsp; &emsp;
                                    
                                    
                                     <label for="product_des"><b>Product Description:</b></label> <br>
                                     <textarea id="des" name="des" type="text" rows="5" cols="90"><?php echo "$row[description]"?></textarea><br><br> <br>
                                     
                                   
                                    <b> Select image to upload: </b>
                                     <input type="file" name="fileToUpload" id="fileToUpload">
                                     <img src="../<?php echo $row['product_image']; ?>"width="150" height="130" ><br> <br> <br>
                                    
                                     <input type="submit" id="submit" name="Submit" value="Submit">

                                    </form>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

		<?php include('footer.php'); ?>
		</div>
	</div>
    <?php
     require('conn.php');
             
    if(isset($_POST['Submit'])){

             function slugify($slug){
                $newslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug), '-'));
                return $newslug;
            }
      
     $ID = $_GET['id'];
     $Product_Name = $_REQUEST['pname'];
     $Product_Price = $_REQUEST['price'];
     $Product_Qty =  $_REQUEST['qty'];
     $Product_Des = $_REQUEST['des'];
     $slug = slugify($Product_Name);
     
    
        $target_path = "img/photos/";  
        $target_path = $target_path.basename( $_FILES['fileToUpload']['name']); 
        if(!empty($_FILES['fileToUpload']['name'])) //new image uploaded
        {
             $sql = "UPDATE `products` SET `ID`= '$ID',`product_name`= '$Product_Name',`product_price`= '$Product_Price',`product_qty`= '$Product_Qty',
             `product_image`= '$target_path',`description`= '$Product_Des',`slug`= '$slug' WHERE `products`.`ID`='$ID' ";
        }
        else 
        {
             $sql = "UPDATE `products` SET `ID`= '$ID',`product_name`= '$Product_Name',`product_price`= '$Product_Price',`product_qty`= '$Product_Qty',
            `description`= '$Product_Des',`slug`= '$slug' WHERE `products`.`ID`='$ID' ";
        }        
           
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
                        //"File uploaded successfully!";  
              } else{  
                     // "Sorry, file not uploaded, please try again!";  
              }
            
    if(mysqli_query($conn, $sql)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn); }
    } 
     mysqli_close($conn);
     
    ?>
	<script src="js/app.js"></script>
    
	

</body>

</html>