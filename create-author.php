<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">   
        <!--Redirect back to read-authors.php page once author has been updated-->
        <?php if(!empty($_POST['author_name'])){  ?>
        <meta http-equiv="refresh" content="0.5;URL='read-authors.php'">
        <?php }  ?>
    </head>
    <script src="main.js"></script>

    <body>
      <main>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       
       
       <?php
        if(!empty($_POST['author_name'])){
            $author_name=$_POST['author_name'];

            /*
            This is author image handling code
            */
            $target_dir = "author-images/";
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
            End of author Image Handling Code
            */
            
            $sql='INSERT INTO t_authors (author_name, author_image)
            VALUES ("'.$author_name.'", "'.$target_file.'")';
            
            echo $sql;
            
            if(mysqli_query($con,$sql)){
                echo 'author '.$author_id.' has been created';
            }
            else{
                echo "Error creating author record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add author</h1>
       
       <form method="post" action="create-author.php"   enctype="multipart/form-data">
           <label>Author Name</label><input type="text" name="author_name" id="author_name">
		   
		   <!--Allow user to add author image-->
           <label>author image</label>
           <input type="file" name="fileToUpload" id="fileToUpload">  
           
           <input type="submit" value="Add author">
       </form>

       
       <?php mysqli_close($con); //close connection?>
      </main>
    </body>
</html>