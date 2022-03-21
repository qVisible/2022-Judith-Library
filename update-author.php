<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-authors.php page once author has been updated-->
        <?php if(!empty($_POST['author_name'])){  ?>
        <meta http-equiv="refresh" content="0.5;URL='read-authors.php'">
        <?php }  ?>
       
    </head>
    <body>
      <main>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
        <?php
        //recursive form handling
        if(!empty($_POST['author_name'])){
            $author_id=$_POST['author_id'];
			$author_name=$_POST['author_name'];


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
     
            
            $sql='UPDATE t_authors SET author_name="'.$author_name.'", author_image="'.$target_file.'" WHERE author_id='.$author_id;
                    
            if(mysqli_query($con,$sql)){
                echo 'Author '.$author_name.' has been updated';
            }
            else{
                echo "Error creating author record: " . mysqli_error($con);
            }
        }
        else{
		    //process author chosen by user to update
            $author_id=$_GET['author_id'];
        
            $sql='SELECT * FROM t_authors WHERE author_id='.$author_id;

            $result=mysqli_query($con,$sql);     
        
            $rowAuthors=mysqli_fetch_array($result);
        
        ?>

       <h1>Update Author</h1>
       
       <form method="post" action="update-author.php"  enctype="multipart/form-data"> 
           <label>Author</label><input type="text" name="author_name" value="<?php echo $rowAuthors['author_name'] ?>">
		   
                      
           <!--Edit Book Image-->
           <label>author image:</label>
           <input type="file" name="fileToUpload" id="fileToUpload">

		   <!--pass author id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="author_id" value="<?php echo $author_id?>">         
           
           <input type="submit" value="Update author">
       </form>
        
        <?php }  ?>

       <?php mysqli_close($con); //close connection?>
      </main>
    </body>
</html>