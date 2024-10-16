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
									<form action="" method="POST" enctype="multipart/form-data" class="pform">
                                    <label for="product_name"><b>Product Name:</b></label>
                                    <label for="product_price" id="ptitle"><b>Product Price:</b></label> <br>
                                    <input type="text" name="pname" id="pname" required >
                                    &nbsp &nbsp &emsp; &emsp;  &nbsp &nbsp &emsp; &emsp;
                                    <input type="number" name="price" id="price" required ><br><br><br>

                                    <label for="product_qty"><b>Product Quantity:</b></label>
                                    <input type="number" name="qty" id="qty" required >
                                    &nbsp &nbsp &emsp; &emsp;  &nbsp &nbsp &emsp; &emsp;

                        
                                   
                                     
                                     <label for="product_des"><b>Product Description:</b></label> <br>
                                     <textarea id="des" name="des" type="text" rows="5" cols="90"></textarea><br><br><br>

                                    
                                     <b>Select image to upload:</b>
                                     <input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload"><br> <br> <br>
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
  
    $target_path = "img/photos/";  
    $target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
       
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
                    echo "File uploaded successfully!";  
          } else{  
                 echo "Sorry, file not uploaded, please try again!";  
          }
     
     $Product_name = $_REQUEST['pname'];
     $Product_price = $_REQUEST['price'];
     $Product_qty = $_REQUEST['qty']; 
     $Product_des = $_POST['des'];
     $slug = slugify($Product_name);


     $sql = "INSERT INTO `products`(`ID`, `product_name`, `product_price`, `product_qty`,`product_image`, `description`, `slug`)
     VALUES (NULL,'$Product_name','$Product_price','$Product_qty','$target_path','$Product_des','$slug')";
     if(mysqli_query($conn, $sql)){
        echo "Data stored in a successfully.";

        
    } else{
        echo "ERROR: Hush! Sorry $sql."
            . mysqli_error($conn);
    } 
   
       
    }

    mysqli_close($conn);
         ?>

<script src="js/app.js"></script>

	

