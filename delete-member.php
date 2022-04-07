<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">   
        <meta http-equiv="refresh" content="0.5;URL='read-members.php'">
    </head>
    <body>
        <main>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Delete Member</h1>
      
       <?php
            $member_id=$_GET['member_id'];
        
            $sql = 'DELETE FROM t_members WHERE member_id='.$member_id;

            if(mysqli_query($con,$sql)){
                echo 'member '.$member_id.' has been deleted';
            }
            else{
                echo "Error deleting member record: " . mysqli_error($con);
            }
        
       ?>
              
       <?php mysqli_close($con); //close connection?>
        </main>
    </body>
</html>