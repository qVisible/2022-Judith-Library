<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-members.php page once member has been updated-->
        <?php if(!empty($_POST['forename'])){  ?>
        <meta http-equiv="refresh" content="0.5;URL='read-members.php'">
        <?php }  ?>
       
    </head>
    <body>
      
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
        <?php
        //recursive form handling
        if(!empty($_POST['forename'])){
            $member_id=$_POST['member_id'];
			$forename=$_POST['forename'];
            $surname=$_POST['surname'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $dob=$_POST['dob'];

            /*
            This is book image handling code
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
            End of Book Image Handling Code
            */
     
            
            $sql='UPDATE t_members SET forename="'.$forename.'",
            surname="'.$surname.'",address="'.$address.'",
            email="'.$email.'",dob="'.$dob.'", member_image="'.$target_file.'" WHERE member_id='.$member_id;
                    
            if(mysqli_query($con,$sql)){
                echo 'Member '.$forename.' '.$surname.' has been updated';
            }
            else{
                echo "Error creating member record: " . mysqli_error($con);
            }
        }
        else{
		    //process member chosen by user to update
            $member_id=$_GET['member_id'];
        
            $sql='SELECT * FROM t_members WHERE member_id='.$member_id;

            $result=mysqli_query($con,$sql);     
        
            $rowMembers=mysqli_fetch_array($result);
        
        ?>

       <h1>Update Member</h1>
       
       <form method="post" action="update-member.php"  enctype="multipart/form-data"> 
           <label>Forename</label><input type="text" name="forename" value="<?php echo $rowMembers['forename'] ?>">
		   <label>Surname</label><input type="text" name="surname" value="<?php echo $rowMembers['surname'] ?>">
           <label>Address</label><input type="text" name="address" value="<?php echo $rowMembers['address'] ?>"> 
           <label>Email</label><input type="email" name="email" value="<?php echo $rowMembers['email'] ?>"> 
           <label>DOB</label><input type="date" name="dob"  value="<?php echo $rowMembers['dob'] ?>">          
           <!--Edit Book Image-->
           <label>member image:</label>
           <input type="file" name="fileToUpload" id="fileToUpload">

		   <!--pass member id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="member_id" value="<?php echo $member_id?>">         
           
           <input type="submit" value="Update member">
       </form>
        
        <?php }  ?>

       <?php mysqli_close($con); //close connection?>
      </main>
    </body>
</html>