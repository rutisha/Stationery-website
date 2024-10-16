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

					<h1 class="h3 mb-3">Add Products</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <form action="" method="GET" enctype="multipart/form-data">
                                    <label for="product_name"><b>Product Name:</b></label>
                                    <input type="text" name="pname" id="pname" required ><br><br>

                                    <label for="product_price"><b>Product Price:</b></label>
                                    <input type="number" name="price" id="price" required ><br><br>

                                    <label for="product_qty"><b>Product Quantity:</b></label>
                                    <input type="number" name="qty" id="qty" required ><br><br>

                                     <label for="product_des"><b>Product Description:</b></label> <br>
                                     <textarea id="des" name="des" type="text" rows="5" cols="70"></textarea><br><br>

                                    
                                     <b>Select image to upload:</b>
                                     <input type="file" name="fileToUpload" id="fileToUpload"><br> <br>
                                     <input type="submit" name="submit" value="submit">
                                      
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
     $conn = mysqli_connect("localhost", "root", "root", "s4u");
      
     if($conn === false){
         die("ERROR: Could not connect. "
             . mysqli_connect_error()); }

             function slugify($slug){
                $newslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug), '-'));
                return $newslug;
            }
      
     $ID = $_GET['id'];
     $Product_Name = $_REQUEST['pname'];
     $Product_Price = $_REQUEST['price'];
     $Product_Qty =  $_REQUEST['qty'];
     $Product_Category =  $_REQUEST['ctg'];
     $Product_Des = $_REQUEST['des'];
     $slug = slugify($Product_Name);
     
    
        $target_path = "img/photos/";  
        $target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
           
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
                        //"File uploaded successfully!";  
              } else{  
                     // "Sorry, file not uploaded, please try again!";  
              }
            
     $sql ="UPDATE `products` SET `ID`= '$ID',`product_name`= '$Product_Name',`product_price`= '$Product_Price',`product_qty`= '$Product_Qty',
     `product_image`= '$target_path',`product_category`= '$Product_Category',`description`= '$Product_Des',`slug`= '$slug' WHERE `products`.`ID`='$ID' ";

     if(mysqli_query($conn, $sql)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn); }
      
     mysqli_close($conn);
     
    ?>
	<script src="js/app.js"></script>
