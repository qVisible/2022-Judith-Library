<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-publishers.php page once publisher has been updated-->
        <?php if(!empty($_POST['publisher_name'])){  ?>
        <meta http-equiv="refresh" content="1;URL='read-publishers.php'">
        <?php }  ?>
       
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
        <?php
        //recursive form handling
        if(!empty($_POST['publisher_name'])){
            $publisher_id=$_POST['publisher_id'];
			$publisher_name=$_POST['publisher_name'];
     
            
            $sql='UPDATE t_publishers SET publisher_name="'.$publisher_name.'" WHERE publisher_id='.$publisher_id;
                    
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
       
       <form method="post" action="update-publisher.php">
           <label>Publisher</label><input type="text" name="publisher_name" value="<?php echo $rowPublishers['publisher_name'] ?>">
		   
		   <!--pass publisher id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="publisher_id" value="<?php echo $publisher_id?>">         
           
           <input type="submit" value="Update publisher">
       </form>
        
        <?php }  ?>

       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>