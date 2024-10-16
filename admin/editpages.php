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

					<h1 class="h3 mb-3">Edit Page Details </h1>
                    <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql1 = " SELECT * FROM pages WHERE ID ='$ID'";
                        $result1 = $conn->query($sql1);
                        $row1 = mysqli_fetch_array($result1); ?>

                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <form action="" method="POST" enctype="multipart/form-data" class="eform">
                                <label for="title"><b>Title:</b></label> <br>
                                    <input type="text" name="title" id="title" size="100" value="<?php echo "$row1[title]" ?>" required ><br><br><br>

                                    <label for="content"><b>Content:</b></label> <br>
                                    <textarea id="content" name="content" type="text" rows="10" cols="76" ><?php echo "$row1[content]" ?></textarea><br><br> <br>
                                     
                                   
                                    <img src="../<?php echo "$row1[image]" ?>" width="180px" height="120px" > <br> <br>
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
		</div>
	</div>
   
	<script src="js/app.js"></script>
    <?php
    require('conn.php');
    $ID = $_GET['id'];
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
        
     

    $text1=mysqli_real_escape_string($conn,$Content);
    
    $target_path = "img/photos/";  
    $target_path = $target_path.basename( $_FILES['fileToUpload']['name']); 
    if(!empty($_FILES['fileToUpload']['name'])) //new image uploaded
    {
      $sql1 ="UPDATE `pages` SET `ID`= '$ID',`title`= '$Title',`content`= '$Content',`image`= '$target_path',`slug`= '$slug' WHERE `pages`.`ID`='$ID' ";
    }
    else{
        $sql1 ="UPDATE `pages` SET `ID`= '$ID',`title`= '$Title',`content`= '$Content',`slug`= '$slug' WHERE `pages`.`ID`='$ID' ";
    
    }
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
        //"File uploaded successfully!";  
   } else{  
     // "Sorry, file not uploaded, please try again!";  
    }
    if(mysqli_query($conn, $sql1)){
        echo "Data Updated Successfully<br>";
    } else{
        echo "ERROR: Hush! Sorry $sql1. "
            . mysqli_error($conn); }
   }


     mysqli_close($conn);
     
    ?>
