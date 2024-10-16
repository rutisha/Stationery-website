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

					<h1 class="h3 mb-3">Add Slider </h1>
                    <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql = " SELECT * FROM viewslider WHERE ID ='$ID'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result); ?>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form method="POST" action=""  enctype="multipart/form-data" class="eform">
                                    <label for="url"><b>Url:</b></label> <br>
                                    <input type="text" name="url" id="url"  value="<?php echo "$row[url]"?>" required ><br><br><br>

                                    <label for="text"><b>Text:</b></label> <br>
                                    <input type="text" name="txt" id="txt" value="<?php echo "$row[text]"?>"required ><br><br><br>

                                    <label for="text"><b>Sub Title:</b></label><br>
                                    <input type="text" name="txt1" id="txt"value="<?php echo "$row[subtitle]"?>" required ><br><br><br>
                                     
                                    
                                     <b> Select image to upload: </b>
                                     <input type="file" name="fileToUpload" id="fileToUpload"><br> <br>
                                     <img src="../<?php echo $row['image']; ?>"width="275" height="200" ><br> <br> <br>
                                    

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
    if(isset($_POST['Submit'])){
      
     $ID = $_GET['id'];
     $Url = $_REQUEST['url'];
     $Text = $_REQUEST['txt'];
     $Sub_title = $_REQUEST['txt1'];

     $target_path = "img/photos/";  
        $target_path = $target_path.basename( $_FILES['fileToUpload']['name']); 
        if(!empty($_FILES['fileToUpload']['name'])) //new image uploaded
        {
          $sql1 ="UPDATE `viewslider` SET `ID`= '$ID',`url`='$Url',`text`= '$Text',`subtitle`= '$Sub_title',`image`= '$target_path' WHERE `viewslider`.`ID`='$ID' ";
        }
        else{
            $sql1 ="UPDATE `viewslider` SET `ID`= '$ID',`url`='$Url',`text`= '$Text',`subtitle`= '$Sub_title' WHERE `viewslider`.`ID`='$ID' ";
        
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
