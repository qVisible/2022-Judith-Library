<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">  
        <!--Redirect back to read-loans.php page once loan has been updated-->
        <?php if(!empty($_POST['member_fk'])){  ?>
            <meta http-equiv="refresh" content="0.5;URL='read-loans.php'">
        <?php }  ?> 
    </head>
    <script src="main.js"></script>

    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       
       
       <?php
        if(!empty($_POST['member_fk'])){
            $member_fk=$_POST['member_fk'];
            $copy_fk=$_POST['copy_fk'];
            $date_out=$_POST['date_out'];
            
            $sql='INSERT INTO t_loans (member_fk, copy_fk, date_out)
            VALUES ('.$member_fk.', '.$copy_fk.', "'.$date_out.'")';
            
            if(mysqli_query($con,$sql)){
                echo 'Loan '.$loan_id.' has been created';
            }
            else{
                echo "Error creating Loan record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add Loan</h1>
        <?php
       //process book chosen by user to update
            $loan_id=$_GET['loan_id'];
        
            $sql='SELECT * FROM t_loans WHERE loan_id='.$loan_id;

            $result=mysqli_query($con,$sql);     
        
            $rowLoans=mysqli_fetch_array($result);

        ?>
       
       <form method="post" action="create-loan.php" >
           <!--Create members Dropdown Menu-->
           <label>member</label>
           <select name="member_fk" >
           <?php
               //populate the drop down menu from the members table
               $sql='SELECT * FROM t_members';

               $result=mysqli_query($con,$sql);

               while ($rowMembers=mysqli_fetch_array($result)){
                    echo '<option value="'.$row['member_id'].'"';
                    if($rowLoans['member_fk']==$rowMembers['member_id']){
                        echo ' selected ';
                    }
                    echo '>'.$rowMembers['forename'].' '.$rowMembers['surname'].'</option>';
               }
           ?>
           </select>
           <!--end of members Dropdown Menu-->
           <!--Create books Dropdown Menu-->
           <label>book</label>
           <select  name="copy_fk" >
           <?php
               //populate the drop down menu from the copies table
               $sql='SELECT * FROM t_copies JOIN t_books ON book_fk=book_id';


               $result=mysqli_query($con,$sql);

               while ($rowCopiesBooks=mysqli_fetch_array($result)){
                    echo '<option value="'.$rowCopiesBooks['copy_id'].'"';
                    if($rowLoans['copy_fk']==$rowCopiesBooks['copy_id']){
                        echo ' selected ';
                    }
                    
                    echo '>('.$rowCopiesBooks['copy_id'].') '.$rowCopiesBooks['title'].'</option>'.PHP_EOL;
               }
           ?>
           </select>
           <!--end of Publishers Dropdown Menu-->

           <label>date out</label><input type="date" name="date_out" id="date_out" value="<?php echo $rowLoans['date_out'];?>">
           
           <input type="submit" value="Add Loan">
       </form>

         
       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>