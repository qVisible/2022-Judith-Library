<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-publishers.php page once publisher has been updated-->
        <?php if(!empty($_POST['publisher_name'])){  ?>
        <meta http-equiv="refresh" content="0.5;URL='read-publishers.php'">
        <?php }  ?>
       
    </head>
    <body>
      <main>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
        <?php
        //recursive form handling
        if(!empty($_POST['publisher_name'])){
            $publisher_id=$_POST['publisher_id'];
			$publisher_name=$_POST['publisher_name'];


            /*
            This is book image handling code
            */
            $target_dir = "book-images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
            /*
            End of Book Image Handling Code
            */
     
            
            $sql='UPDATE t_publishers SET publisher_name="'.$publisher_name.'", publisher_image="'.$target_file.'" WHERE publisher_id='.$publisher_id;
                    
            if(mysqli_query($con,$sql)){
                echo 'Publisher '.$publisher_name.' has been updated';
            }
            else{
                echo "Error creating publisher record: " . mysqli_error($con);
            }
        }
        else{
		    //process publisher chosen by user to update
            $publisher_id=$_GET['publisher_id'];
        
            $sql='SELECT * FROM t_publishers WHERE publisher_id='.$publisher_id;

            $result=mysqli_query($con,$sql);     
        
            $rowPublishers=mysqli_fetch_array($result);
        
        ?>

       <h1>Update Publisher</h1>
       
       <form method="post" action="update-publisher.php"  enctype="multipart/form-data"> 
           <label>Publisher</label><input type="text" name="publisher_name" value="<?php echo $rowPublishers['publisher_name'] ?>">
		   
                      
           <!--Edit Book Image-->
           <label>publisher image:</label>
           <input type="file" name="fileToUpload" id="fileToUpload">

		   <!--pass publisher id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="publisher_id" value="<?php echo $publisher_id?>">         
           
           <input type="submit" value="Update publisher">
       </form>
        
        <?php }  ?>

       <?php mysqli_close($con); //close connection?>
      </main>
    </body>
</html>