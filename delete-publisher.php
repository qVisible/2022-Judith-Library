<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Delete Publisher</h1>
      
       <?php
            $publisher_id=$_GET['publisher_id'];
        
            $sql = 'DELETE FROM t_publishers WHERE publisher_id='.$publisher_id;

            if(mysqli_query($con,$sql)){
                echo 'publisher '.$publisher_id.' has been deleted';
            }
            else{
                echo "Error deleting publisher record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>