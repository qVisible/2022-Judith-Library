<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Delete Author</h1>
      
       <?php
            $author_id=$_GET['author_id'];
        
            $sql = 'DELETE FROM t_authors WHERE author_id='.$author_id;

            if(mysqli_query($con,$sql)){
                echo 'author '.$author_id.' has been deleted';
            }
            else{
                echo "Error deleting author record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>