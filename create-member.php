<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
        <!--Redirect back to read-members.php page once member has been updated-->
        <?php if(!empty($_POST['forename'])){  ?>
        <meta http-equiv="refresh" content="0.5;URL='read-members.php'">
        <?php }  ?>
    </head>
    <script src="main.js"></script>

    <body>
      
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
       
       
       <?php
        if(!empty($_POST['forename'])){
            $forename=$_POST['forename'];
            $surname=$_POST['surname'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $dob=$_POST['dob'];

            /*
            This is member image handling code
            */
            $target_dir = "member-images/";
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
            End of member Image Handling Code
            */
            
            $sql='INSERT INTO t_members (forename, surname, address, email, dob, member_image)
            VALUES ("'.$forename.'","'.$surname.'","'.$address.'", "'.$email.'","'.$dob.'","'.$target_file.'")';
            
            if(mysqli_query($con,$sql)){
                echo 'member '.$member_id.' has been created';
            }
            else{
                echo "Error creating member record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add member</h1>
       
       <form method="post" action="create-member.php"   enctype="multipart/form-data">
           <label>Forename</label><input type="text" name="forename" id="forename">
		   <label>Surname</label><input type="text" name="surname" id="surname">
           <label>Address</label><input type="text" name="address" id="address">
           <label>email</label><input type="email" name="email" id="email">
           <label>dob</label><input type="date" name="dob" id="dob">
		   <!--Allow user to add member image-->
           <label>member image</label>
           <input type="file" name="fileToUpload" id="fileToUpload">  
           
           <input type="submit" value="Add member">
       </form>

       
       <?php mysqli_close($con); //close connection?>
      </main>
    </body>
</html>