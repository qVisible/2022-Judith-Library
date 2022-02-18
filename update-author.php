<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
       
        <!--Redirect back to read-authors.php page once author has been updated-->
        <?php if(!empty($_POST['author_name'])){  ?>
        <meta http-equiv="refresh" content="1;URL='read-authors.php'">
        <?php }  ?>
       
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
        <?php
        //recursive form handling
        if(!empty($_POST['author_name'])){
            $author_id=$_POST['author_id'];
			$author_name=$_POST['author_name'];
     
            
            $sql='UPDATE t_authors SET author_name="'.$author_name.'" WHERE author_id='.$author_id;
                    
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
       
       <form method="post" action="update-author.php">
           <label>Author</label><input type="text" name="author_name" value="<?php echo $rowAuthors['author_name'] ?>">
		   
		   <!--pass author id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="author_id" value="<?php echo $author_id?>">         
           
           <input type="submit" value="Update author">
       </form>
        
        <?php }  ?>

       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>