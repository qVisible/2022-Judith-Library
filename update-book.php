<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-books.php page once book has been updated-->
        <?php if(!empty($_POST['title'])){  ?>
        <meta http-equiv="refresh" content="1;URL='read-books.php'">
        <?php }  ?>
       
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       

        
        <?php
        //recursive form handling
        if(!empty($_POST['title'])){
            $book_id=$_POST['book_id'];
			$title=$_POST['title'];
            $isbn=$_POST['isbn'];
            $date_published=$_POST['date_published'];
            $author_fk=$_POST['author_fk'];
            $publisher_fk=$_POST['publisher_fk'];



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
            
            $sql='UPDATE t_books SET title="'.$title.'", isbn="'.$isbn.'", date_published="'.$date_published.'", author_fk='.$author_fk.', publisher_fk='.$publisher_fk.', book_image="'.$target_file.'" WHERE book_id='.$book_id;
                    
            if(mysqli_query($con,$sql)){
                echo 'Book '.$title.' has been updated';
            }
            else{
                echo "Error creating Book record: " . mysqli_error($con);
            }
        }
        

         else{
		    //process book chosen by user to update
            $book_id=$_GET['book_id'];
        
            $sql='SELECT * FROM t_books WHERE book_id='.$book_id;

            $result=mysqli_query($con,$sql);     
        
            $rowBooks=mysqli_fetch_array($result);
        
        ?>

       
  
       <h1>Update Book</h1>
       
       <form method="post" action="update-book.php"   enctype="multipart/form-data">
           <label>title</label><input type="text" name="title" value="<?php echo $rowBooks['title'] ?>">
           <label>isbn</label><input type="number" name="isbn"  value="<?php echo $rowBooks['isbn'] ?>">
           <label>date published</label><input type="date" name="date_published"  value="<?php echo $rowBooks['date_published'] ?>">
           
           
           <!--Create Authors Dropdown Menu-->
           <label>authors</label>
           <select name="author_fk">
           <?php
               //populate the drop down menu from the authors table
               $sql='SELECT * FROM t_authors';

               $result=mysqli_query($con,$sql);

               while ($rowAuthors=mysqli_fetch_array($result)){
                   
                   echo '<option value="'.$rowAuthors['author_id'].'"';
                   if($rowAuthors['author_id']==$rowBooks['author_fk']){
                       echo ' selected ';
                   }
                   echo '>';
                   echo $rowAuthors['author_name'].'</option>'.PHP_EOL;
                   
               }
           ?>
           </select>
           <!--end of Authors Dropdown Menu-->
           
           
           
           
           
           <!--Create Publishers Dropdown Menu-->
           <label>publishers</label>
           <select  name="publisher_fk">
           <?php
               //populate the drop down menu from the publishers table
               $sql='SELECT * FROM t_publishers';

               $result=mysqli_query($con,$sql);

               while ($rowPublishers=mysqli_fetch_array($result)){
                   echo '<option value="'.$rowPublishers['publisher_id'].'"';
                   if($rowPublishers['publisher_id']==$rowBooks['publisher_fk']){
                       echo ' selected ';
                   }
                   echo '>';
                   echo $rowPublishers['publisher_name'].'</option>'.PHP_EOL;
               }
           ?>
           </select>
           <!--end of Publishers Dropdown Menu-->
           
           <!--Edit Book Image-->
           <label>book image:</label>
           <input type="file" name="fileToUpload" id="fileToUpload">
		   
		   <!--pass book id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="book_id" value="<?php echo $book_id?>">         
           
           
           <input type="submit" value="Update Book">
       </form>
        
        <?php }  ?>
       
       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>