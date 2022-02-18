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
        if(!empty($_POST['publisher_name'])){
            $publisher_name=$_POST['publisher_name'];
            
            $sql='INSERT INTO t_publishers (publisher_name)
            VALUES ("'.$publisher_name.'")';
            
            if(mysqli_query($con,$sql)){
                echo 'publisher '.$publisher_id.' has been created';
            }
            else{
                echo "Error creating publisher record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add publisher</h1>
       
       <form method="post" action="create-publisher.php"   enctype="multipart/form-data">
           <label>Publisher Name</label><input type="text" name="publisher_name" id="publisher_name">
		   
		   <!--Allow user to add publisher image-->
           <label>publisher image</label>
           <input type="file" name="fileToUpload" id="fileToUpload">  
           
           <input type="submit" value="Add publisher">
       </form>

       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>