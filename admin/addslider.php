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

					<h1 class="h3 mb-3">Add Slider Page</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form action="" method="POST"  enctype="multipart/form-data" class="eform">
                                    <label for="url"><b>Url:</b></label> <br>
                                    <input type="text" name="url" id="url" required ><br><br><br>

                                    <label for="text"><b>Text:</b></label><br>
                                    <input type="text" name="txt" id="txt" required ><br><br><br>
                                     
									<label for="text"><b>Sub Title:</b></label><br>
                                    <input type="text" name="txt1" id="txt" required ><br><br><br>

                                     <b> Select image to upload:</b>
                                     <input type="file" name="fileToUpload" id="fileToUpload"><br> <br><br>
                                     

                                     <input type="submit" id="sub" name="Submit" value="Submit">

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
     
     $Url = $_REQUEST['url'];
     $Text = $_REQUEST['txt'];
	 $Sub_title = $_REQUEST['txt1'];
    
		$target_path = "img/photos/";  
		$target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
		   
		if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
						echo "File uploaded successfully!";  
			  } else{  
					 echo "Sorry, file not uploaded, please try again!";  
			  }

     $sql = "INSERT INTO `viewslider`(`ID`, `url`, `text`,`subtitle`, `image`) VALUES (NULL,'$Url','$Text','$Sub_title','$target_path')";
     if(mysqli_query($conn, $sql)){
        echo "Data stored in a successfully.";

        
    } else{
        echo "ERROR: Hush! Sorry $sql."
            . mysqli_error($conn);
    } }
    mysqli_close($conn);
         ?>
	<script src="js/app.js"></script>
