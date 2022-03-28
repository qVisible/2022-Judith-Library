<html> 
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
        <meta http-equiv="refresh" content="1;URL='read-books-copies.php'">  
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Create Copy</h1>
      
       <?php
            $book_id=$_GET['book_id'];
        
            $sql = 'INSERT INTO t_copies (book_fk) VALUES ("'.$book_id.'")';

            if(mysqli_query($con,$sql)){
                echo 'Copy Created.';
            }
            else{
                echo "Error creating copy record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>