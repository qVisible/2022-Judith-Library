<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <script src="main.js"></script>

    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       
       
       <?php
        if(!empty($_POST['title'])){
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
            
            $sql='INSERT INTO t_books (title, isbn, date_published, author_fk, publisher_fk,book_image)
            VALUES ("'.$title.'", "'.$isbn.'", "'.$date_published.'", '.$author_fk.','.$publisher_fk.',"'.$target_file.'")';
            
            if(mysqli_query($con,$sql)){
                echo 'Book '.$book_id.' has been created';
            }
            else{
                echo "Error creating Book record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add Book</h1>
       
       <form method="post" action="create-book.php"   enctype="multipart/form-data">
           <label>title</label><input type="text" name="title" id="title">
           <label>isbn</label><input type="number" name="isbn" onfocusout="getBookDetails(this.value)">
           <label>date published</label><input type="date" name="date_published" id="date_published">
           
           
           <!--Create Authors Dropdown Menu-->
           <label>authors</label>
           <select name="author_fk" id="authors">
           <?php
               //populate the drop down menu from the authors table
               $sql='SELECT * FROM t_authors';

               $result=mysqli_query($con,$sql);

               while ($row=mysqli_fetch_array($result)){
                    echo '<option value="'.$row['author_id'].'">'.$row['author_name'].'</option>';
               }
           ?>
           </select>
           <!--end of Authors Dropdown Menu-->


           
           <!--Create Publishers Dropdown Menu-->
           <label>publishers</label>
           <select  name="publisher_fk"  id="publishers">>
           <?php
               //populate the drop down menu from the publishers table
               $sql='SELECT * FROM t_publishers';

               $result=mysqli_query($con,$sql);

               while ($row=mysqli_fetch_array($result)){
                    echo '<option value="'.$row['publisher_id'].'">'.$row['publisher_name'].'</option>';
               }
           ?>
           </select>
           <!--end of Publishers Dropdown Menu-->
           
           
           
           <input type="submit" value="Add Book">
       </form>

       <section class="media book showcase" data-isbn="1739972600">
  <header>
    <h3 class="title"></h3>
    <h4 class="author"></h4>
  </header>

  <img src="" alt="" class="thumbnail" />  
    
</section>
       
       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>