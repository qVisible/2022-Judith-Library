<html> 
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Delete Book</h1>
      
       <?php
            $book_id=$_GET['book_id'];
        
            $sql = 'DELETE FROM t_books WHERE book_id='.$book_id;

            if(mysqli_query($con,$sql)){
                echo 'Book '.$book_id.' has been deleted';
            }
            else{
                echo "Error deleting Book record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>