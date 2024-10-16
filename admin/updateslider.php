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
									<form action="" method="GET" enctype="multipart/form-data">
                                    <label for="url"><b>Url:</b></label>
                                    <input type="text" name="url" id="url" required ><br><br>

                                    <label for="text"><b>Text:</b></label>
                                    <input type="text" name="txt" id="txt" required ><br><br>
                                     
                                    
                                     <b> Select image to upload: </b>
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
    require('conn.php');
     $ID = $_GET['id'];
     $Url = $_REQUEST['url'];
     $Text = $_REQUEST['txt'];
     $Filename =  $_REQUEST['fileToUpload'];
    
     $sql ="UPDATE `viewslider` SET `ID`= '$ID',`url`='$Url',`text`= '$Text',`image`= '$Filename' WHERE `viewslider`.`ID`='$ID' ";

     if(mysqli_query($conn, $sql)){
         echo "Data Updated Successfully<br>";
     } else{
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn); }
      
     mysqli_close($conn);
     
    ?>
	<script src="js/app.js"></script>
