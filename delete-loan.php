<html> 
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
        <meta http-equiv="refresh" content="0.5;URL='read-loans.php'">
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Delete Loan</h1>
      
       <?php
            $loan_id=$_GET['loan_id'];
        
            $sql = 'DELETE FROM t_loans WHERE loan_id='.$loan_id;

            if(mysqli_query($con,$sql)){
                echo 'Loan '.$loan_id.' has been deleted';
            }
            else{
                echo "Error deleting Loan record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>