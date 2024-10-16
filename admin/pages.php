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

					<h1 class="h3 mb-3">Add Pages</h1>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form action="" method="POST" enctype="multipart/form-data" class="eform">
                                    <label for="title"><b>Title:</b></label> <br>
                                    <input type="text" name="title" id="title" size="100" required ><br><br><br>

                                    <label for="content"><b>Content:</b></label> <br>
                                    <textarea id="content" name="content" type="text" rows="10" cols="76"></textarea><br><br> <br>
                                     
                                   
                                    <b> Select image to upload: </b>
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
            <?php
     require('conn.php');
     if(isset($_POST['Submit'])){
     
        function slugify($slug){
            $newslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug), '-'));
            return $newslug;
        }
    

     $Title = $_REQUEST['title'];
     $slug = slugify($Title);
     $Content = $_POST['content'];
     
     $target_path = "img/photos/";  
		$target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
		   
		if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
						//echo "File uploaded successfully!";  
			  } else{  
					 echo "Sorry, file not uploaded, please try again!";  
			  }

    
     $text1=mysqli_real_escape_string($conn,$Content);
     $sql = "INSERT INTO `pages`(`ID`, `title`, `content`, `image`, `slug`) VALUES (NULL,'$Title','$text1','$target_path','$slug')";
     if(mysqli_query($conn, $sql)){
        echo "Data stored in a successfully.";

        
    } else{
        echo "ERROR: Hush! Sorry $sql."
            . mysqli_error($conn);
    } }
    mysqli_close($conn);
         ?>
		</div>
	</div>

	<script src="js/app.js"></script>
 