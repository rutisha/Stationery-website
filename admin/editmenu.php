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

					<h1 class="h3 mb-3">Edit Menu </h1>
                    <?php
                        $ID = $_GET["id"];
                        require('conn.php');
                        $sql1 = " SELECT * FROM menu WHERE ID ='$ID'";
                        $result1 = $conn->query($sql1);
                        $row1 = mysqli_fetch_array($result1); ?>

                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
                                <form action="" method="POST" enctype="multipart/form-data" class="eform">
                                    <label><b>Menu text:</b></label> <br>
                                    <input type="text" name="mtext" id="title" size="100" value="<?php  echo $row1["text"] ?>" required ><br><br><br>

                                    <label><b>URL:</b></label> <br>
                                    <input type="text" name="url" id="title" size="100" value="<?php  echo $row1["url"] ?>" required ><br><br> <br>

                                    <label><b>Orber Number:</b></label> <br>
                                    <input type="text" name="order" id="title" size="100" value="<?php echo $row1["display_order"] ?>" required ><br><br> <br>
                                     
                                    <input type="checkbox" name="parentid" id="parentid"  <?php if ($row1['parent_id'] != 0) { echo "checked='checked'"; } ?>>
                                    <label><b>- Select Parent</b></label> <br><br><br>

                                    <?php 
                                    require('conn.php');
                                     $sql = " SELECT * FROM menu WHERE parent_id = '0'";
                                     $result = $conn->query($sql);
                                     if ($result->num_rows > 0) {
                                        ?>
    
                                        <select id='parent' name="parent">
                                            <?php while($row = $result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row["ID"]; ?>" <?php if( $row["ID"] == $row1["parent_id"] ): ?> selected="selected"<?php endif; ?>><?php echo "$row[text]"?></option> <?php } ?>
                                        </select>  <br><br><br>
                                        <?php } ?>

                                    <label><b>Add Menu Type:</b></label> <br>
                                    <?php $selectedtype = $row1["menu_type"]; ?>
                                    <select name="type" id="parent"> 
                                           
                                           <option value="header" <?php if($selectedtype == 'header') { echo "selected"; } ?> >Header</option>
                                           <option value="footer" <?php if($selectedtype == 'footer') { echo "selected"; } ?>>Footer</option>
                                           
                                    </select> <br><br><br>


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
            <script src="js/jquery-3.4.1.min.js"></script>
            <script>
             jQuery(document).ready(($) => {
            if($('#parentid').is(':checked')){
             $('#parent').show(); 
            } 
             else {
                $('#parent').hide();
               
             }
            $('#parentid').bind('change', function () {
            if ($(this).is(':checked')) {
                $('#parent').show();
            } 
            else {
                $('#parent').hide();
            } 
            }); 
            
          
          });
           </script>
		</div>
	</div>
   
	<script src="js/app.js"></script>
    <?php
    require('conn.php');

    if(isset($_POST['Submit'])){
    
    $ID = $_GET['id'];
    $Menu_text = $_REQUEST['mtext'];
    $Url = $_REQUEST['url'];
    $Order =$_REQUEST['order'];
    $Menu_type = $_REQUEST['type'];

    if(isset($_POST['parentid']))
    {
        $Parent_ID = $_REQUEST['parent'];
        $sql = "UPDATE `menu` SET `text`= '$Menu_text',`url`= '$Url',`parent_id`= '$Parent_ID',`display_order`= '$Order',`menu_type`= '$Menu_type' WHERE `menu`.`ID`='$ID'";
        if(mysqli_query($conn, $sql)){
            echo "Data updated with parent ID successfully.";
          } else{
            echo "ERROR: Hush! Sorry $sql."
                . mysqli_error($conn);
        } 
    }
    else {
    $sql = "UPDATE `menu` SET `text`= '$Menu_text',`url`= '$Url',`parent_id`= DEFAULT ,`display_order`= '$Order',`menu_type`= '$Menu_type' WHERE `menu`.`ID`='$ID'";
    if(mysqli_query($conn, $sql)){
       echo "Data updated successfully.";
     } else{
       echo "ERROR: Hush! Sorry $sql."
           . mysqli_error($conn);
   } 
   }
}
     mysqli_close($conn);
     
    ?>
